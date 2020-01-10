<?php

 namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;
use App\Repository\MenuRepository;
use App\Form\MenuType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;


 /**
  * @Route("/admin")
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
  * @Route("/", name="admin.menu.index")
  * @param MenuRepository $repository
  * @return Response
  */

  public function index(MenuRepository $repository) : Response
  {
      $menus = $this->repository->findAll();
    return $this->render("admin/menu/index.html.twig", [
      "menus" => $menus,
      'current_admin' => 'admin'
    ]);
  }

    /**
     * @Route("/menu/create", name="admin.menu.new", methods={"GET","POST"})
     */
    public function new(Request $request,FileUploader $fileUploader): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $modelFile = $form['brochureMenu']->getData();
            if ($modelFile) {
                $modelFileName = $fileUploader->upload($modelFile);
                $menu->setBrochureMenu($modelFileName);

            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();
            $this->addFlash('success', 'Menu crée avec succès');

            return $this->redirectToRoute('admin.menu.index');
        }

        return $this->render('admin/menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
            'current_admin' => 'admin',
        ]);
    }

  /**
  * @Route("/menu/{id}", name="admin.menu.edit",methods={"GET","POST"})
  * @param Request $request
  * @param Menu $menu
  * @return Response
  */

  public function edit(Request $request, Menu $menu, FileUploader $fileUploader) : Response
  {
      $newFile =  new File($this->getParameter('Illustration_Menu').'/'.$menu->getBrochureMenu()) ;
      $menu->setBrochureMenu($newFile);

      $form = $this->createForm(MenuType::class, $menu);
      $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modelFile = $form['brochureMenu']->getData();
            if ($modelFile) {
                $newFilename = $fileUploader->upload($modelFile);
                $afro->setBrochureMenu($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Menu modifié avec succès');
            return $this->redirectToRoute('admin.menu.index');
        }
    return $this->render("admin/menu/edit.html.twig",[
      'menu' => $menu,
       'form' => $form->createView(),
       'current_admin' => 'admin',
     ]);
  }

    /**
    * @Route("/menu/{id}", name="admin.menu.delete", methods={"DELETE"})
    * @param Request $request
    * @param Menu $menu
    * @return Response
    */
    public function delete(Request $request, Menu $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token')) )
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu);
            $em->flush();
            $this->addFlash('success', 'Ce menu a été supprimé');
        }

        return $this->redirectToRoute('admin.menu.index');
    }
 }
