<?php
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash dari password '$password' adalah:\n";
echo $hash;
