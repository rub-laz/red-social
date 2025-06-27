<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relacion')]
class Relacion
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', name: 'id_relacion')]
    #[ORM\GeneratedValue]
    private $id_relacion;

    // usuario1

    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'relaciones1')]
    #[ORM\JoinColumn(name: 'id_usuario1', referencedColumnName: 'id_usuario')]
    private $usuario1;

    //usuario2

    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'relaciones2')]
    #[ORM\JoinColumn(name: 'id_usuario2', referencedColumnName: 'id_usuario')]
    private $usuario2;

    #[ORM\Column(type: 'integer', name: 'solicitud')]
    private $solicitud;

    public function getId()
    {
        return $this->id_relacion;
    }

    public function getUsuario1()
    {
        return $this->usuario1;
    }

    public function setUsuario1($usuario1)
    {
        return $this->usuario1 = $usuario1;
    }

    public function getUsuario2()
    {
        return $this->usuario2;
    }

    public function setUsuario2($usuario2)
    {
        return $this->usuario2 = $usuario2;
    }

    public function getSolicitud()
    {
        return $this->solicitud;
    }

    public function setSolicitud($solicitud)
    {
        return $this->solicitud = $solicitud;
    }

}