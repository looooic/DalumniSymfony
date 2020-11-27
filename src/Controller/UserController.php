<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile=$form->get('photo')->getData();

            if ($photoFile){
                $originalFilename=pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename=$slugger->slug($originalFilename);
                $newFilename=$safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                try{
                    $photoFile->move($this->getParameter('photo_directory'),
                    $newFilename
                    );
                } catch (FileException $e){}
                $user->SetPhotoFilename($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","PUT"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user,[
            'method'=>'put'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $this->getDoctrine()->getManager()->flush();$this->addFlash('success','modifié');

            return $this->redirectToRoute('default');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminlisteu');
    }

    /**
     * @Route("/change_password/{id}", name="user_change_password", methods={"GET","PUT"})
     */
    public function changePassword(User $user, Request $request, EntityManagerInterface
    $entityManager, UserPasswordEncoderInterface $encoder){
        $form=$this->createForm(ChangePasswordType::class, null,[
            'method'=>'put',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()&&password_verify($form->get('old_password')->getData(),$user->getPassword())){
            $user->setPassword($encoder->encodePassword(
                $user,
                $form->get('password')->getData()
            ));
            $entityManager->flush();
            return $this->redirectToRoute('/',[
                'id'=>$user->getId(),
            ]);
        }
        return $this->render('user/change_password.html.twig',[
            'password_form'=>$form->createView(),
        ]);
    }

}
