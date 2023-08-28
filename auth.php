<?php
require_once 'data/users.php';
require_once 'classes/Utils.php';

$enteredEmail = $_POST['email'];
$enteredPwd = $_POST['pwd'];

var_dump($enteredEmail);
var_dump($enteredPwd);

$foundUser = false;

foreach($users as $user){
    if($user->email === $enteredEmail && $user->password === $enteredPwd) {
        $foundUser=true;
        Utils::redirect('landing-page.php');
        break;
    } else {
        echo "authentification échouée";
        break;
    }
};