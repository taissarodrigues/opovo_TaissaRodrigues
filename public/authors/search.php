<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesquisar Autores - O Povo News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">

        <nav class="navbar bg-body-tertiary p-0 mb-3">
            <form class="d-flex" role="search" method="GET" action="search.php">
                <input class="form-control me-2" type="search" name="q" placeholder="Pesquisar autor..."
                    aria-label="Search" style="max-width: 320px;" value="<?= htmlspecialchars($q ?? '') ?>" />
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 fw-bold m-0">Autores</h1>
            <a href="/opovo_TaissaRodrigues/public/authors/create.php" class="btn btn-success">+ Novo Autor</a>
        </div>

        <?php if ($q !== ''): ?>
            <p class="text-muted">Resultados para: <strong><?= htmlspecialchars($q) ?></strong></p>
        <?php endif; ?>

        <table class="table table-hover">
            <thead class="table-light">
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
                            <td><span class="badge text-bg-secondary"><?= htmlspecialchars($r['role']) ?></span></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="/opovo_TaissaRodrigues/public/index.php" class="btn btn-outline-secondary">Voltar ao painel</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>