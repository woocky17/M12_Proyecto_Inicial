<?php

namespace App\Controller;

use App\Entity\Nurse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Name;
use App\Repository\NurseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;




#[Route('/NurseController', name: 'Controller')] //usamos el prefijo NurseController para agrupar las rutas bajo el mismo dominio
class NurseController extends AbstractController
{


    #[Route('/name/{name}', name: 'findByName')]
    public function index(EntityManagerInterface $entityManager, string $name): Response
    {
        $nurse = $entityManager->getRepository(Nurse::class)->findOneBy(['name' => $name]);
        if (!$nurse) {
            return new Response('Nurse not found!');
        }
        return new Response('Nurse found: ' . $nurse->getName());
    }

    #[Route('/nurse', name: 'getAll', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $nurseRepository = $entityManager->getRepository(Nurse::class);
        $nurses = $nurseRepository->findAll();

        // Convertir los objetos Nurse a un array de datos
        $nursesArray = array_map(function ($nurse) {
            return [
                'id' => $nurse->getId(),
                'name' => $nurse->getName(),
                'gmail' => $nurse->getGmail(),
                // No incluimos la contraseña por razones de seguridad
            ];
        }, $nurses);

        return $this->json($nursesArray, Response::HTTP_OK);

    }


    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, NurseRepository $nurseRepository): JsonResponse //el obj Request representa la solicitud HTTP que llega a la ruta /login
    {
        $gmail = $request->request->get('correo');
        $password = $request->request->get('password');

        if (is_null($gmail) || is_null($password)) {
            return $this->json(['Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        $nurse = $nurseRepository->findOneBy(['gmail' => $gmail]);

        if ($nurse && $nurse->getPassword() === $password) {
            return $this->json(true);

        }

        //return new JsonResponse(false); //FALTA PONER EL Response::HTTP_OK(ES IGUAL QUE PONER 200)
        return $this->json(false);
    }

    #[Route('/{id}', name: 'app_delete', methods: ['DELETE'])]
    public function delete(Request $request, Nurse $nurse = null, EntityManagerInterface $entityManager): JsonResponse
    {
        if (!$nurse) {
            return $this->json('Nurse not found', Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($nurse);
        $entityManager->flush();

        return $this->json('Nurse removed!', Response::HTTP_OK);
    }
}

