<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Autor - O Povo News</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body>
    <div class="container narrow">
        <h1>Cadastro de Autor</h1>
        <form class="form-vertical" action="/opovo_TaissaRodrigues/public/authors/store.php" method="POST">
            <div>
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome do autor" required>
            </div>
            <div>
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(99) 99999-9999" required>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@opovo.com.br" required>
            </div>
            <div>
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div>
                <label for="role">Função</label>
                <select id="role" name="role" required>
                    <option value="">Selecione...</option>
                    <option value="Repórter">Repórter</option>
                    <option value="Colunista">Colunista</option>
                    <option value="Editor">Editor</option>
                </select>
            </div>
            <div class="actions">
                <a href="/opovo_TaissaRodrigues/public/index.php" class="btn outline">Voltar</a>
                <button type="submit" class="btn primary">Cadastrar</button>
            </div>
        </form>
    </div>
</body>

</html>