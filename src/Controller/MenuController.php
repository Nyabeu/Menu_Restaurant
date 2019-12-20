<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;
use App\Repository\MenuRepository;
/*use Doctrine\Common\Persistence\ObjectManager;

/**
 *
 */
class MenuController extends AbstractController
{
  /**
  * @var  MenuRepository
  */
  private $repository;

  /**
  * @var  ObjectManager
  */
  private $em;

  public function __construct(MenuRepository $repository){
    $this->repository = $repository;
    /*$this->em = $em;*/
  }

  /**
  * @Route("/menu", name="menu.index")
  * @param MenuRepository $repository
  * @return Response
  */

  public function index(MenuRepository $repository) : Response
  {

    return $this->render("menu/index.html.twig", [
      "current_menu" => "menus"
    ]);
  }

  /**
  * @Route("/menu/{slug}-{id}", name="menu.show", requirements={"slug" : "[a-z0-9\-]*"})
  * @param Menu $menu
  * @return Response
  */

  public function show(Menu $menu, string $slug) : Response
  {

    if($menu->getSlug() !== $slug){
      return  $this->redirectToRoute('menu.show', [
        'id' => $menu->getId(),
        'slug' => $menu->getSlug()
      ], 301);
    }

    return $this->render("menu/show.html.twig", [
      'menu' => $menu,
      "current_menu" => "menus"
    ]);
  }
}
