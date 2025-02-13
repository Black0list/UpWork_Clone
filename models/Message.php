<?php
namespace App\models;
use App\config\Database;
use App\models\User;
use PDO;

class Message
{
    private int $id;
    private User $sender;
    private User $receiver;
    private bool $is_read;
    private string $firstname;
    private String $lastname;


    public function __construct() {
        $this->sender = new User;
        $this->receiver = new User;
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
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }


    public function create(string $message)
    {
        $Db = Database::getInstance()->getConnection();
        $query = "INSERT INTO message (sender_id , receiver_id , content , is_read) VALUES (" . $this->sender->getId() ." , ".$this->receiver->getId()." , " . $message ." , 'false');";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
        $this->setId($Db->lastInsertId());
    }


    public function getAll()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT content firstname , lastname  
        FROM utilisateur
        right JOIN message
        ON  message.sender_id = ".$this->sender->getId() ."  and message.receiver_id = ".$this->receiver->getId() ." 
		and utilisateur.id = message.sender_id
	 	ORDER BY date desc;";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS , Message::class);
    }
    
}