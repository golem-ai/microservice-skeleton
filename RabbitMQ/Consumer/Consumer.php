<?php

namespace GolemAi\Microservice\RabbitMQ\Consumer;

use GolemAi\Microservice\Consumer\Exception\MissingApplicationException;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Consumer implements ConsumerInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param AMQPMessage $msg
     *
     * @return mixed|bool
     *
     * @throws MissingApplicationException
     */
    public function execute(AMQPMessage $msg)
    {
        $deserializedMessage = json_decode($msg->getBody(), true);

        try {
            return $this->doExecute($deserializedMessage);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage(), ['message' => $msg->getBody()]);
        }
    }

    /**
     * @param array $msg
     *
     * @return mixed|bool
     */
    abstract protected function doExecute(array $msg);

    /**
     * @return OutputInterface
     */
    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    /**
     * @return InputInterface
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * @param InputInterface $input
     */
    public function setInput(InputInterface $input): void
    {
        $this->input = $input;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}