<?php

 namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;
use App\Repository\MenuRepository;

 /**
  *
  */
 class AdminMenuController extends AbstractController
 {

   /**
    * @var  MenuRepository
    */
    private $repository;

    public function __construct(MenuRepository $repository){
      $this->repository = $repository;
    }

  /**
  * @Route("/admin", name="admin.menu.index")
  * @param MenuRepository $repository
  * @return Response
  */

  public function index(MenuRepository $repository) : Response
  {
      $menus = $this->repository->findAll();
    return $this->render("admin/menu/index.html.twig", [
      "menus" => $menus
    ]);
  }

  /**
  * @Route("/admin/{id}", name="admin.menu.edit")
  * @param MenuRepository $repository
  * @return Response
  */

  public function edit(MenuRepository $repository) : Response
  {
    return $this->render("admin/menu/edit.html.twig");
  }
 }
