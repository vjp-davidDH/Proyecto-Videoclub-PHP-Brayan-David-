# 🎬 Proyecto Videoclub - PHP

Este proyecto es una aplicación web desarrollada en **PHP** que simula la gestión de un videoclub. Permite administrar clientes y soportes (películas, juegos, etc.), con una interfaz de usuario para administradores y clientes.

## 📌 Descripción

El sistema permite dos roles de usuario:

*   **Administrador:**
    *   Iniciar sesión con credenciales predefinidas (`admin`/`admin`).
    *   Ver un listado de todos los clientes registrados.
    *   Crear nuevos clientes.
    *   Editar la información de los clientes existentes.
    *   Eliminar clientes.
    *   Ver un listado de todos los soportes disponibles en el videoclub.

*   **Cliente:**
    *   Iniciar sesión con sus credenciales.
    *   Ver su perfil y los soportes que tiene alquilados.
    *   Cerrar sesión.

El proyecto está estructurado siguiendo un modelo orientado a objetos, con clases para representar las entidades principales del sistema (Videoclub, Cliente, Soporte, etc.).

## ✨ Características

*   **Autenticación de usuarios:** Sistema de login para administradores y clientes.
*   **Gestión de clientes (CRUD):** Creación, lectura, actualización y eliminación de clientes por parte del administrador.
*   **Gestión de soportes:** Visualización de soportes disponibles.
*   **Interfaz de usuario diferenciada:** Paneles de control distintos para administradores y clientes.
*   **Programación Orientada a Objetos (POO):** El código está organizado en clases y objetos, lo que facilita su mantenimiento y escalabilidad.
*   **Manejo de excepciones:** Se utilizan excepciones personalizadas para gestionar errores de forma controlada.
*   **Carga automática de clases (Autoload):** Se utiliza un `autoload.php` para cargar las clases automáticamente, siguiendo el estándar PSR-4.

## 🛠️ Tecnologías Utilizadas

*   **PHP:** Lenguaje de programación principal del backend.
*   **HTML5:** Para la estructura de las páginas web.
*   **CSS3:** Para el diseño y la presentación de la interfaz de usuario.

## 📂 Estructura del Proyecto

```
/home/ubuntu/Proyecto-Videoclub-PHP-Brayan-David-
├── Interfaces
│   └── Resumible.php
├── LICENSE
├── Util
│   ├── ClienteNoEncontradoException.php
│   ├── CupoSuperadoException.php
│   ├── SoporteNoEncontradoException.php
│   ├── SoporteYaAlquiladoException.php
│   └── VideoclubException.php
├── app
│   └── Clases
│       ├── CintaVideo.php
│       ├── Cliente.php
│       ├── Dvd.php
│       ├── Juego.php
│       ├── Soporte.php
│       └── Videoclub.php
├── autoload.php
├── public
│   ├── createCliente.php
│   ├── css
│   │   ├── common.css
│   │   ├── formCreateCliente.css
│   │   ├── formUpdateCliente.css
│   │   ├── index.css
│   │   ├── main.css
│   │   ├── mainAdmin.css
│   │   └── mainCliente.css
│   ├── formCreateCliente.php
│   ├── formUpdateCliente.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── main.php
│   ├── mainAdmin.php
│   ├── mainCliente.php
│   ├── removeCliente.php
│   └── updateCliente.php
└── test
    ├── Codigos de Prueba
    │   ├── PruebaCintaVideo.php
    │   ├── PruebaCliente.php
    │   ├── PruebaDVD.php
    │   ├── PruebaJuego.php
    │   ├── PruebaSoporte.php
    │   └── PruebaVideoclub.php
    └── Excepciones.php
```

### Descripción de Directorios

*   **`/app/Clases`**: Contiene las clases principales del modelo de negocio (POO).
*   **`/public`**: Contiene los archivos PHP que gestionan las vistas y la interacción con el usuario, así como los archivos CSS para los estilos.
*   **`/Interfaces`**: Define las interfaces que deben implementar algunas clases.
*   **`/Util`**: Incluye las clases de excepciones personalizadas.
*   **`/test`**: Contiene scripts para probar las clases y funcionalidades del proyecto.
*   **`autoload.php`**: Script para la carga automática de clases.

## 🚀 Instalación y Uso

1.  **Configurar un entorno de desarrollo web:**
    *   Instalar un servidor web como Apache (se recomienda usar XAMPP, WAMP o MAMP).
    *   Asegurarse de tener PHP 7.4 o superior.

2.  **Desplegar el proyecto:**
    *   Copiar la carpeta del proyecto en el directorio `htdocs` (o `www`) de tu servidor web.

3.  **Acceder a la aplicación:**
    *   Abrir el navegador y acceder a `http://localhost/nombre_de_la_carpeta_del_proyecto/public/`.

4.  **Credenciales de acceso:**
    *   **Administrador:**
        *   Usuario: `admin`
        *   Contraseña: `admin`
    *   **Cliente:**
        *   Se pueden crear nuevos clientes desde el panel de administrador.

## 📄 Clases Principales

*   `Videoclub`: Clase principal que gestiona los clientes y soportes.
*   `Cliente`: Representa a un cliente del videoclub.
*   `Soporte`: Clase base abstracta para los diferentes tipos de soportes (DVD, Cinta de Vídeo, Juego).
*   `Dvd`, `CintaVideo`, `Juego`: Clases que heredan de `Soporte` y representan los tipos de productos que se pueden alquilar.

## ❗ Excepciones

Se han definido excepciones personalizadas para un mejor manejo de errores:

*   `ClienteNoEncontradoException`: Se lanza cuando no se encuentra un cliente.
*   `CupoSuperadoException`: Se lanza cuando un cliente intenta alquilar más soportes de los permitidos.
*   `SoporteNoEncontradoException`: Se lanza cuando no se encuentra un soporte.
*   `SoporteYaAlquiladoException`: Se lanza cuando se intenta alquilar un soporte que ya está alquilado.

## ✒️ Autor

Este proyecto fue desarrollado originalmente por **Brayan y David**. La reestructuración y mejora del código ha sido realizada por **Manus AI**.
