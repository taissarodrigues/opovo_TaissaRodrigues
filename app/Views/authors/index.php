<?php
?>
<div class="toolbar">
    <form role="search" method="POST" action="/opovo_TaissaRodrigues/public/?r=authors/index" class="d-flex">
        <input type="search" name="busca" placeholder="Pesquisar autor..." autofocus
            value="<?= htmlspecialchars($q ?? '') ?>">
        <button class="btn outline" type="submit">Buscar</button>
    </form>
</div>

<div class="header-row">
    <h1 class="title">Autores</h1>
    <a href="/opovo_TaissaRodrigues/public/?r=authors/create" class="btn success">+ Novo Autor</a>
</div>

<?= alertBox($msg ?? null) ?>

<?php if (!empty($q)): ?>
    <p class="muted">Resultados para: <strong><?= htmlspecialchars($q) ?></strong></p>
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
        <?php if (!empty($rows)): foreach ($rows as $r): ?>
                <tr>
                    <th scope="row"><?= (int)$r['cod_pessoa'] ?></th>
                    <td><?= htmlspecialchars($r['nome']) ?></td>
                    <td><?= htmlspecialchars($r['telefone']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars(mostra_data($r['data_nascimento'] ?? '')) ?></td>
                    <td><span class="tag"><?= htmlspecialchars($r['role']) ?></span></td>
                    <td style="display: flex; gap: 12px; align-items: center;">
                        <a href="/opovo_TaissaRodrigues/public/?r=authors/edit&id=<?= (int)$r['cod_pessoa'] ?>"
                            style="color: #111; font-weight: 600; text-decoration: none;">Editar</a>
                        <a href="#" class="js-open-delete" style="color: #dc3545; font-weight: 600; text-decoration: none;"
                            data-id="<?= (int)$r['cod_pessoa'] ?>"
                            data-name="<?= htmlspecialchars($r['nome'], ENT_QUOTES) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="text-center muted">Nenhum autor encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 28px;">
    <a href="/opovo_TaissaRodrigues/public/?r=home" class="btn outline">Voltar ao painel</a>
</div>

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
            <form method="POST" action="/opovo_TaissaRodrigues/public/?r=authors/delete" id="delForm" style="margin:0">
                <input type="hidden" name="id" id="delId">
                <button class="btn danger" type="submit">Sim</button>
            </form>
        </div>
    </div>
</div>

<script>
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

    document.addEventListener('click', (e) => {
        const a = e.target.closest('.js-open-delete');
        if (!a) return;
        e.preventDefault();
        openDelModal(a.dataset.id, a.dataset.name);
    });
    btnCancel.addEventListener('click', closeDelModal);
    btnClose.addEventListener('click', closeDelModal);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeDelModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDelModal();
    });
</script>