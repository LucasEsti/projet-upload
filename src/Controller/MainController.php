<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\User;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        
        $currentFolder = 1;
        
        $repositoryProduct = $this->getDoctrine()->getRepository(Folder::class);
        $folders = $repositoryProduct->findBy(['folder' => $currentFolder]);
        //show product in
        $repositoryProduct = $this->getDoctrine()->getRepository(Product::class);
        $products = $repositoryProduct->findBy(['folder' => $currentFolder]);
        $donnees = array_merge($folders, $products);
        
        $datas = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'datas' => $datas,
            'currentFolder' => $currentFolder
        ]);
    }
}
