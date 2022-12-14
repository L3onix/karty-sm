<?php

class DbConnectionFactory
{
    private $serverAddress;
    private $userName;
    private $userPass;

    public function __construct(
        $serverAddress = 'localhost',
        $userName = 'karty_user',
        $userPass = 'karty_pass'
    )
    {
        $this->serverAddress = $serverAddress;
        $this->userName = $userName;
        $this->userPass = $userPass;
    }

    public function getConnection()
    {
        return new \Mysqli($this->servername, $this->username, $this->password);
    }
}