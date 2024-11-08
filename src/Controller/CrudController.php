<?php

namespace App\Controller;

use App\Entity\Nurse;
use App\Form\NurseType;
use App\Repository\NurseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud')]
final class CrudController extends AbstractController
{


    // #[Route('/new', name: 'app_crud_new', methods: ['POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager, NurseRepository $nurseRepository): Response
    // {
    //     $id = $request->request->get('id');
    //     $name = $request->request->get('name');
    //     $gmail = $request->request->get('gmail');
    //     $password = $request->request->get('password');

    //     if (is_null($id) || is_null($name) || is_null($gmail) || is_null($password)) {
    //         return $this->json(['Missing parameters'], status: Response::HTTP_BAD_REQUEST);
    //     }

    //     if ($nurseRepository->findOneBy(['id' => $id])) {
    //         return $this->json(['Already exist'], status: Response::HTTP_BAD_REQUEST);
    //     } else {
    //         $nurse = new Nurse();
    //         $nurse->setId($id);
    //         $nurse->setName($name);
    //         $nurse->setGmail($gmail);
    //         $nurse->setPassword($password);

    //         $entityManager->persist($nurse);
    //         $entityManager->flush();

    //         return $this->json(['message' => 'Nurse created successfully'], status: Response::HTTP_CREATED);
    //     }
    // }

    // #[Route('/{id}', name: 'app_crud_show', methods: ['GET'])]
    // public function show(Nurse $nurse): Response
    // {
    //     return $this->render('crud/show.html.twig', [
    //         'nurse' => $nurse,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_crud_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Nurse $nurse, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(NurseType::class, $nurse);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_crud_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('crud/edit.html.twig', [
    //         'nurse' => $nurse,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_crud_delete', methods: ['DELETE'])]
    public function delete(Request $request, Nurse $nurse, EntityManagerInterface $entityManager): Response
    {
        

        return $this->json(false);
    }
}
