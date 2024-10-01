<?php

namespace App\Controller;

use App\Repository\TypeBonbonRepository; // Import manquant
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', []);
    }

    #[Route('/ajoutBonbon', name: 'app_ajout_bonbon')]
    public function ajoutBonbon(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class, [
                'label' => 'Nom du bonbon',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix du bonbon',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('gout', ChoiceType::class, [
                'label' => 'Goût du bonbon',
                'choices' => [
                    'Sucré' => 'sucré',
                    'Acidulé' => 'acidulé',
                    'Amer' => 'amer',
                    'Salé' => 'salé',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'rows' => 5],
            ])
            ->add('ajouter', SubmitType::class, [
                'label' => 'Ajouter le bonbon',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Bonbon ajouté avec succès !');
            return $this->redirectToRoute('app_ajout_bonbon');
        }

        return $this->render('base/ajoutBonbon.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/liste-TypeBonbon', name: 'app_liste_typebonbon')]
    public function listeTypeBonbon(TypeBonbonRepository $TypeBonbonRepository): Response
    {
        $typeBonbons = $TypeBonbonRepository->findBy([], ['designation' => 'ASC']);
        return $this->render('base/listeTypeBonbon.html.twig', [
            'typeBonbons' => $typeBonbons
        ]);
    }
    
}
