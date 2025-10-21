<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$dbname = "empresa";

$conn = mysqli_connect($server, $user, $pass, $dbname);
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

function mensagemError($texto, $tipo)
{
    echo "<div class='alert alert-$tipo role = 'alert'> $texto
    </div>";
}
