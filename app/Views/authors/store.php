<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body>
    <div class="container narrow card">
        <h1>Resultado do Cadastro</h1>

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include '../../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "<div class='alert warning'>Acesse esta página enviando o formulário.</div>";
        } else {
            $nome = trim($_POST['name'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $data_nascimento = trim($_POST['data_nascimento'] ?? '');
            $role = trim($_POST['role'] ?? '');

            if ($nome === '' || $email === '') {
                echo "<div class='alert warning'>Preencha nome e e-mail.</div>";
            } else {
                $sql = "INSERT INTO autores (nome, telefone, email, data_nascimento, role)
                VALUES (?, ?, ?, NULLIF(?, ''), ?)";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sssss", $nome, $telefone, $email, $data_nascimento, $role);
                    $ok = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    if ($ok) {
                        echo "<div class='alert success'>{$nome} cadastrado com sucesso!</div>";
                    } else {
                        echo "<div class='alert danger'>Erro ao cadastrar: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
                    }
                } else {
                    echo "<div class='alert danger'>Erro ao preparar a operação: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
                }
            }
        }
        if (isset($conn) && $conn instanceof mysqli) {
            mysqli_close($conn);
        }
        ?>

        <a href="create.php" class="btn outline">Voltar</a>
    </div>
</body>

</html>