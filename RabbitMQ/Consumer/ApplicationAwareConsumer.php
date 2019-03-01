<?php

namespace GolemAi\Microservice\RabbitMQ\Consumer;

use GolemAi\Microservice\RabbitMQ\Consumer\Exception\MissingApplicationException;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Application;

abstract class ApplicationAwareConsumer extends Consumer
{
    /**
     * @var Application
     */
    private $application;

    public function setApplication(Application $application)
    {
        $this->application = $application;
    }

    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param AMQPMessage $msg
     *
     * @return mixed|bool
     *
     * @throws MissingApplicationException
     */
    public function execute(AMQPMessage $msg) {
        if (!$this->getApplication() instanceof Application) {
            throw new MissingApplicationException();
        }

        parent::execute($msg);
    }
}