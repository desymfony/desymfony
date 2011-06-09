<?php

namespace Desymfony\DesymfonyBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class DesymfonyExtension extends Extension
{

    public function load(array $config, ContainerBuilder $container)
    {

        $definition = new Definition('Desymfony\DesymfonyBundle\Extension\DesymfonyTwigExtension');
        $definition->addTag('twig.extension');
        $container->setDefinition('desymfony_twig_extension', $definition);
    }

    public function getAlias() {
          return 'desymfony'; // that's how we'll call this extension in configuration files
    }

}
