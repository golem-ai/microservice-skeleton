<?php

namespace GolemAi\Microservice\RabbitMQ\Consumer\Exception;

use Symfony\Component\Console\Application;

class MissingApplicationException extends \Exception
{
    protected $message = 'No application detected. Please provide an '.Application::class.' with setApplication().';
}