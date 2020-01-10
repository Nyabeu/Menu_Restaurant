<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MenuRepository;
use App\Entity\Menu;



class HomeController extends AbstractController
{
  /**
  * @Route("/", name="home_page")
  * @param MenuRepository $repository
  * @return Response
  */

  public function index(MenuRepository $repository) : Response
  {
    $menus = $repository->findLatest();
    return $this->render("home/home.html.twig",[
     'menus' => $menus
   ]);
  }
}
