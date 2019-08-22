<?php
class Message {
    const minimumLength = 2;

    public $username;
    public $message;
    public $date;

    public function __construct(string $username, string $message, $date = null) {
        $this->username = htmlentities($username);
        $this->message = htmlentities($message);
        $this->date = $date;
    }

    public function isValid() {
        return !empty($this->username) &&
               strlen($this->username) > self::minimumLength && 
               !empty($this->message)&&  
               strlen($this->message) > self::minimumLength;
    }

    public function toHTML(){
        $html_message = nl2br($this->message);
        $dates = explode(" ",$this->date);
        return "
        <div class='message'>
        <strong>Par {$this->username}, </strong><i>le {$dates[0]} à {$dates[1]}</i>
        <p>{$html_message}</p>
        </div>";
    }
    public function toJson(){
        $date_now = new DateTime('now', new DateTimeZone('Europe/Paris'));
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $date_now->format('d-m-y H\hi')
        ]).PHP_EOL;
    }

    public static function fromJson($json) : Message{
        $element = json_decode($json,true);
        return new Message($element['username'], $element['message'], $element['date']);
    }

    public function getErrors() {
        $errors = null;
        if(empty($this->username) || strlen($this->username) <= self::minimumLength) {
            $errors['username'] = "<i style='color:red;'>Votre nom dois contenir au moins 3 caractères</i>";
        }
        if(empty($this->message) || strlen($this->message) <= self::minimumLength) {
            $errors['message'] = "<i style='color:red;'>Votre message contenir au moins 3 caractères</i>";
        }
        return $errors;
    }
}