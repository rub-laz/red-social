# 🌐 Proyecto: Red Social con Symfony, Twig y MySQL

Este repositorio contiene una **red social completa** desarrollada con el framework **Symfony (PHP)**, utilizando **Twig** como motor de plantillas y **JavaScript** para mejorar la interacción del usuario en el frontend. Todos los datos son persistidos en una base de datos **MySQL**.

El proyecto reúne las funcionalidades esenciales de una red social moderna: publicaciones, reacciones, comentarios, gestión de perfil, sistema de amistades y un buscador de usuarios.

---

## ⚙️ Tecnologías Utilizadas

- **Symfony (PHP)**  
  Symfony es un **framework web moderno y robusto** basado en PHP que sigue el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**. Permite construir aplicaciones web escalables y seguras, con una estructura bien organizada y componentes reutilizables. Entre sus ventajas destacan:
  - Inyección de dependencias integrada.
  - Sistema de rutas flexible.
  - ORM mediante Doctrine para interactuar con la base de datos.
  - Seguridad avanzada (autenticación, autorización, CSRF, etc.).

- **Twig**  
  Twig es el motor de plantillas de Symfony. Facilita la creación de interfaces limpias y mantenibles con estructuras de control, herencia de plantillas y filtrado de contenido.

- **JavaScript**  
  Utilizado en el frontend para funcionalidades como:
  - Reacciones dinámicas (like/dislike).
  - Carga y envío de formularios AJAX.
  - Comprobación de campos del perfil en tiempo real.

- **MySQL**  
  Sistema de gestión de bases de datos relacional. Se utiliza para almacenar:
  - Usuarios, perfiles y relaciones de amistad.
  - Publicaciones, imágenes y comentarios.
  - Likes, dislikes y notificaciones.

---

## 🧩 Funcionalidades Principales

### 🏠 Página Principal
- Feed de publicaciones de tus amigos.
- Cada publicación permite:
  - Dar **like** o **dislike**.
  - Dejar un **comentario**.
  - Visualizar reacciones y respuestas en tiempo real.

### 👤 Perfil de Usuario
- Edición de:
  - Nombre de usuario.
  - Foto de perfil.
  - Descripción personal.
- Visualización de publicaciones propias.
- Gestión de **solicitudes de amistad** (aceptar/rechazar).
- Publicación de contenido:
  - Texto.
  - Imágenes.

### 🔍 Buscador de Usuarios
- Búsqueda de perfiles por nombre de usuario.
- Posibilidad de enviar solicitudes de amistad desde los resultados.

