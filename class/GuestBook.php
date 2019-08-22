<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "Message.php";
class GuestBook {

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function addMessage(Message $message) {
        file_put_contents($this->file,$message->toJson(),FILE_APPEND);
    }

    public function getMessages() {
        $getContents = file($this->file);
        foreach($getContents as $content) {
            $data[] = Message::fromJson($content, true);
        }
        return $data;
    }

}