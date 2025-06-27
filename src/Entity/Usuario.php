<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity]
#[ORM\Table(name: 'usuario')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', name: 'id_usuario')]
    #[ORM\GeneratedValue]
    private $id_usuario;

    #[ORM\Column(type: 'string', name: 'nombre')]
    private $nombre;

    #[ORM\Column(type: 'string', name: 'nombre_usuario')]
    private $nombre_usuario;

    #[ORM\Column(type: 'string', name: 'clave')]
    private $clave;

    #[ORM\Column(type: 'string', name: 'correo')]
    private $correo;

    #[ORM\Column(type: 'string', name: 'foto_perfil')]
    private $foto;

    #[ORM\Column(type: 'string', name: 'bio')]
    private $bio;

    #[ORM\Column(type: 'string', name: 'cuenta_activada')]
    private $cuenta_activada;

    #[ORM\Column(type: 'integer', name: 'rol')]
    private $rol;

    #[ORM\OneToMany(targetEntity: 'Post', mappedBy: 'usuario')]
    private $posts;

    #[ORM\OneToMany(targetEntity: 'Comentario', mappedBy: 'usuario')]
    private $comentarios;

    #[ORM\OneToMany(targetEntity: 'Relacion', mappedBy: 'usuario1')]
    private $relaciones1;

    #[ORM\OneToMany(targetEntity: 'Relacion', mappedBy: 'usuario2')]
    private $relaciones2;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->relaciones1 = new ArrayCollection();
        $this->relaciones2 = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        return $this->nombre = $nombre;
    }

    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    public function setNombreUsuario($nombre_usuario)
    {
        return $this->nombre_usuario = $nombre_usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function setClave($clave)
    {
        return $this->clave = $clave;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        return $this->correo = $correo;
    }

    public function getFotoPerfil()
    {
        return $this->foto;
    }

    public function setFotoPerfil($foto)
    {
        return $this->foto = $foto;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        return $this->bio = $bio;
    }

    public function getCuentaActivada()
    {
        return $this->cuenta_activada;
    }

    public function setCuentaActivada($cuenta_activada)
    {
        return $this->cuenta_activada = $cuenta_activada;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        return $this->rol = $rol;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($posts)
    {
        return $this->posts = $posts;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }
    public function setComentarios($comentarios)
    {
        return $this->comentarios = $comentarios;
    }
    public function getRelaciones1()
    {
        return $this->relaciones1;
    }
    public function setRelaciones1($relacion1)
    {
        return $this->relaciones1 = $relacion1;
    }
    public function getRelaciones2()
    {
        return $this->relaciones2;
    }
    public function setRelaciones2($relacion2)
    {
        return $this->relaciones2 = $relacion2;
    }

    // Funciones para la sesión

    public function getRoles(): array
    {
        $roles = [];
        if ($this->rol == 1) {
            $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        } else if ($this->rol == 0) {
            $roles[] = 'ROLE_USER';
        } else {
            $roles[] = 'ROLE_DENEGADO';
        }
        return $roles;
    }

    public function getPassword(): string
    {
        return $this->getClave();
    }

    public function getUserIdentifier(): string
    {
        return $this->getNombre();
    }

    public function getSalt(): string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    // Función que devuelve la cantidad de amigos que tiene

    public function amigos()
    {
        $amigos = 0;

        foreach ($this->getRelaciones1() as $relacion) {
            if ($relacion->getSolicitud() == 0) {
                $amigos++;
            }
        }

        foreach ($this->getRelaciones2() as $relacion) {
            if ($relacion->getSolicitud() == 0) {
                $amigos++;
            }
        }

        return $amigos;
    }

    public function sonAmigos($otro_usuario)
    {
        foreach ($this->getRelaciones1() as $relacion) {
            if ($relacion->getUsuario2() == $otro_usuario && $relacion->getSolicitud() == 0) {
                return true;
            }
        }

        foreach ($this->getRelaciones2() as $relacion) {
            if ($relacion->getUsuario1() == $otro_usuario && $relacion->getSolicitud() == 0) {
                return true;
            }
        }

        return false;
    }
}
