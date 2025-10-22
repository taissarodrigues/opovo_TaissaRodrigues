<?php

namespace App\Controllers;

use App\Models\Author;

class AuthorsController
{
    private \mysqli $conn;
    private string $basePath;
    private Author $author;

    public function __construct()
    {
        $this->basePath = dirname(__DIR__, 2);
        $this->conn     = db();
        $this->author   = new Author($this->conn);
    }

    private function render(string $view, array $params = []): void
    {
        extract($params);
        $viewFile = $this->basePath . "/app/Views/{$view}.php";
        $header   = $this->basePath . "/app/Views/partials/header.php";
        $footer   = $this->basePath . "/app/Views/partials/footer.php";
        require $header;
        require $viewFile;
        require $footer;
    }

    private function redirect(string $to): void
    {
        header("Location: {$to}");
        exit;
    }

    private function normalizePhone(string $tel): string
    {
        $digits = preg_replace('/\D+/', '', $tel ?? '');
        if ($digits === null) return '';

        $len = strlen($digits);
        if ($len === 11) {
            // (DD) 9XXXX-XXXX
            $ddd = substr($digits, 0, 2);
            $p1  = substr($digits, 2, 5);
            $p2  = substr($digits, 7, 4);
            return sprintf('(%s) %s-%s', $ddd, $p1, $p2);
        }
        if ($len === 10) {
            // (DD) XXXX-XXXX
            $ddd = substr($digits, 0, 2);
            $p1  = substr($digits, 2, 4);
            $p2  = substr($digits, 6, 4);
            return sprintf('(%s) %s-%s', $ddd, $p1, $p2);
        }
        return '';
    }

    public function index(): void
    {
        // Observação: aceitamos busca via POST (form) e GET (?busca=) para permitir links compartilháveis.
        // Aceita busca por POST (form) e GET (?busca=)
        $q = trim($_POST['busca'] ?? ($_GET['busca'] ?? ''));

        $res  = ($q !== '') ? $this->author->search($q) : $this->author->all();
        $rows = [];
        if ($res) {
            while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
        }

        $msg = ($_GET['msg'] ?? null);
        $this->render('authors/index', compact('rows', 'q', 'msg'));

        // Fecha a conexão no fim do ciclo do controller
        mysqli_close($this->conn);
    }

    public function create(): void
    {
        $this->render('authors/create');
        mysqli_close($this->conn);
    }

    public function store(): void
    {
        // Sanitização/normalização leve
        $data = [
            'name'            => trim($_POST['name'] ?? ''),
            'telefone'        => trim($_POST['telefone'] ?? ''),
            'email'           => trim($_POST['email'] ?? ''),
            'data_nascimento' => trim($_POST['data_nascimento'] ?? ''),
            'role'            => trim($_POST['role'] ?? ''),
        ];

        // normaliza telefone para um formato padrão; se inválido, fica vazio e cai na validação
        $data['telefone'] = $this->normalizePhone($data['telefone']);

        if ($data['name'] === '' || mb_strlen($data['name']) < 3) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/create&err=validate_name');
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/create&err=validate_email');
        }
        if ($data['telefone'] !== '' && !preg_match('/^\(\d{2}\)\s?\d{4,5}-\d{4}$/', $data['telefone'])) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/create&err=validate_phone');
        }
        if (!$this->isPastOrTodayISODate($data['data_nascimento'])) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/create&err=validate_birth');
        }
        $roles = ['Repórter', 'Colunista', 'Editor'];
        if ($data['role'] === '' || !in_array($data['role'], $roles, true)) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/create&err=validate_role');
        }

        $ok = $this->author->create($data);
        mysqli_close($this->conn);
        $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/index&msg=created');
    }

    public function edit(): void
    {
        $id    = (int)($_GET['id'] ?? 0);
        $autor = $this->author->find($id);

        if (!$autor) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/index&msg=notfound');
        }

        $this->render('authors/edit', compact('autor'));
        mysqli_close($this->conn);
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'name'            => trim($_POST['name'] ?? ''),
            'telefone'        => trim($_POST['telefone'] ?? ''),
            'email'           => trim($_POST['email'] ?? ''),
            'data_nascimento' => trim($_POST['data_nascimento'] ?? ''),
            'role'            => trim($_POST['role'] ?? ''),
        ];

        // normaliza telefone para um formato padrão, se inválido, fica vazio e cai na validação
        $data['telefone'] = $this->normalizePhone($data['telefone']);

        if ($id <= 0) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/index&msg=notfound');
        }
        if (
            $data['name'] === '' || mb_strlen($data['name']) < 3 ||
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ||
            ($data['telefone'] !== '' && !preg_match('/^\(\d{2}\)\s?\d{4,5}-\d{4}$/', $data['telefone'])) ||
            !$this->isPastOrTodayISODate($data['data_nascimento']) ||
            ($data['role'] === '' || !in_array($data['role'], ['Repórter', 'Colunista', 'Editor'], true))
        ) {
            $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/edit&id=' . $id . '&err=validate');
        }

        $ok = $this->author->update($id, $data);
        mysqli_close($this->conn);
        $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/index&msg=updated');
    }

    public function delete(): void
    {
        //  evita exclusão por clique acidental 
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->author->delete($id);
        }
        mysqli_close($this->conn);
        $this->redirect('/opovo_TaissaRodrigues/public/?r=authors/index&msg=excluido');
    }

    private function isPastOrTodayISODate(?string $dateStr): bool
    {
        if ($dateStr === null || $dateStr === '') {
            return true;
        }

        $dt = \DateTime::createFromFormat('Y-m-d', $dateStr);
        if (!$dt || $dt->format('Y-m-d') !== $dateStr) {
            return false;
        }

        $dt->setTime(0, 0, 0);
        $today = new \DateTime('today');

        return $dt <= $today;
    }
}
