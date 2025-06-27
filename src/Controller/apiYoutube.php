<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class apiYoutube extends AbstractController
{
    #[Route('/youtube', name: 'youtube')]
    public function youtube(Request $request)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }

        $apikey = 'AIzaSyBf18UkGKD3VToo--055bTO3M-_exbFabA';
        $url_youtube = 'https://www.googleapis.com/youtube/v3/search';

        // Solo se puede acceder a esta página desde AJAX con POST por lo que si entra de otra forma le devuelve al login

        if ($request->isMethod('POST')) {
            $valorBusqueda = $request->request->get('valor');
            $type = 'video';
            $part = 'id,snippet';

            $url = $url_youtube . '?key=' . $apikey . '&part=' . $part . '&order=relevance&q=' . urlencode($valorBusqueda) . '&type=' . $type;
            $respuesta = file_get_contents($url);
            if ($respuesta == null) {
                $this->addFlash(
                    'aviso',
                    'Error al cargar la API de Youtube.'
                );
            }
            return new Response($respuesta);
        } else {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('timeline');
        }
    }
}