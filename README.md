Proyecto Desymfony
==================

Este repositorio alberga el código de la aplicación de prueba desarrollada
durante el primer día de las [Jornadas Symfony 2011](http://desymfony.com).

Sobre el proyecto
-----------------

La aplicación consiste en el desarrollo del sitio web ficticio de las propias 
Jornadas Symfony. Su finalidad es didáctica, por lo que ha sido necesario 
realizar algunas simplificaciones en su funcionamiento y arquitectura. No 
obstante, la aplicación sigue la filosofía y buenas prácticas recomendadas por 
Symfony2.

Cómo descargar y probar el proyecto
-----------------------------------

### Instalación ###

  1. Crea un directorio para el proyecto: `mkdir /proyectos/desymfony`
  2. Clona el repositorio en ese directorio:
  `git clone git@github.com:desymfony/desymfony.git /proyectos/desymfony`
  3. Descarga/actualiza las librerías externas de Symfony2: 
  `/proyectos/desymfony/bin/vendors.sh` (espera un buen rato)

Para probarlo más cómodamente, crea un *host virtual* en tu servidor web local. 
Añade en primer lugar `127.0.0.1    desymfony.local` en el archivo `/etc/hosts`. 
Después, configura el *host* en el servidor web:

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

Reinicia el servidor web y accede a `http://desymfony.local/app_dev.php` para 
acceder al proyecto en el entorno de desarrollo. El entorno de producción es 
accesible en `http://desymfony.local/`

Si se produce algún error, es posible que el servidor no tenga permiso de 
escritura en los directorios de la caché y e los logs. Ejecuta `chmod -R 777 
/proyectos/desymfony/app/cache /proyectos/desymfony/app/logs` y el error ya no 
debería repetirse.

### Probando el proyecto ###

Para probar mejor el proyecto, es recomendable cargar los datos de prueba 
(*fixtures*) de la aplicación ejecutando el siguiente comando:

```
php /proyectos/desymfony/app/console doctrine:fixtures load
```

El comando anterior crea varias ponencias y ponentes de prueba, 100 usuarios 
aleatorios y asigna 50 usuarios a cada ponencia. 

#### Parte pública o *frontend* ####

Puedes acceder a la parte pública en `http://desymfony.local/app_dev.php` 
(entorno de desarrollo) y `http://desymfony.local/` (entorno de producción).

La aplicación es tan sencilla que todas sus secciones son auto-explicativas.

Si quieres crear más usuarios de prueba, puedes hacerlo en la sección 
*registro*. Para acceder a la aplicación como un usuario registrado, pincha el 
enlace *accede aquí* dentro de la sección *registro*.

#### Parte de administración o *backend* ####

La parte de administración de la aplicación se accede desde 
`http://desymfony.local/app_dev.php/admin` (entorno de desarrollo) o 
`http://desymfony.local/admin` (entorno de producción).

Las credenciales por defecto para acceder al *backend* son:

  * **usuario**: `desymfony`
  * **password**: `desymfony`

Puedes cambiar las credenciales en el archivo 'app/config/security.yml'.

Sobre los autores
-----------------

El proyecto ha sido desarrollado por:

  * Albert Jessurum (@ajessu)
  * Nacho Martín (@nacmartin)
  * Javier López (@loalf)
  * Marcos Labad (@esmiz)
  * David Castelló (@dcastello)
  * Javier Eguiluz (@javiereguiluz)
