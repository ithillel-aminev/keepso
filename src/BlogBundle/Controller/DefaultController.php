<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $userRepository = $this->getDoctrine()->getRepository('BlogBundle:User');
        $users = $userRepository->findBy(array('role'=>User::ROLE_USER), array('id' => 'ASC'));

        return $this->render('BlogBundle:Default:index.html.twig', array('users' => $users));
    }
}
