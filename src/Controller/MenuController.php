<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;
use App\Repository\MenuRepository;

/**
 *
 */
class MenuController extends AbstractController
{
  /**
  * @var  MenuRepository
  */
  private $repository;

  public function __construct(MenuRepository $repository){
    $this->repository = $repository;
  }

  /**
  * @Route("/menu", name="menu.index")
  * @param MenuRepository $repository
  * @return Response
  */

  public function index(MenuRepository $repository) : Response
  {

    $menus = $repository->findLatest();
    return $this->render("menu/index.html.twig", [
      "menus" => $menus
    ]);
  }
}
