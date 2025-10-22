<?php
require_once '../../config/database.php';

// id do autor vindo da querystring
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Se for POST, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPost          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nome            = trim($_POST['name'] ?? '');
    $telefone        = trim($_POST['telefone'] ?? '');
    $email           = trim($_POST['email'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');
    $role            = trim($_POST['role'] ?? '');

    if ($idPost <= 0 || $nome === '' || $email === '') {
        mensagemError('Informe os dados obrigatórios (id, nome e e-mail).', 'warning');
    } else {
        $sql  = "UPDATE autores
                SET nome = ?, telefone = ?, email = ?, data_nascimento = NULLIF(?, ''), role = ?
                WHERE cod_pessoa = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssi", $nome, $telefone, $email, $data_nascimento, $role, $idPost);
            $ok = mysqli_stmt_execute($stmt);
            if ($ok) {
                mensagemError("$nome atualizado com sucesso!", 'success');
                $id = $idPost;
            } else {
                mensagemError('Erro ao atualizar: ' . mysqli_error($conn), 'danger');
            }
            mysqli_stmt_close($stmt);
        } else {
            mensagemError('Erro ao preparar atualização: ' . mysqli_error($conn), 'danger');
        }
    }
}

$autor = null;
if ($id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM autores WHERE cod_pessoa = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $autor = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
}

if (!$autor) {
    mensagemError('Autor não encontrado.', 'warning');
    echo "<a class='btn outline' href='/opovo_TaissaRodrigues/public/authors/search.php'>Voltar</a>";
    exit;
}

function selected_opt($current, $value)
{
    return $current === $value ? 'selected' : '';
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alteração de Cadastro</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body>
    <div class="container narrow">
        <h1>Editar Autor</h1>
        <form class="form-vertical" action="/opovo_TaissaRodrigues/public/authors/editAuthors.php?id=<?= (int)$id ?>"
            method="POST">
            <input type="hidden" name="id" value="<?= (int)$id ?>">
            <div>
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome do autor" required
                    value="<?= htmlspecialchars($autor['nome']) ?>">
            </div>
            <div>
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(99) 99999-9999" required
                    value="<?= htmlspecialchars($autor['telefone']) ?>">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@opovo.com.br" required
                    value="<?= htmlspecialchars($autor['email']) ?>">
            </div>
            <div>
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required
                    value="<?= htmlspecialchars($autor['data_nascimento'] ?? '') ?>">
            </div>
            <div>
                <label for="role">Função</label>
                <select id="role" name="role" required>
                    <option value="">Selecione...</option>
                    <option value="Repórter" <?= selected_opt($autor['role'], 'Repórter') ?>>Repórter</option>
                    <option value="Colunista" <?= selected_opt($autor['role'], 'Colunista') ?>>Colunista</option>
                    <option value="Editor" <?= selected_opt($autor['role'], 'Editor') ?>>Editor</option>
                </select>
            </div>
            <div class="actions">
                <a href="/opovo_TaissaRodrigues/public/authors/search.php" class="btn outline">Voltar</a>
                <button type="submit" class="btn primary">Salvar alterações</button>
            </div>
        </form>
    </div>
</body>

</html>