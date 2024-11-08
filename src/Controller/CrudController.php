<?php

namespace App\Controller;

use App\Entity\Nurse;
use App\Form\NurseType;
use App\Repository\NurseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud')]
final class CrudController extends AbstractController
{


    #[Route('/new', name: 'app_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nurse = new Nurse();
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nurse);
            $entityManager->flush();

            return $this->redirectToRoute('app_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud/new.html.twig', [
            'nurse' => $nurse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_show', methods: ['GET'])]
    public function show(Nurse $nurse): JsonResponse
    {
        return $this->json([
            'Id' => $nurse->getId(),
            'Name' => $nurse->getName(),
            'Mail' => $nurse->getGmail(),
        ], Response::HTTP_OK);
    }

    #[Route('/{id}/edit', name: 'app_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nurse $nurse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud/edit.html.twig', [
            'nurse' => $nurse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Nurse $nurse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $nurse->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($nurse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
