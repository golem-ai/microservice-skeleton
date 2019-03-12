<?php

namespace GolemAi\Microservice\RabbitMQ\DataFormatter;

use GolemAi\Microservice\RabbitMQ\DataTransformer\DataTransformerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DataFormatter implements DataFormatterInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var DataTransformerInterface
     */
    private $dataTransformer;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        DataTransformerInterface $dataTransformer
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * Formats the given the data into a RabbitMQ request
     *
     * @param array $data
     * @param array $options
     *
     * @return string
     */
    public function format(array $data, array $options = []): string
    {
        $data = [
            'user' => null !== $this->tokenStorage->getToken() ? $this->tokenStorage->getToken()->getUser() : null,
            'data' => $data,
        ];

        if (isset($data['data']['hash'])) {
            $data['hash'] = $data['data']['hash'];
            unset($data['data']['hash']);
        }

        return $this->dataTransformer->transform($data, $options);
    }
}