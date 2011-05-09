<?php

namespace Desymfony\DesymfonyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

use Desymfony\DesymfonyBundle\Entity\Ponente;
use Desymfony\DesymfonyBundle\Entity\Ponencia;
use Desymfony\DesymfonyBundle\Entity\Usuario;

class CargaFixturesCommand extends Command
{
    private $em = null;
    
    protected function configure()
    {
        $this
            ->setDefinition(array())
            ->setHelp('Carga los datos de prueba iniciales (fixtures) de la aplicación')
            ->setName('desymfony:carga-fixtures')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $em = $this->em;
        
        // -- Borrar toda la información de la base de datos ------------------
        $this->deleteDB();
        
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
                'biografia' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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
            
            $em->persist($ponente);
        }
        
        $em->flush();
        
        
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
          
          $em->persist($usuario);
        }
        $em->flush();
        
        
        // -- Cargar datos de PONENCIAS ---------------------------------------
        $ponencia = new Ponencia();
        $ponencia->setTitulo('El modelo. Doctrine2');
        $ponencia->setDescriptcion('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('now'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
          $this->entity('Ponente')->findOneByApellidos('Martín')
        );
        $ponencia = $this->addUsuarios($ponencia);
        
        $em->persist($ponencia);
        
        $ponencia = new Ponencia();
        $ponencia->setTitulo('La vista. Twig');
        $ponencia->setDescriptcion('Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
        $ponencia->setFecha(new \DateTime('now'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
          $this->entity('Ponente')->findOneByApellidos('Labad')
        );
        $ponencia = $this->addUsuarios($ponencia);
        
        $em->persist($ponencia);
        
        $ponencia = new Ponencia();
        $ponencia->setTitulo('Formularios');
        $ponencia->setDescriptcion('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('now'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
          $this->entity('Ponente')->findOneByApellidos('López')
        );
        $ponencia = $this->addUsuarios($ponencia);
        
        $em->persist($ponencia);
        
        $ponencia = new Ponencia();
        $ponencia->setTitulo('Backend');
        $ponencia->setDescriptcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $ponencia->setFecha(new \DateTime('now'));
        $ponencia->setDuracion(60);
        $ponencia->setIdioma('es');
        $ponencia->setPonente(
          $this->entity('Ponente')->findOneByApellidos('Eguiluz')
        );
        $ponencia = $this->addUsuarios($ponencia);
        
        $em->persist($ponencia);
        
        $em->flush();
        
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
        return $this->em->getRepository('Desymfony\\DesymfonyBundle\\Entity\\'.$entidad);
    }
    
    /**
     * Borra todos los datos relacionados con la entidad indicada
     *
     * @param string $entidad Nombre de la entidad cuya información se quiere eliminar de la base de datos
     */
    private function delete($entidad)
    {
      $items = $this->entity($entidad)->findAll();
      foreach ($items as $item) {
        $this->em->remove($item);
      }
      
      $this->em->flush();
    }
    
    /**
     * Borra toda la información de la base de datos
     *
     */
    private function deleteDB()
    {
      $this->em->getConnection()->executeUpdate('DELETE FROM ponencia_usuario');
      $this->em->getConnection()->executeUpdate('DELETE FROM ponente');
      $this->em->getConnection()->executeUpdate('DELETE FROM ponencia');
      $this->em->getConnection()->executeUpdate('DELETE FROM usuario');
    }
}
