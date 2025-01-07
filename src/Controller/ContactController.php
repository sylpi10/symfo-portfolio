<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    public function __construct(protected MailerInterface $mailer, protected EntityManagerInterface $em)
    {
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, ): Response
    {
        $data = new Contact();
        $form = $this->createForm(ContactType::class, $data);
        $contact = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // honeypot for robots
            if (!empty($_POST['website'])) {
                return $this->redirectToRoute("global");
                // if not filled, handle request
            } else {
                try {
                    $mail = (new TemplatedEmail())
                        ->to('syl.pillet@hotmail.fr')
                        ->from($contact->get('email')->getData())
                        ->subject('Demande de contact')
                        ->text($contact->get('message')->getData())
                        ->context([
                            "form" => $form->createView()
                        ]);
                    $this->mailer->send($mail);
                    $this->addFlash('success', 'Votre email a bien été envoyé');

                    $this->redirectToRoute('app_contact');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('danger', "Le message n'a pas pu être envoyé");
                    $this->redirectToRoute('app_contact');
                }

                $data->setName($contact->get('name')->getData());
                $data->setEmail($contact->get('email')->getData());
                $data->setMessage($contact->get('message')->getData());
                $data->setDate(new \DateTimeImmutable());

                $this->em->persist($data);
                $this->em->flush();

                return $this->redirectToRoute('app_contact');

            }
        }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'body_class' => 'contact-page',
            'menu_class' => 'contact-menu',
            'form' => $form->createView()
        ]);
    }
}
