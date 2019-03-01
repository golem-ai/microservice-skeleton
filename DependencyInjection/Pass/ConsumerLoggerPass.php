<?php

namespace GolemAi\Microservice\DependencyInjection\Pass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConsumerLoggerPass implements CompilerPassInterface
{
    const TAG = 'microservice.consumer';

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(self::TAG);

        foreach ($taggedServices as $serviceId => $tags) {
            $service = $container->findDefinition($serviceId);
            $service->addMethodCall('setLogger', [new Reference('monolog.logger.rabbit_logs')]);
        }
    }
}