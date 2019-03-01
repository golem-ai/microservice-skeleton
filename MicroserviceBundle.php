<?php

namespace GolemAi\Microservice;

use GolemAi\Microservice\Consumer\Consumer;
use GolemAi\Microservice\DependencyInjection\Pass\ConsumerLoggerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MicroserviceBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new ConsumerLoggerPass())
            ->registerForAutoconfiguration(Consumer::class)
            ->addTag(ConsumerLoggerPass::TAG)
        ;
    }
}