<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class apiTiempo extends AbstractController
{
    #[Route('/tiempo', name: 'tiempo')]
    public function elTiempo(Request $request)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }

        // Fuente API:https://www.weatherapi.com

        // Solo se puede acceder a esta página desde AJAX con POST por lo que si entra de otra forma le devuelve al login

        if ($request->isMethod('POST')) {
            $apikey = '508375ca3d5e4070ac2100429241502';
            $valorBusqueda = $request->request->get('valor');
            $ubicacion = $valorBusqueda;
            $url_con_parametros = 'http://api.weatherapi.com/v1/forecast.json?key=' . $apikey . '&q=' . $ubicacion . '&days=1&lang=es';
            $respuesta = file_get_contents($url_con_parametros);
            if ($respuesta == null) {
                $this->addFlash(
                    'aviso',
                    'Error al cargar la API del tiempo.'
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