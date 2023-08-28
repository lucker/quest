<?php

namespace App\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;


class MessageHandler implements MessageComponentInterface
{
    protected \SplObjectStorage $clients;


    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo $msg;
        //$numRecv = count($this->clients) - 1;
        /*echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');*/

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $conn->close();
    }
}