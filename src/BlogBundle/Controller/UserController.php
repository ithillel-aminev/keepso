<?php
namespace BlogBundle\Controller;

use BlogBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function createAction()
    {

        $user = new User();
        $user->setIsActive(1);
        $user->setGroup(User::GROUP_USER);
        $user->setEmail('tim8917@gmail.com');
        $user->setUsername('tim8917@gmail.com');
        $user->setName('tim8917@gmail.com');
        $user->setToken('SOME_TOKEN');

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

        return new Response('Created a user with id='.$user->getId());

    }

}