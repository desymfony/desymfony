<?php

namespace Desymfony\DesymfonyBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class DesymfonyExtension extends Extension
{

    public function load(array $config, ContainerBuilder $container)
    {

        $definition = new Definition('Desymfony\DesymfonyBundle\Extension\DesymfonyTwigExtension');
        $definition->addTag('twig.extension');
        $container->setDefinition('desymfony_twig_extension', $definition);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('twig_core_extension.yml');
    }
}
