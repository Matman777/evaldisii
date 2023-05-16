<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'app_products')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'produits' => $produit
        ]);
    }

    #[Route('/produit/{id}', name: 'app_product')]
    public function produit($id, ProduitRepository $produitRepository, Request $request, CommentaireRepository $commentaireRepository): Response
    {

        $produit = $produitRepository->findOneBy(['id' => $id]);

        $commentaire = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        $commentaire->setProduit($produit);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->save($commentaire, true);

            return $this->redirectToRoute('app_products');
        }

        return $this->render('product/fiche.html.twig', [
            'controller_name' => 'ProductController',
            'form' => $form->createView(),
            'produit' => $produit
        ]);
    }
}
