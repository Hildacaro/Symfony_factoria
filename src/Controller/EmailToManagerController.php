<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\EmailToManagerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class EmailToManagerController extends AbstractController
{
    #[Route('/email/to/manager', name: 'email_to_manager_index')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(EmailToManagerType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //$transport = Transport::fromDsn();

            $mailer = new Mailer($transport);


            $email = (new Email())

            ->from('emmarentero@gmail.com')

            ->to('emmarentero@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Valoración periodo de prueba')

            ->text('¡Hola!

            Tal como hemos comentado, te adjuntamos link con la valoración del periodo de prueba. Para nosotr@s es muy importante tener tu feedback de este periodo y sobre todo tener la información necesaria para dar continuidad o no al contrato. Confiamos que para llegar lejos debemos ser capaces de ser críticos con nosotros mismos y tener espacios para seguir creciendo y aprendiendo, por lo que al finalizar esta evaluación te invitamos a que la compartas y la revises con la persona evaluada:

            En caso de cualquier duda, estamos a tu disposición.

            People & Culture

            ')

            ->html('
            
            <div style="color: #020100; background-color: #FFA37F; width: 100%; padding: 16px 0; text-align: center; color-padding: #FD3903">

                <h1>¡Hola!</h1>

                <h4>Tal como hemos comentado, te adjuntamos link con la valoración del periodo de prueba. Para nosotr@s es muy importante tener tu feedback de este periodo y sobre todo tener la información necesaria para dar continuidad o no al contrato. Confiamos que para llegar lejos debemos ser capaces de ser críticos con nosotros mismos y tener espacios para seguir creciendo y aprendiendo, por lo que al finalizar esta evaluación te invitamos a que la compartas y la revises con la persona evaluada:</h4>

                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScOhrA7xLvpODBWUUEx5_A1-B079SDHxNSX9hqDMdjzTGyknQ/viewform">Enlace al formulario de evaluación final</a>

                <h4>En caso de cualquier duda, estamos a tu disposición.</h4>

                <h2>People & Culture</H2>

            ');

        $mailer->send($email);

        $this->addFlash('success', 'El correo electrónico se ha enviado correctamente.');

        }

        return $this->renderForm('email_to_manager/index.html.twig', [
            'form' => $form,
        ]); 

    }

}
