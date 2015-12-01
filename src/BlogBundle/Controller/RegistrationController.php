<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Form\UserType;
use BlogBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function registerAction(Request $request)
    {
        $user = $this->getUser();
        if ($user){
            return $this->redirectToRoute('blog_homepage');
        }

        // 1) build the form
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setIsActive(true);
            $user->setRole(User::ROLE_USER);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like send them an email, etc
            // maybe set a "flash" success message for the user


            return $this->redirectToRoute('login_route');
        }

        return $this->render(
            'BlogBundle:registration:register.html.twig',
            array('form' => $form->createView())
        );
    }
}