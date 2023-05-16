/produits: tous les produits

/produit/id: le produit sélectionné

/ : accueil avec les 5 derniers produits ajoutés

/admin/produit/ : liste des produits, CRUD

/admin/produit/new : ajouter un produit

admin/commentaire/ : voir les commentaires, CRUD

*********************************************************

page edit produit: 
The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". 
You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance 
of "Symfony\Component\HttpFoundation\File\File".

réglé en ajoutant 'data_class' => null au formulaire

quand on modifie et update un produit, le nom n'est pas bon:

	C:\xampp\tmp\php3F7B.tmp

    et l'image n'apparaît plus


sauvegarde du code edit/id:

#[Route('/{id}/edit', name: 'app_admin_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    *************************************************************

    logo, police: klasik
    