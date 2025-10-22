<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesquisar Autores - O Povo News</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body>
    <?php
    require_once '../../config/database.php';
    $q = $_GET['q'] ?? '';
    $sql = "SELECT * FROM autores WHERE nome LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    $param = "%$q%";
    mysqli_stmt_bind_param($stmt, "s", $param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
    <div class="container">
        <div class="toolbar">
            <form role="search" method="GET" action="search.php">
                <input type="search" name="q" placeholder="Pesquisar autor..."
                    value="<?= htmlspecialchars($q ?? '') ?>">
                <button class="btn outline" type="submit">Pesquisar</button>
            </form>
        </div>

        <div class="header-row">
            <h1 class="title">Autores</h1>
            <a href="/opovo_TaissaRodrigues/public/authors/create.php" class="btn success">+ Novo Autor</a>
        </div>

        <?php if ($q !== ''): ?>
            <p class="muted">Resultados para: <strong><?= htmlspecialchars($q) ?></strong></p>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Função</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Nenhum autor encontrado.</td>
                    </tr>
                    <?php else: foreach ($rows as $r): ?>
                        <tr>
                            <td><?= (int)$r['cod_pessoa'] ?></td>
                            <td><?= htmlspecialchars($r['nome']) ?></td>
                            <td><?= htmlspecialchars($r['email']) ?></td>
                            <td><?= htmlspecialchars($r['telefone']) ?></td>
                            <td><?= htmlspecialchars($r['data_nascimento'] ?? '') ?></td>
                            <td><span class="tag"><?= htmlspecialchars($r['role']) ?></span></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="/opovo_TaissaRodrigues/public/index.php" class="btn outline">Voltar ao painel</a>
        </div>
    </div>
</body>

</html>