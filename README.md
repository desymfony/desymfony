Leeme
=====

Instalación realizada
--------------------

  1. Descargar la versión PR12 de la distribución estándar de Symfony sin vendors (tal y como recomiendan)
  2. Descomprimir y ejecutar el comando `bin/vendors.sh`
  3. Ejecutar el comando `bin/build_bootstrap.php`
  4. Ejecutar el comando `app/console assets:install web/`

**Nota**: he comentado una comprobación de validación en las líneas 354 a 356 del archivo `vendor/symfony/src/Symfony/Component/DependencyInjection/Loader/XmlFileLoader.php` (siempre me falla en este punto)

Modificaciones (Nacho):
  
  * Editado vendors para mantener sincronizada la app con el repositorio git de symfony (desligado de versión concreta).
  * Actualizado app/config/config.yml y app/config/parameters.ini por compatibilidad con Beta1.
  * He quitado vendor/* del repositorio (puesto en .gitignore). Si te sigue fallando en Beta1 lo que habías comentado, los reponemos (a mí me va).


Pasos para que cada uno se lo instale
-------------------------------------

  1. `mkdir desymfony`
  2. `git clone git@github.com:desymfony/desymfony.git desymfony`
  3. `git remote add origin git@github.com:desymfony/desymfony.git`
  4. `bin/vendors.sh`
  5. Para subir cambios al repositorio compartido:
    * La primera vez: `git push -u origin master`
    * Las siguientes veces: `git push`
  6. Crear un host local en `/etc/hosts` (ej. `127.0.0.1  desymfony.local`)
  7. Configurar un host virtual en Apache2:

```
# DESYMFONY 2011
<VirtualHost *:80>
    DocumentRoot   "/Users/javier/sfprojects/desymfony/web"
    DirectoryIndex app.php
    ServerName     desymfony.local

    <Directory "/Users/javier/sfprojects/desymfony/web">
        AllowOverride All
        Allow from All
    </Directory>
</VirtualHost>
```
  1. Ya deberías poder acceder a `http://desymfony.local`
  1. Si no funciona, la solución suele ser `chmod -R 777 app/cache app/logs` (`http://desymfony.local/app_dev.php` muestra errores)
