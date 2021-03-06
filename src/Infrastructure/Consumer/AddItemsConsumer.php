<?php

namespace App\Infrastructure\Consumer;

use App\Application\AddItems\AddItemsCommand;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class AddItemsConsumer implements ConsumerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        $response = json_decode($msg->body, true);
        $command = new AddItemsCommand($response['id'], $response['quantity']);

        $this->commandBus->dispatch($command);
    }
}
