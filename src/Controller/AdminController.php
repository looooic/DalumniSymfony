<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUsersType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/listeu", name="listeu")
     */
    public function listUsers(UserRepository $userRepository)
    {
        return $this->render('admin/_listeu.html.twig',['users'=>$userRepository->findAll()]);
    }

    /**
     * @Route("/users/edit/{id}",name="edit_user")
     */
    public function editRoleUser(User $user, Request $request, EntityManagerInterface $entityManager)
    {
        $form=$this->createForm(EditUsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('message','Role modifié');
            return $this->redirectToRoute('adminlisteu');
        }
        return $this->render('admin/edituser.html.twig',['userForm'=>$form->createView()]);
    }
}
