<?php

namespace App\Controller;
use App\Entity\Nurse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;



#[Route('/NurseController', name: 'Controller')] //usamos el prefijo NurseController para agrupar las rutas bajo el mismo dominio#[Route('/NurseController', name: 'Controller')]
class NurseController extends AbstractController
{
    #[Route('/nurse', name: 'getAll', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $nurseRepository = $entityManager->getRepository(Nurse::class);
        $nurses = $nurseRepository->findAll();

        // Convertir los objetos Nurse a un array de datos
        $nursesArray = array_map(function($nurse) {
            return [
                'id' => $nurse->getId(),
                'name' => $nurse->getName(),
                'gmail' => $nurse->getGmail(),
                // No incluimos la contraseña por razones de seguridad
            ];
        }, $nurses);

        return $this->json($nursesArray, Response::HTTP_OK);
    }
}


