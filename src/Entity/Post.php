<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'post')]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', name: 'id_post')]
    #[ORM\GeneratedValue]
    private $id_post;

    // usuario

    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'posts')]
    #[ORM\JoinColumn(name: 'id_usuario', referencedColumnName: 'id_usuario')]
    private $usuario;


    #[ORM\Column(type: 'string', name: 'cuerpo_post')]
    private $cuerpo_post;

    #[ORM\Column(type: 'string', name: 'archivo_adjunto')]
    private $archivo_adjunto;

    #[ORM\Column(type: 'string', name: 'fecha_hora_publicacion')]
    private $fecha;

    #[ORM\Column(type: 'integer', name: 'likes')]
    private $likes;

    #[ORM\Column(type: 'integer', name: 'dislikes')]
    private $dislikes;

    #[ORM\OneToMany(targetEntity: 'Comentario', mappedBy: 'post')]
    private $comentarios;


    public function getIdPost()
    {
        return $this->id_post;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        return $this->usuario = $usuario;
    }

    public function getCuerpoPost()
    {
        return $this->cuerpo_post;
    }

    public function setCuerpoPost($cuerpo_post)
    {
        return $this->cuerpo_post = $cuerpo_post;
    }

    public function getArchivo()
    {
        return $this->archivo_adjunto;
    }

    public function setArchivo($archivo_adjunto)
    {
        return $this->archivo_adjunto = $archivo_adjunto;
    }

    public function getFechaPublicacion()
    {
        return $this->fecha;
    }

    public function setFechaPublicacion($fecha)
    {
        return $this->fecha = $fecha;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes)
    {
        return $this->likes = $likes;
    }
    public function getDislikes()
    {
        return $this->dislikes;
    }

    public function setDislikes($dislikes)
    {
        return $this->dislikes = $dislikes;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }
    public function setComentarios($comentarios)
    {
        return $this->comentarios = $comentarios;
    }
}