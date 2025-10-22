<?php
require_once '../../config/database.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    $sql = "DELETE FROM autores WHERE cod_pessoa = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: /opovo_TaissaRodrigues/public/authors/search.php?msg=excluido");
        exit;
    } else {
        mensagemError('Erro ao excluir: ' . mysqli_error($conn), 'danger');
    }
    mysqli_stmt_close($stmt);
} else {
    mensagemError('ID inválido para exclusão.', 'warning');
}
mysqli_close($conn);
