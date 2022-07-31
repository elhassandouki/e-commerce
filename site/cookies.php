<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(isset($_POST['save'])){
        $s = $_POST['save'];
        if($s){
            setcookie('email', $email , time() + 3600);
            setcookie('password',$password , time() + 3600);
        }
    }
    header("location:contactez.php?e=$email&pw=$password");
}




