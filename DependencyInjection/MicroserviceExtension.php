<?php

namespace GolemAi\Microservice\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MicroserviceExtension extends Extension
{
    /**
     * Loads a specific configuration.
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/config/');
        $loader = new YamlFileLoader($container, $fileLocator);

        $loader->load('services.yaml');
    }
}