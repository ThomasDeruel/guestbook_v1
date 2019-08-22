<?php 
$title = "Livre d'or";
require "config.php";

require Exports::layout('header');
require Exports::class('Message');
require Exports::class('GuestBook');

$error = null;
$sucess = null;
$errorlist = [];

if(isset($_POST['username']) && isset($_POST['message'])) {
    $new_message = new Message($_POST['username'],$_POST['message']);
    if($new_message->isValid()) {
        $success = true;
        $guestbook = new GuestBook(__DIR__. DIRECTORY_SEPARATOR . "guestbook");
        $guestbook->addMessage($new_message);
    } else {
        $error = true;
        $errorlist = $new_message->getErrors();
    }
}
$messages = (new GuestBook(__DIR__. DIRECTORY_SEPARATOR . "guestbook"))->getMessages();
?>
  <div class="starter-template">
      <?php if($success) :?>
      <div class="alert alert-success" role="alert">
        Votre message a été <b>envoyé</b> !
    </div>

      <?php elseif($error) : ?>
        <div class="alert alert-danger" role="alert">
            Une erreur est <b>survenue</b> ! 
        </div>
      <?php endif ?>
    <h1>Livre D'or</h1>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="nom">
            <?= $error && !empty($errorlist['username']) ? $errorlist['username'] : ''?>
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control" name="message" placeholder="message" rows="5"></textarea>
            <?= $error && !empty($errorlist['message']) ? $errorlist['message'] : ''?>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form><br/>
    <h2>Nos commentaires</h2>
    <div class="row">
        <div class="col-md-12">
            <?php
            
            $i = count($messages) - 1;
            while ($i > -1){
                echo $messages[$i]->toHTML();
                $i -= 1;
            }
     
            ?>
        </div>
    </div>
  </div>

<?php require Exports::layout('footer'); ?>