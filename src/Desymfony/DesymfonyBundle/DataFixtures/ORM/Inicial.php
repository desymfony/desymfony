<?php
namespace Desymfony\Desymfony\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Desymfony\DesymfonyBundle\Entity\Usuario,
    Desymfony\DesymfonyBundle\Entity\Ponencia,
    Desymfony\DesymfonyBundle\Entity\Ponente;

class LoadUserData implements FixtureInterface
{
    protected $manager;
    public function load($manager)
    {
        $this->manager = $manager;
        // -- Cargar datos de PONENTES ----------------------------------------
        $ponentes = array(
            'javierLopez' => array(
                'nombre'    => 'Javier',
                'apellidos' => 'López',
                'biografia' => 'Javier es co-fundador de Flai Webnected, una empresa especializada en el desarrollo de aplicaciones con este framework. Además de programar, también imparte clases de PHP en la Universidad de Córdoba.',
                'telefono'  => '600XXXXXX',
                'url'       => 'http://www.loalf.com/',
                'email'     => 'javier@xxx.xx',
                'linkedin'  => 'http://es.linkedin.com/in/loalf',
                'twitter'   => 'http://www.twitter.com/loalf'
            ),
            'nachoMartin'   => array(
                'nombre'    => 'Ignacio',
                'apellidos' => 'Martín',
                'biografia' => 'Nacho es un programador y emprendedor con una buena lista de proyectos Symfony a sus espaldas. Entusiasta del software libre y de las buenas prácticas, cuando no está frente a una consola con un Vim abierto nota que le falta algo.',
                'telefono'  => '600XXXXXX',
                'url'       => 'http://www.nacho-martin.com',
                'email'     => 'nacho@xxx.xx',
                'linkedin'  => 'http://www.linkedin.com/in/ignaciomartinlat',
                'twitter'   => 'http://twitter.com/nacmartin'
            ),
            'marcosLabad'   => array(
                'nombre'    => 'Marcos',
                'apellidos' => 'Labad',
                'biografia' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'telefono'  => '600XXXXXX',
                'url'       => 'http://www.quevidaesta.com',
                'email'     => 'marcos@xxx.xx',
                'linkedin'  => 'http://www.linkedin.com/in/marcoslabad',
                'twitter'   => 'http://twitter.com/esmiz'
            ),
            'javierEguiluz' => array(
                'nombre'    => 'Javier',
                'apellidos' => 'Eguiluz',
                'biografia' => 'Javier es el fundador de symfony.es, el sitio web más influyente de la comunidad hispana de Symfony. Programador apasionado por Symfony desde sus primeras versiones, actualmente se dedica a la formación.',
                'telefono'  => '600XXXXXX',
                'url'       => 'http://javiereguiluz.com',
                'email'     => 'javier@xxx.xx',
                'linkedin'  => 'http://www.linkedin.com/in/javiereguiluz',
                'twitter'   => 'http://www.twitter.com/javiereguiluz'
            )
        );

        foreach ($ponentes as $datosPonente) {
            $ponente = new Ponente();

            foreach ($datosPonente as $propiedad => $valor) {
                $setter = 'set'.ucfirst($propiedad);
                $ponente->{$setter}($valor);
            }

            $manager->persist($ponente);
        }

        $manager->flush();


        // -- Cargar datos de USUARIOS ----------------------------------------
        foreach (range(1, 100) as $i) {
            $usuario = new Usuario();

            $usuario->setNombre('Anónimo '.$i);
            $usuario->setApellidos('Apellido1 Apellido2');
            $usuario->setDni('00000000T');
            $usuario->setDireccion('Calle '.$i);
            $usuario->setTelefono('600XXXXXX');
            $usuario->setEmail('usuario'.$i.'@xxx.xx');
            $usuario->setPassword('usuario'.$i);

            $manager->persist($usuario);
        }
        $manager->flush();


        // -- Cargar datos de PONENCIAS ---------------------------------------
        $ponencia = new Ponencia();
        $ponencia->setTitulo('El modelo. Doctrine2');
        $ponencia->setDescripcion('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('2011-07-01'));
        $ponencia->setHora(new \DateTime('9:00:00'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
            $this->entity('Ponente')->findOneByApellidos('Martín')
        );
        $ponencia = $this->addUsuarios($ponencia);

        $manager->persist($ponencia);

        $ponencia = new Ponencia();
        $ponencia->setTitulo('La vista. Twig');
        $ponencia->setDescripcion('Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
        $ponencia->setFecha(new \DateTime('2011-07-01'));
        $ponencia->setHora(new \DateTime('10:00:00'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
            $this->entity('Ponente')->findOneByApellidos('Labad')
        );
        $ponencia = $this->addUsuarios($ponencia);

        $manager->persist($ponencia);

        $ponencia = new Ponencia();
        $ponencia->setTitulo('Formularios');
        $ponencia->setDescripcion('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('2011-07-02'));
        $ponencia->setHora(new \DateTime('9:00:00'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
            $this->entity('Ponente')->findOneByApellidos('López')
        );
        $ponencia = $this->addUsuarios($ponencia);

        $manager->persist($ponencia);

        $ponencia = new Ponencia();
        $ponencia->setTitulo('Backend');
        $ponencia->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('2011-07-02'));
        $ponencia->setHora(new \DateTime('10:00:00'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
            $this->entity('Ponente')->findOneByApellidos('Eguiluz')
        );
        $ponencia = $this->addUsuarios($ponencia);

        $manager->persist($ponencia);

        $manager->flush();

    }

    /**
     * Añade usuarios aleatoriamente a una ponencia asegurándose de que no se repita un mismo usuario
     *
     * @param $entidad Entidad a la que se añaden los usuarios
     * @param string $limite Número de usuarios que se añade en cada ponencia
     * @return La misma entidad pero con los usuarios añadidos
     */
    private function addUsuarios($entidad, $num = 50)
    {
        $usuarios = $this->entity('Usuario')->findAll();
        $asistentes = array();

        for ($i=0; $i<$num; $i++) {
            $asistente = $usuarios[rand(0, count($usuarios)-1)];

            while (in_array($asistente->getId(), $asistentes)) {
                $asistente = $usuarios[rand(0, count($usuarios)-1)];
            }
            $asistentes[] = $asistente->getId();

            $entidad->addUsuarios($asistente);
        }

        return $entidad;
    }

    /*
     * Devuelve una instancia del repositorio asociado con la entidad cuyo nombre se indica
     */
    private function entity($entidad)
    {
        return $this->manager->getRepository('Desymfony\\DesymfonyBundle\\Entity\\'.$entidad);
    }
}
