<?php

namespace App\Controller;

use App\Dto\Contact;
use App\Form\ContactType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Clock\Clock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(MovieRepository $repository): Response
    {
        return $this->render('main/index.html.twig', [
            'movies' => $repository->findBy([], ['releasedAt' => 'DESC'], 6),
        ]);
    }

    #[Route('/contact', name: 'app_main_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $dto = new Contact();
        $form = $this->createForm(ContactType::class, $dto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dto->setCreatedAt(Clock::get()->now());

            $email = (new Email())
                ->addTo('applicant@sensiolabs.com')
                ->addFrom($dto->getEmail())
                ->subject(sprintf('New contact message : %s', $dto->getSubject()))
                ->text(sprintf('Sent at %s by %s : "%s"', $dto->getCreatedAt()->format('d M Y - H:i:s'), $dto->getName(), $dto->getContent()))
            ;

            // $mailer->send($email);

            $this->addFlash('success', 'Your message has been sent!');

            return $this->redirectToRoute('app_main_contact');
        }

        return $this->render('main/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
