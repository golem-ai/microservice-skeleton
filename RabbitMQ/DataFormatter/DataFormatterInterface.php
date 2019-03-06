<?php

namespace GolemAi\Microservice\RabbitMQ\DataFormatter;

interface DataFormatterInterface
{
    /**
     * Formats the given the data into a RabbitMQ request
     *
     * @param array $data
     * @param array $options
     *
     * @return string
     */
    public function format(array $data, array $options = []): string;
}