<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
//            /** @var UploadedFile $photoFile */
//            $photoFile=$form->get('photo')->getData();
//
//            if ($photoFile){
//                $originalFilename=pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
//                $safeFilename=$slugger->slug($originalFilename);
//                $newFilename=$safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
//
//                try{
//                    $photoFile->move($this->getParameter('photo_directory'),
//                        $newFilename
//                    );
//                } catch (FileException $e){}
//                $user->SetPhotoFilename($newFilename);}

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('default');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
