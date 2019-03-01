<?php

namespace GolemAi\Microservice\RabbitMQ\DataTransformer;

interface DataTransformerInterface
{
    /**
     * Transform data into a string
     *
     * @param       $data
     * @param array $options
     *
     * @return string
     */
    public function transform($data, array $options): string;
}