<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Relacion;
use App\Entity\Usuario;

class controladores_amistad extends AbstractController
{

    #[Route('/dejar_amistad/{id_1?0}/{id_2?0}', name: 'dejar')]
    public function dejar_amistad($id_1, $id_2, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_1 == 0 || $id_2 == 0) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_2 != $this->getUser()->getId()) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }

        $relacion = $entityManager->getRepository(Relacion::class)->findOneBy(['usuario1' => [$id_1, $id_2], 'usuario2' => [$id_1, $id_2], 'solicitud' => 0]);

        if ($relacion) {
            $entityManager->remove($relacion);
            $entityManager->flush();
        }
        $usuario = $entityManager->getRepository(Usuario::class)->find($id_1);

        return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);

    }

    #[Route('/cancelar_amistad/{id_1?0}/{id_2?0}', name: 'cancelar')]
    public function cancelar_amistad($id_1, $id_2, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_1 == 0 || $id_2 == 0) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_2 != $this->getUser()->getId()) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }

        $relacion = $entityManager->getRepository(Relacion::class)->findOneBy(['usuario1' => [$id_2], 'usuario2' => [$id_1], 'solicitud' => 1]);

        if ($relacion) {
            $entityManager->remove($relacion);
            $entityManager->flush();
        }
        $usuario = $entityManager->getRepository(Usuario::class)->find($id_1);

        return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);


    }

    #[Route('/aceptar_amistad/{id_1?0}/{id_2?0}', name: 'aceptar')]
    public function aceptar_amistad($id_1, $id_2, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_1 == 0 || $id_2 == 0) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_2 != $this->getUser()->getId()) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }

        $usuario = $entityManager->getRepository(Usuario::class)->find($id_1);

        if (substr($usuario->getCuentaActivada(), 0, 2) === 'N-') {
            $this->addFlash(
                'aviso',
                'La cuenta de este usuario aún no está activada, no puede aceptar su solicitud de amistad.'
            );
            return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);
        }

        if (substr($usuario->getCuentaActivada(), 0, 2) === 'E-') {
            $this->addFlash(
                'aviso',
                'La cuenta de este usuario está bloqueada, no puede aceptar su solicitud de amistad.'
            );
            return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);
        }

        $relacion = $entityManager->getRepository(Relacion::class)->findOneBy(['usuario1' => [$id_1], 'usuario2' => [$id_2], 'solicitud' => 1]);

        if ($relacion) {
            $relacion->setSolicitud(0);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);


    }
    #[Route('/rechazar_amistad/{id_1?0}/{id_2?0}', name: 'rechazar')]
    public function rechazar_amistad($id_1, $id_2, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_1 == 0 || $id_2 == 0) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_2 != $this->getUser()->getId()) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }

        $relacion = $entityManager->getRepository(Relacion::class)->findOneBy(['usuario1' => [$id_1], 'usuario2' => [$id_2], 'solicitud' => 1]);

        if ($relacion) {
            $entityManager->remove($relacion);
            $entityManager->flush();
        }
        $usuario = $entityManager->getRepository(Usuario::class)->find($id_1);

        return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario->getNombreUsuario()]);


    }

    #[Route('/solicitar_amistad/{id_1?0}/{id_2?0}', name: 'solicitar')]
    public function solicitar_amistad($id_1, $id_2, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash(
                'aviso',
                'Inicie sesión para acceder a la red social.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_1 == 0 || $id_2 == 0) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }
        if ($id_2 != $this->getUser()->getId()) {
            $this->addFlash(
                'aviso',
                'No puede acceder a esa página.'
            );
            return $this->redirectToRoute('control_login');
        }


        $usuario = $entityManager->getRepository(Usuario::class)->find($id_2);
        $usuario_visitado = $entityManager->getRepository(Usuario::class)->find($id_1);

        if (substr($usuario_visitado->getCuentaActivada(), 0, 2) === 'N-') {
            $this->addFlash(
                'aviso',
                'La cuenta de este usuario aún no está activada, no puede solicitar su amistad.'
            );
            return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario_visitado->getNombreUsuario()]);
        }

        if (substr($usuario_visitado->getCuentaActivada(), 0, 2) === 'E-') {
            $this->addFlash(
                'aviso',
                'La cuenta de este usuario está bloqueada, no puede solicitar amistad.'
            );
            return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario_visitado->getNombreUsuario()]);
        }

        $relacion = $entityManager->getRepository(Relacion::class)->findOneBy(['usuario1' => [$id_1, $id_2], 'usuario2' => [$id_1, $id_2]]);

        $usuario = $entityManager->getRepository(Usuario::class)->find($id_2);
        $usuario_visitado = $entityManager->getRepository(Usuario::class)->find($id_1);

        if ($relacion) {
            return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario_visitado->getNombreUsuario()]);
        }

        if ($usuario && $usuario_visitado) {

            $relacion = new Relacion();
            $relacion->setUsuario1($usuario);
            $relacion->setUsuario2($usuario_visitado);
            $relacion->setSolicitud(1);

            $entityManager->persist($relacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perfil', ['nombre_usuario' => $usuario_visitado->getNombreUsuario()]);

    }
}
