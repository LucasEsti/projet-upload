<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\Product;
use App\Form\FolderType;
use App\Repository\FolderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/folder")
 */
class FolderController extends AbstractController
{
    /**
     * @Route("/", name="folder_index", methods={"GET"})
     */
    public function index(FolderRepository $folderRepository): Response
    {
        return $this->render('folder/index.html.twig', [
            'folders' => $folderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="folder_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $folder = new Folder();
        
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($user instanceof User) {
            $folder->setUser($user);

        }
        
        //folder 
        $id = $request->query->get('id');
        if (!$id) {
           $id = 1; 
        }
        
        $repositoryFolder = $this->getDoctrine()->getRepository(Folder::class);
        $currentFolder = $repositoryFolder->find($id);
        
        
        $folder->setFolder($currentFolder);
        
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($folder);
            $entityManager->flush();

            return $this->redirectToRoute('main', ['id' => $id]);
        }

        return $this->render('folder/new.html.twig', [
            'folder' => $folder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="folder_show", methods={"GET"})
     */
    public function show(Folder $folder): Response
    {
        
        return $this->render('folder/show.html.twig', [
            'folder' => $folder
        ]);
    }

    /**
     * @Route("/{id}/edit", name="folder_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Folder $folder): Response
    {
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('folder_index');
        }

        return $this->render('folder/edit.html.twig', [
            'folder' => $folder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="folder_delete", methods={"POST"})
     */
    public function delete(Request $request, Folder $folder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$folder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($folder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('folder_index');
    }
}
