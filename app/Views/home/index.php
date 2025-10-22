<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de autores Opovo — Painel</title>
    <link rel="stylesheet" href="/opovo_TaissaRodrigues/public/css/main.css">
</head>

<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0;">
    <div class="container wide" style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="
            text-align: center;
            padding: 72px 56px;
            width: 100%;
            max-width: 480px;
            height: 520px;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: center;
        ">
            <h1 style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 700;">OPOVO</h1>
            <h1 style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 700;">Cadastro Autores</h1>
            <p class="muted" style="font-size: 1.1rem; margin-bottom: 3rem;">
                Gerencie os <strong>autores</strong> e encontre rapidamente quem você precisa.
            </p>
            <div class="actions" style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                <a href="/opovo_TaissaRodrigues/public/?r=authors/create" class="btn primary"
                    style="padding: 1rem 2rem; font-size: 1.1rem; border-radius: 12px; width: 80%; font-weight: 600;">
                    Cadastrar autor
                </a>
                <a href="/opovo_TaissaRodrigues/public/?r=authors/index" class="btn outline"
                    style="padding: 1rem 2rem; font-size: 1.1rem; border-radius: 12px; width: 80%; font-weight: 600;">
                    Pesquisar autores
                </a>
            </div>
        </div>
    </div>
</body>

</html>