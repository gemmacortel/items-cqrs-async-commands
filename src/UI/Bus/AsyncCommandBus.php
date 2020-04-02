<?php

namespace App\UI\Bus;

use App\UI\Producer\Producer;

class AsyncCommandBus
{
    /**
     * @var Producer
     */
    private $producer;

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    public function dispatch(array $data)
    {
        $rabbitMessage = json_encode($data);

        $this->producer->setContentType('application/json');
        $this->producer->publish($rabbitMessage);
    }
}
