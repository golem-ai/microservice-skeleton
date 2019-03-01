<?php

namespace GolemAi\Microservice\RabbitMQ\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\Producer;

trait ProducerAwareConsumerTrait
{
    /**
     * @var Producer
     */
    protected $producer;

    /**
     * @return Producer
     */
    public function getProducer(): Producer
    {
        return $this->producer;
    }

    /**
     * @param Producer $producer
     */
    public function setProducer(Producer $producer): void
    {
        $this->producer = $producer;
    }
}