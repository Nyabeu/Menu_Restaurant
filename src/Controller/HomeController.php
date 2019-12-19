<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 *
 */
class HomeController extends AbstractController
{
  /**
  * @Route("/", name="home_page")
  * @return Response
  */

  public function index() : Response
  {
    $tab = [1,2,'toto',52];
    return $this->render("home/index.html.twig",[
     'tableau' => $tab
   ]);
  }
}
