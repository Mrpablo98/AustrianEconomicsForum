<?php


$hash=password_hash('contraseña', PASSWORD_DEFAULT);
if (password_verify("contraseña", $hash)) {
    echo 'Password is valid!';
   
} else {
    echo 'Invalid password.';
}
?>
