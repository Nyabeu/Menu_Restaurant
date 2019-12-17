<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 */
class MenuController extends AbstractController
{

  /**
  * @Route("/menu", name="menu.index")
  * @return Response
  */

  public function index() : Response
  {
    return $this->render("menu/index.html.twig", [
      "current_menu" => "menus"
    ]);
  }
}
