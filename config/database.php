<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$dbname = "empresa";

if (mysqli_connect($server, $user, $pass, $dbname)) {
    echo "Conectado!";
} else {
    echo "Erro na conexão: " . mysqli_connect_error();
}
