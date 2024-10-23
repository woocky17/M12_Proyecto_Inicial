<?php

namespace App\Controller;

use App\Repository\NurseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



#[Route('/NurseController', name: 'Controller')] //usamos el prefijo NurseController para agrupar las rutas bajo el mismo dominio
class NurseController extends AbstractController {

    #[Route('/login', name: 'app_login', methods:['POST'])]
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

}

