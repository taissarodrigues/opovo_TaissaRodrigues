<?php

namespace App\Models;

class Author
{
    private \mysqli $conn;

    public function __construct(\mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function all(): \mysqli_result|false
    {
        $sql = "SELECT * FROM autores ORDER BY cod_pessoa DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function search(string $q): \mysqli_result|false
    {
        $sql = "SELECT * FROM autores
                WHERE nome LIKE ? OR email LIKE ? OR role LIKE ?
                ORDER BY cod_pessoa DESC";
        $stmt = mysqli_prepare($this->conn, $sql);
        $like = "%{$q}%";
        mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function find(int $id): ?array
    {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM autores WHERE cod_pessoa = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = $res ? mysqli_fetch_assoc($res) : null;
        mysqli_stmt_close($stmt);
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO autores (nome, telefone, email, data_nascimento, role)
                VALUES (?, ?, ?, NULLIF(?, ''), ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $data['name'],
            $data['telefone'],
            $data['email'],
            $data['data_nascimento'],
            $data['role']
        );
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE autores
                SET nome=?, telefone=?, email=?, data_nascimento=NULLIF(?, ''), role=?
                WHERE cod_pessoa=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $data['name'],
            $data['telefone'],
            $data['email'],
            $data['data_nascimento'],
            $data['role'],
            $id
        );
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }

    public function delete(int $id): bool
    {
        $stmt = mysqli_prepare($this->conn, "DELETE FROM autores WHERE cod_pessoa = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }
}
