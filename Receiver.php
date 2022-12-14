<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receiver
{
    private $rbConnection;
    private $rbChannel;

    public function __construct()
    {
        $this->rbConnection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        
        $this->setConfigsChannel();
        $this->setFunctionRbCallback();
    }

    public function setConfigsChannel()
    {
        $this->rbChannel = $this->rbConnection->channel();
        $this->rbChannel->queue_declare('hello', false, false, false, false);
        $this->Channel->basic_consume('hello', '', false, true, false, false, $this->Callback);
    }

    public function setFunctionRbCallback()
    {
        $this->rbCallback = function ($message) {
            echo "[x] recebido " . $message->body . "\n";
        };
    }
}

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo "[x] esperando por mensagens. Para sair pressione CTRL+C\n";

$callback = function ($message)
{
    echo "[x] recebido " . $message->body . "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}