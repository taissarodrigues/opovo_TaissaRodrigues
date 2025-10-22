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

    // termo da busca
    $pesquisa = trim($_POST['busca'] ?? '');

    // busca com LIKE (segura)
    if ($pesquisa !== '') {
        $sql = "SELECT * FROM autores
            WHERE nome LIKE ? OR email LIKE ? OR role LIKE ?
            ORDER BY cod_pessoa DESC";
        $stmt = mysqli_prepare($conn, $sql);
        $like = "%{$pesquisa}%";
        mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
    } else {
        $res = mysqli_query($conn, "SELECT * FROM autores ORDER BY cod_pessoa DESC");
    }
    ?>

    <div class="container">

        <div class="toolbar">
            <form role="search" method="POST" action="search.php" class="d-flex">
                <input type="search" name="busca" placeholder="Pesquisar autor..." autofocus
                    value="<?= htmlspecialchars($pesquisa) ?>">
                <button class="btn outline" type="submit">Buscar</button>
            </form>
        </div>

        <div class="header-row">
            <h1 class="title">Autores</h1>
            <a href="/opovo_TaissaRodrigues/public/authors/create.php" class="btn success">+ Novo Autor</a>
        </div>

        <?php if ($pesquisa !== ''): ?>
            <p class="muted">Resultados para: <strong><?= htmlspecialchars($pesquisa) ?></strong></p>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'excluido'): ?>
            <div class="alert success">Autor excluído com sucesso!</div>
        <?php endif; ?>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Nascimento</th>
                    <th>Função</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($linha = mysqli_fetch_assoc($res)) {
                        $cod_pessoa      = (int)$linha['cod_pessoa'];
                        $nome            = $linha['nome'];
                        $telefone        = $linha['telefone'];
                        $email           = $linha['email'];
                        $data_nascimento = mostra_data($linha['data_nascimento'] ?? '');
                        $role            = $linha['role'];
                ?>
                        <tr>
                            <th scope="row"><?= $cod_pessoa ?></th>
                            <td><?= htmlspecialchars($nome) ?></td>
                            <td><?= htmlspecialchars($telefone) ?></td>
                            <td><?= htmlspecialchars($email) ?></td>
                            <td><?= htmlspecialchars($data_nascimento) ?></td>
                            <td><span class="tag"><?= htmlspecialchars($role) ?></span></td>
                            <td>
                                <a href="editAuthors.php?id=<?= $cod_pessoa ?>" class="btn small edit">Editar</a>
                                <a href="delete.php?id=<?= $cod_pessoa ?>" class="btn small delete js-open-delete"
                                    data-id="<?= $cod_pessoa ?>" data-name="<?= htmlspecialchars($nome, ENT_QUOTES) ?>">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center muted'>Nenhum autor encontrado.</td></tr>";
                }

                if (isset($stmt)) mysqli_stmt_close($stmt);
                mysqli_close($conn);
                ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="/opovo_TaissaRodrigues/public/index.php" class="btn outline">Voltar ao painel</a>
        </div>
    </div>

    <!-- Modal de confirmação -->
    <div class="modal-overlay" id="delModal" aria-hidden="true">
        <div class="modal">
            <div class="modal-header">
                <h2>Confirmação de exclusão</h2>
                <button class="modal-close" type="button" aria-label="Fechar">×</button>
            </div>

            <div class="modal-body">
                <p>Deseja realmente excluir</p>
                <p class="modal-name" id="delName">—</p>
            </div>

            <div class="modal-footer">
                <button class="btn outline" type="button" id="btnCancel">Não</button>

                <!-- form POST para excluir -->
                <form method="POST" action="delete.php" id="delForm" style="margin:0">
                    <input type="hidden" name="id" id="delId">
                    <button class="btn danger" type="submit">Sim</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // abre o modal
        const overlay = document.getElementById('delModal');
        const nameSpan = document.getElementById('delName');
        const idInput = document.getElementById('delId');
        const btnCancel = document.getElementById('btnCancel');
        const btnClose = document.querySelector('.modal-close');

        function openDelModal(id, name) {
            nameSpan.textContent = name;
            idInput.value = id;
            overlay.classList.add('is-open');
            overlay.setAttribute('aria-hidden', 'false');
        }

        function closeDelModal() {
            overlay.classList.remove('is-open');
            overlay.setAttribute('aria-hidden', 'true');
        }

        // clique em “Excluir”
        document.addEventListener('click', (e) => {
            const a = e.target.closest('.js-open-delete');
            if (!a) return;
            e.preventDefault();
            openDelModal(a.dataset.id, a.dataset.name);
        });

        // fechar modal
        btnCancel.addEventListener('click', closeDelModal);
        btnClose.addEventListener('click', closeDelModal);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeDelModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeDelModal();
        });
    </script>
</body>

</html>