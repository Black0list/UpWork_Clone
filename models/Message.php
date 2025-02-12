<?php

use App\models\User;

class Message
{
    private int $id;
    private User $sender;
    private User $receiver;
    private bool $is_read;


    public function __construct(User $sender , User $receiver ) {
        $this->sender = $sender;
        $this->receiver = $receiver;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setSender($sender)
    {
        $this->sender = $sender;
    }
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }
    public function setIsRead($is_read)
    {
        $this->is_read = $is_read;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getSender()
    {
        return $this->sender;
    }
    public function getReceiver()
    {
        return $this->receiver;
    }
    public function getIdRead()
    {
        return $this->is_read;
    }


    public function sendMessage(string $message)
    {
        
    }
}