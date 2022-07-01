<?php

namespace App\Controller;

use App\Entity\Etudes;
use App\Form\EtudesType;
use App\Repository\EtudesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use MercurySeries\FlashyBundle\FlashyNotifier;

/**
 * @Route("/etudes")
 */
class EtudesController extends AbstractController
{
    /**
     * @Route("/", name="app_etudes_index", methods={"GET"})
     */
    public function index(EtudesRepository $etudesRepository): Response
    {
        return $this->render('etudes/index.html.twig', [
            'etudes' => $etudesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_etudes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EtudesRepository $etudesRepository, FlashyNotifier $flashy): Response
    {
        $etude = new Etudes();
        $form = $this->createForm(EtudesType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            ImageField::new('image')
                ->setFormType(VichImageType::class);
            $etudesRepository->add($etude, true);

            $flashy->primaryDark('Post Created successfully!', '#');
            return $this->redirectToRoute('app_etudes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudes/new.html.twig', [
            'etude' => $etude,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_etudes_show", methods={"GET"})
     */
    public function show(Etudes $etude): Response
    {
        return $this->render('etudes/show.html.twig', [
            'etude' => $etude,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_etudes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Etudes $etude, EtudesRepository $etudesRepository, FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(EtudesType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            ImageField::new('image')
                ->setFormType(VichImageType::class);

            $etudesRepository->add($etude, true);
            $flashy->info('Post Updated successfully!', '#');
            return $this->redirectToRoute('app_etudes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudes/edit.html.twig', [
            'etude' => $etude,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_etudes_delete", methods={"POST"})
     */
    public function delete(Request $request, Etudes $etude, EtudesRepository $etudesRepository, FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete' . $etude->getId(), $request->request->get('_token'))) {
            $etudesRepository->remove($etude, true);
        }
        $flashy->error('Post Deleted successfully!', '#');
        return $this->redirectToRoute('app_etudes_index', [], Response::HTTP_SEE_OTHER);
    }
}
