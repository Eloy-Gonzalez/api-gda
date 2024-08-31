# API REST (GDA) con Laravel 10 🤓

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Requerimientos minimos 

* GIT [Link](https://git-scm.com/downloads)
* MySQL [Link](https://www.mysql.com/downloads/) o [MariaDB](https://mariadb.org/download/).
* PHP Version 7.4^ [Link](https://www.php.net/downloads.php).
* Manejador de dependencias de PHP [Composer](https://getcomposer.org/download/).

### Instalación y Configuración 🔧

Paso a paso de lo que debes ejecutar para tener el proyecto ejecutandose
    
 1. clona el repositorio dentro de la carpeta de tu servidor con el siguiente comando:
    ```
    git clone https://github.com/Eloy-Gonzalez/api-gda.git
    ```

 2. Ingresa a la carpeta del repositorio
    ```
    cd api-gda
    ```

 3. Instala las dependencias del proyecto
    ```
    composer install
    ```

 4. Crea el archivo ".env" copiando la información del [ejemplo](https://github.com/Eloy-Gonzalez/api-gda.git/blob/main/.env.example) y cambiar valores de su Base de datos.

 5. Crea una llave de seguridad para laravel
    ```
    php artisan key:generate
    ```
    
 6. Ejecute las migraciones
    ```
    php artisan migrate --seed
    ```

 7. Inicialice el servidor local
    ```
    php artisan serve
    ```

 8. Listo, ya podrá interactuar con la API en local  😁

### Definicion de servicios

  1. Autenticacion (Login)
    ```
    endpoint: api/login,
    method: POST,
    bearerAuth: false
    params : {
      "email": {
        type: string,
        required: true
        in: body
      },
      "password": {
        type: string,
        required: true,
        in: body
      },
    },
    response: {
      "type": "string",
      "title": "string",
      "message": "string",
      "token": "string",
      "user": "object"
    }
    ```
  2. Clientes/Customers
    ```
    endpoint: api/customers,
    method: GET,
    bearerAuth: {
      type: http
      scheme: bearer
      bearerFormat: JWT
    },
    params: {
      "dni": {
        type: string,
        required: false,
        in: queryString
      },
      "email": {
        type: string,
        required: false,
        in: queryString
      },
    },
    response: {
      "current_page": integer,
      "data": "array",
      "first_page_url": "string",
      "from": "string",
      "last_page": "integer",
      "last_page_url": "string",
      "links": "array",
      "next_page_url": "string",
      "path": "string",
      "per_page": "integer",
      "prev_page_url": "string",
      "to": "integer",
      "total": "integer"
    }
    ```
  3. Clientes/Customers
    ```
    endpoint: api/customers
    method: POST,
    bearerAuth: {
      type: http
      scheme: bearer
      bearerFormat: JWT
    },
    params: {
      "dni": {
        type: string,
        required: true,
        in: body
      },
      "id_reg": {
        type: integer,
        required: true,
        in: body
      },
      "id_com": {
        type: integer,
        required: true,
        in: body
      },
      "email": {
        type: string,
        required: true,
        in: body
      },
      "name": {
        type: string,
        required: true,
        in: body
      },
      "last_name": {
        type: string,
        required: true,
        in: body
      }
    },
    response: {
      "type": "string",
      "title": "string",
      "message": "string",
      "customer": "object"
    }
    ```
  4. Clientes/Customers
    ```
    endpoint: api/customers
    method: DELETE,
    bearerAuth: {
      type: http
      scheme: bearer
      bearerFormat: JWT
    },
    params: {
      "dni": {
        type: string,
        required: true,
        in: queryString
      },
    },
    response: {
      "type": "string",
      "title": "string",
      "message": "string",
    }
    ```