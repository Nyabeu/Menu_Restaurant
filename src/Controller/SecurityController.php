<?php

 namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Repository\MenuRepository;
use App\Form\MenuType;
use Symfony\Component\HttpFoundation\Request;


 class SecurityController extends AbstractController
 {
  /**
  * @Route("/login", name="login")
  */
  public function login(AuthenticationUtils $authenticationUtils) : Response
  {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render("security/login.html.twig",[
      'last_username' => $lastUsername,
      'error' => $error
    ]);
  }

 }
