<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'comentario')]
class Comentario
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', name: 'id_comentario')]
    #[ORM\GeneratedValue]
    private $id_comentario;

    //usuario

    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'id_usuario', referencedColumnName: 'id_usuario')]
    private $usuario;

    //post

    #[ORM\ManyToOne(targetEntity: 'Post', inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'id_post', referencedColumnName: 'id_post')]
    private $post;

    #[ORM\Column(type: 'string', name: 'cuerpo_comentario')]
    private $cuerpo_comentario;

    #[ORM\Column(type: 'string', name: 'fecha_hora_publicacion')]
    private $fecha;

    public function getIdComentario()
    {
        return $this->id_comentario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        return $this->usuario = $usuario;
    }

    public function getPost()
    {
        return $this->post;
    }
    public function setPost($post)
    {
        return $this->post = $post;
    }

    public function getCuerpoComentario()
    {
        return $this->cuerpo_comentario;
    }
    public function setCuerpoComentario($cuerpo_comentario)
    {
        return $this->cuerpo_comentario = $cuerpo_comentario;
    }

    public function getFechaComentario()
    {
        return $this->fecha;
    }
    public function setFechaComentario($fecha)
    {
        return $this->fecha = $fecha;
    }
}
