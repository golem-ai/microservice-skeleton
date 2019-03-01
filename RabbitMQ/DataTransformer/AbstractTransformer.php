<?php

namespace GolemAi\Microservice\RabbitMQ\DataTransformer;

abstract class AbstractTransformer implements DataTransformerInterface
{
    /**
     * Transform data into a string
     *
     * @param       $data
     * @param array $options
     *
     * @return string
     */
    public function transform($data, array $options = []): string
    {
        if (!isset($data['logId'])) {
            $data['logId'] = uniqid();
        }

        return $this->doTransform($data, $options);
    }

    /**
     * Implementation of the transformation
     *
     * @param       $data
     * @param array $options
     *
     * @return mixed
     */
    abstract protected function doTransform($data, array $options = []);
}