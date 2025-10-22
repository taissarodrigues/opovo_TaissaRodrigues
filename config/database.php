<?php
function db(): mysqli
{
    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $dbname = "empresa";

    $conn = mysqli_connect($server, $user, $pass, $dbname);
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }
    return $conn;
}

function mensagemError($texto, $tipo)
{
    echo "<div class='alert {$tipo}'>{$texto}</div>";
}

function mostra_data($data)
{
    if (!$data) return '';
    $d = explode('-', $data);
    return (count($d) === 3) ? "{$d[2]}/{$d[1]}/{$d[0]}" : $data;
}
