<?php
// View: authors/edit
// Espera a variável $autor fornecida pelo controller (App\Controllers\AuthorsController::edit)
function selected_opt($current, $value)
{
  return $current === $value ? 'selected' : '';
}
?>


<div style="max-width: 860px; margin: 0 auto;">

  <div style="padding-left: 40px; margin-bottom: 16px;">
    <h1 class="title" style="margin:0;">Editar Autor</h1>
  </div>

  <div class="card form-card" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">

    <form id="authorEditForm" class="form-vertical form-lg" method="POST"
      action="/opovo_TaissaRodrigues/public/?r=authors/update" novalidate>
      <input type="hidden" name="id" value="<?= (int)$autor['cod_pessoa'] ?>">

      <div class="field">
        <label for="name">Nome completo</label>
        <input type="text" id="name" name="name" required minlength="3" maxlength="120"
          pattern="^[A-Za-zÀ-ÖØ-öø-ÿ'`^~.\- ]{3,120}$"
          title="Use entre 3 e 120 letras. Você pode usar espaços e acentos."
          placeholder="Digite o nome do autor" value="<?= htmlspecialchars($autor['nome']) ?>">
      </div>

      <div class="field">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" inputmode="numeric" maxlength="15"
          pattern="^\(\d{2}\)\s?\d{4,5}-\d{4}$" title="Informe DDD + número (ex.: (85) 99999-9999)."
          placeholder="(99) 99999-9999" value="<?= htmlspecialchars($autor['telefone']) ?>">
      </div>

      <div class="field">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required maxlength="150"
          title="Informe um e-mail válido (ex.: nome@empresa.com)." placeholder="exemplo@opovo.com.br"
          value="<?= htmlspecialchars($autor['email']) ?>">
      </div>

      <div class="field">
        <label for="data_nascimento">Data de Nascimento</label>
        <input type="date" id="data_nascimento" name="data_nascimento"
          value="<?= htmlspecialchars($autor['data_nascimento'] ?? '') ?>">
      </div>

      <div class="field">
        <label for="role">Função</label>
        <select id="role" name="role" required title="Selecione a função do autor.">
          <option value="">Selecione...</option>
          <option value="Repórter" <?= selected_opt($autor['role'], 'Repórter') ?>>Repórter</option>
          <option value="Colunista" <?= selected_opt($autor['role'], 'Colunista') ?>>Colunista</option>
          <option value="Editor" <?= selected_opt($autor['role'], 'Editor') ?>>Editor</option>
        </select>
      </div>

      <div class="actions actions-end">
        <a href="/opovo_TaissaRodrigues/public/?r=authors/index" class="btn outline">Voltar</a>
        <button type="submit" class="btn primary">Salvar alterações</button>
      </div>
    </form>
  </div>
</div>
<script>
  (function setMaxAdultDate() {
    const dn = document.getElementById('data_nascimento');
    const today = new Date();
    today.setFullYear(today.getFullYear() - 18);
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    dn.max = `${yyyy}-${mm}-${dd}`;
  })();

  // Máscara de telefone amigável
  const tel = document.getElementById('telefone');
  tel.addEventListener('input', () => {
    let v = tel.value.replace(/\D/g, '').slice(0, 11);
    if (v.length >= 2) {
      const ddd = v.slice(0, 2);
      const rest = v.slice(2);
      if (rest.length > 5) {
        tel.value = `(${ddd}) ${rest.slice(0,5)}-${rest.slice(5,9)}`;
      } else if (rest.length > 0) {
        tel.value = `(${ddd}) ${rest.slice(0,4)}${rest.length>4?'-'+rest.slice(4):''}`;
      } else {
        tel.value = `(${ddd}`;
      }
    } else {
      tel.value = v;
    }
  });

  // Validação extra da data no submit
  document.getElementById('authorEditForm').addEventListener('submit', (e) => {
    const form = e.currentTarget;
    const dn = document.getElementById('data_nascimento');
    if (dn.value && dn.max) {
      const nascimento = new Date(dn.value + 'T00:00:00');
      const hoje = new Date();
      const limite = new Date(dn.max + 'T00:00:00');
      if (nascimento > hoje) {
        dn.setCustomValidity('A data de nascimento não pode ser no futuro.');
      } else if (nascimento > limite) {
        dn.setCustomValidity('Você precisa ter 18 anos ou mais.');
      } else {
        dn.setCustomValidity('');
      }
    }
    if (!form.checkValidity()) {
      e.preventDefault();
      form.reportValidity();
    }
  });

  document.getElementById('data_nascimento').addEventListener('input', function() {
    this.setCustomValidity('');
  });
</script>