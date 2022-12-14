<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receiver
{
    private $rbConnection;
    private $rbChannel;

    private $queue = 'product_order';
    
    private $passive = false;
    private $durable = false;
    private $exclusive = false;
    private $auto_delete = false;
    private $nowait = false;
    private $arguments = array();
    private $ticket = null;

    private $consumer_tag = '';
    private $no_local = false;
    private $no_ack = false;
    private $callback = false;


    public function __construct()
    {
        $this->rbConnection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        
        $this->setConfigsChannel();
        $this->setFunctionRbCallback();
    }

    public function setConfigsChannel()
    {
        $this->rbChannel = $this->rbConnection->channel();
        $this->rbChannel->queue_declare(
            $this->queue,
            $this->passive,
            $this->durable,
            $this->exclusive,
            $this->auto_delete,
            $this->nowait,
            $this->arguments,
            $this->ticket
        );
        $this->Channel->basic_consume(
            $this->queue,
            $this->consumer_tag,
            $this->no_local,
            $this->no_ack,
            $this->exclusive,
            $this->nowait,
            $this->callback,
            $this->ticket,
            $this->arguments
        );
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