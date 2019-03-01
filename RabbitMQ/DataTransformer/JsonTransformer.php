<?php

namespace GolemAi\Microservice\RabbitMQ\DataTransformer;

use Symfony\Component\Serializer\SerializerInterface;

class JsonTransformer implements DataTransformerInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * AbstractDataTransformer constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Transform data into a string
     * @param $data
     * @return string
     */
    public function transform($data, array $options): string
    {
        $serialzierContext = [];

        if (isset($options['groups'])) {
            $serialzierContext['groups'] = $options['groups'];
        }

        return $this->serializer->serialize($data, 'json', $serialzierContext);
    }
}