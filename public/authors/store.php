<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="display-6 fw-bold mb-4">Resultado do Cadastro</h1>

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include '../../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            mensagemError('Acesse esta página enviando o formulário.', 'warning');
        } else {
            $nome            = trim($_POST['name'] ?? '');
            $telefone        = trim($_POST['telefone'] ?? '');
            $email           = trim($_POST['email'] ?? '');
            $data_nascimento = trim($_POST['data_nascimento'] ?? '');
            $role            = trim($_POST['role'] ?? '');

            if ($nome === '' || $email === '') {
                mensagemError('Preencha nome e e-mail.', 'warning');
            } else {
                $sql = "INSERT INTO autores (nome, telefone, email, data_nascimento, role)
                VALUES (?, ?, ?, NULLIF(?, ''), ?)";

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param(
                        $stmt,
                        "sssss",
                        $nome,
                        $telefone,
                        $email,
                        $data_nascimento,
                        $role
                    );

                    $ok = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    if ($ok) {
                        mensagemError("{$nome} cadastrado com sucesso!", 'success');
                    } else {
                        mensagemError('Erro ao cadastrar: ' . mysqli_error($conn), 'danger');
                    }
                } else {
                    mensagemError('Erro ao preparar a operação: ' . mysqli_error($conn), 'danger');
                }
            }
        }
        if (isset($conn) && $conn instanceof mysqli) {
            mysqli_close($conn);
        }
        ?>

        <a href="create.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>