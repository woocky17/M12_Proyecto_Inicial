<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route(path: '/usuari/info/{id}', name: 'usuari_info')]
    public function info(string $id): JsonResponse {
        $usuari = ["nom" => "pepe", "email" => "pepe@gmail.com"];
        $usuari["edat"] = 28;

        $usuaris["22"] = $usuari;
        $usuaris["33"] = ["nom" => "mercedes","email"=> "mercedes@gmail.com"];
        $resposta = $usuaris[$id];

        //return new Response(json_encode($usuari), Response::HTTP_OK, ['Content-Type' => 'application/json']);
        
        //Content-type indica el tipo de contenido que envía el servidor en su respuesta
        //para que el navegador/el cliente sepa cómo interpretar los datos que recibe
        //Response::HTTP_OK es igual a poner 200, e le indica al cliente que la solicitud ha sido procesada con éxito
        return new JsonResponse($resposta, Response::HTTP_OK);
    }
}
