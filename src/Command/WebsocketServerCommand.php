<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Websocket\MessageHandler;

#[AsCommand(
    name: 'websocket:server:start',
    description: 'Creates users and stores them in the database'
)]
class WebsocketServerCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = 3001; //8080
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new MessageHandler()
                )
            ),
            $port
        );
        $server->run();

        return 0;
    }
}