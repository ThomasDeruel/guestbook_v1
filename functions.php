<?php
function nav_item(string $url, string $name, string $classLink) {
    $class = $classLink;
    if($classLink !== '' && $_SERVER['SCRIPT_NAME'] === $url) {
        $class .= " active";
    }
    $html = "
        <li class='$class'>
            <a class='$classLink' href='$url'> $name </a>
        </li>
    ";
    return $html;
};

function menu(string $classLink = '') {
    return 
        nav_item('/index.php', 'Accueil', $classLink ) .
        nav_item('/guestbook.php', 'Livre d\'or', $classLink );
}

function dump($array) {
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}
    