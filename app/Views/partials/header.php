<?php
// helpers visuais para alertas opcionais
function alertBox(?string $msg): string
{
    if (!$msg) return '';
    $map = [
        'created'  => ['Autor cadastrado com sucesso!', 'success'],
        'updated'  => ['Autor atualizado com sucesso!', 'success'],
        'excluido' => ['Autor excluído com sucesso!',  'success'],
        'notfound' => ['Autor não encontrado.',        'warning'],
        'validate' => ['Preencha nome e e-mail.',      'warning'],
    ];
    if (!isset($map[$msg])) return '';
    [$text, $type] = $map[$msg];
    return "<div class='alert {$type}'>{$text}</div>";
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>O Povo Autores— Autores</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body>
    <div class="container py-4">