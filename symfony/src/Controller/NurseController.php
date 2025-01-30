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


    #[Route('/name/{name}', name: 'findByName', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, string $name): JsonResponse
    {
        $nurse = $entityManager->getRepository(Nurse::class)->findOneBy(['name' => $name]);

        if (!$nurse) {
            return $this->json('Nurse not found!', Response::HTTP_NOT_FOUND);
        }
        return $this->json('Nurse found: ' . $nurse->getName(), Response::HTTP_OK);
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
            ];
        }, $nurses);

        return $this->json($nursesArray, Response::HTTP_OK);
    }


    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, NurseRepository $nurseRepository): JsonResponse //el obj Request representa la solicitud HTTP que llega a la ruta /login
    {
        $gmail = $request->request->get('gmail');
        $password = $request->request->get('pwd');
        // $nurse_data = json_decode($request->request->get(key: 'nurse'));

        if (is_null($gmail) || is_null($password)) {
            return $this->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        $nurse = $nurseRepository->findOneBy(['gmail' => $gmail]);

        if ($nurse && $nurse->getPassword() === $password) {
            return $this->json(['success' => true], Response::HTTP_OK);
        }

        return $this->json(['error' => 'Invalid credentials'], Response::HTTP_BAD_REQUEST);
    }
    #[Route('/{id}', name: 'findById', methods: ['GET'])]
    public function show(Nurse $nurse): JsonResponse
    {

        return $this->json([
            'Id' => $nurse->getId(),
            'Name' => $nurse->getName(),
            'Gmail' => $nurse->getGmail(),
        ], Response::HTTP_OK);
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


    #[Route('/create', name: 'app_crud_create', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, NurseRepository $nurseRepository): JsonResponse
    {
        $name = $request->request->get('name');
        $gmail = $request->request->get('gmail');
        $password = $request->request->get('password');


        if (is_null($name) || is_null($gmail) || is_null($password)) {
            return $this->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        $nurse = new Nurse();
        $nurse->setName($name);
        $nurse->setGmail($gmail);
        $nurse->setPassword($password);

        $entityManager->persist($nurse);
        $entityManager->flush();

        return $this->json(['success' => true], status: Response::HTTP_CREATED);
    }
    #[Route('/update', name: 'app_crud_update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, NurseRepository $nurseRepository): JsonResponse
    {


        $id = $request->query->get('id');
        $name = $request->query->get('name');
        $gmail = $request->query->get('gmail');
        $password = $request->query->get('password');


        if (is_null($id) || is_null($name) || is_null($gmail) || is_null($password)) {
            return $this->json(['message' => 'Missing parameters'], status: Response::HTTP_BAD_REQUEST);
        }

        $nurse = $nurseRepository->findOneBy(['id' => $id]);

        if ($nurse) {
            // Si existe, actualiza los campos necesarios
            $nurse->setName($name);
            $nurse->setGmail($gmail);
            $nurse->setPassword($password);

            // Persiste los cambios en la base de datos
            $entityManager->flush();

            return $this->json(['message' => 'Nurse updated successfully'], status: Response::HTTP_OK);
        } else {
            // Si no existe, se devuelve un error 404
            return $this->json(['message' => 'Nurse not found'], status: Response::HTTP_NOT_FOUND);
        }
    }

}
