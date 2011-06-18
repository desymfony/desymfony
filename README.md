Proyecto Desymfony
==================

Este repositorio alberga el código fuente de la aplicación-tutorial 
desarrollada durante el primer día de las [Jornadas Symfony 2011](http://desymfony.com).

Sobre la aplicación
-------------------

La aplicación desarrollada es el sitio web ficticio de las propias Jornadas 
Symfony. Su finalidad es didáctica, por lo que ha sido necesario realizar 
algunas simplificaciones en su funcionamiento y arquitectura. No obstante, la 
aplicación sigue la filosofía y buenas prácticas recomendadas por Symfony2.

Instalación y configuración
---------------------------

### Instalación ###

  1. Crea un directorio para el proyecto: `mkdir /proyectos/desymfony`
  2. Clona el repositorio `desymfony` en ese directorio:
  `git clone git@github.com:desymfony/desymfony.git /proyectos/desymfony`
  3. Ejecuta el comando `/proyectos/desymfony/bin/vendors.php` para descargar
  o actualizar las librerías externas de Symfony2. Este comando puede tardar
  un buen rato en completarse.

### Configuración de la base de datos ###

La aplicación necesita una base de datos de tipo SQL para guardar su 
información. Por defecto el proyecto utiliza una base de datos local llamada
`desymfony` a la que puede acceder un usuario llamado también `desymfony` y 
cuya contraseña es `desymfony`.

Si quieres utilizar otros valores o tu base de datos no es MySQL, puedes 
configurarlo en las primeras líneas del archivo `app/config/parameters.ini`:

```ini
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_name="desymfony"
    database_user="desymfony"
    database_password="desymfony"
```

Una vez configurado el acceso a la base de datos, debes crear la base de datos 
del proyecto y toda su estructura de tablas. Para ello, ejecuta los dos
siguientes comandos:

```
php app/console doctrine:database:create
php app/console doctrine:schema:create
```

### Configuración del servidor web ###

Para probar el proyecto fácilmente, es recomendable crear un *host virtual* en 
tu servidor web local. Añade en primer lugar la siguiente línea en el archivo 
`/etc/hosts`:

```
127.0.0.1    desymfony.local
```

Después, configura el *host* en el servidor web. Si utilizas por ejemplo 
Apache, debes añadir lo siguiente en su archivo de configuración:

```
# Desymfony 2011
<VirtualHost *:80>
    DocumentRoot   "/proyectos/desymfony/web"
    DirectoryIndex app.php
    ServerName     desymfony.local

    <Directory "/proyectos/desymfony/web">
        AllowOverride All
        Allow from All
    </Directory>
</VirtualHost>
```

Para terminar, no olvides reiniciar el servidor web.

### Probando el proyecto ###

Después de la configuración anterior, ya puedes acceder al entorno de 
desarrollo de la aplicación en `http://desymfony.local/app_dev.php`. El 
entorno de producción es accesible en `http://desymfony.local/`

Si se produce algún error, es posible que el servidor web no tenga permiso de 
escritura en los directorios de la caché y de los logs. Ejecuta `chmod -R 777 
/proyectos/desymfony/app/cache /proyectos/desymfony/app/logs` y el error ya no 
debería mostrarse.

Para probar mejor el proyecto, es muy recomendable cargar los datos de prueba
(*fixtures*) de la aplicación.

Primero, recuerda que debes haber creado el schema en MySQL con el siguiente
comando:

```
php /proyectos/desymfony/app/console doctrine:schema:create
```

Ahora, ejecuta el siguiente comando para cargar los datos de prueba:

```
php /proyectos/desymfony/app/console doctrine:fixtures:load
```

El comando anterior guarda en la base de datos la información sobre las
ponencias y los ponentes de las Jornadas Symfony. Además crea 100 usuarios
ficticios y asigna a cada ponencia entre 20 y 50 usuarios elegidos
aleatoriamente.

#### Parte pública o *frontend* ####

Puedes acceder a la parte pública en `http://desymfony.local/app_dev.php` 
(entorno de desarrollo) y `http://desymfony.local/` (entorno de producción).

Si quieres utilizar todas las características de la aplicación, debes acceder
como un usuario registrado. Para ello, pulsa el enlace *Haz login* que se
muestra en el lateral de todas las páginas.

Las credenciales por defecto para acceder al *frontend como usuario* son:

  * **usuario**: usuario**X**@desymfony.com
  * **password**: usuario**X**

  Donde la **X** es cualquier número del 1 al 100.

  **Nota**: Estos usuarios sólo funcionan si has usado el comando
  `doctrine:fixtures:load`, para cargar los datos de prueba (*fixtures*).

También puedes registrarte como nuevo usuario. Para ello pulsa el botón
*Regístrate* que se muestra en el lateral de todas las páginas.

#### Parte de administración o *backend* ####

La parte de administración de la aplicación se accede desde 
`http://desymfony.local/app_dev.php/admin` (entorno de desarrollo) o 
`http://desymfony.local/admin` (entorno de producción).

Por defecto existen dos usuarios de tipo administrador. Sus credenciales de
acceso son las siguientes:

  * Primer usuario:
      * **usuario**: `desymfony`
      * **password**: `desymfony`
  * Segundo usuario:
      * **usuario**: `admin`
      * **password**: `admin`

Puedes cambiar sus credenciales o crear nuevos usuarios de tipo administrador
en el archivo `app/config/security.yml`.

### Sobre tests ###

Para correr los tests hay que generar los proxies de entidades con:

    php console --env=test doctrine:generate:proxies

Sobre los autores
-----------------

El proyecto ha sido desarrollado por:

  * Albert Jessurum (@ajessu)
  * Nacho Martín (@nacmartin)
  * Javier López (@loalf)
  * Marcos Labad (@esmiz)
  * David Castelló (@dcastello)
  * Javier Eguiluz (@javiereguiluz)
