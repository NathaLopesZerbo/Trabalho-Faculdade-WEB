<?php

declare(strict_types=1);

require_once __DIR__ . '/config/database.php';

class ProductRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM produtos ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM produtos WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO produtos (nome, marca, senha, cor, valor, ativo)
             VALUES (:nome, :marca, :senha, :cor, :valor, :ativo)'
        );

        $stmt->execute([
            'nome' => $data['nome'],
            'marca' => $data['marca'],
            'senha' => password_hash($data['senha'], PASSWORD_DEFAULT),
            'cor' => $data['cor'],
            'valor' => $data['valor'],
            'ativo' => $data['ativo'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $sql = 'UPDATE produtos
                SET nome = :nome, marca = :marca, cor = :cor, valor = :valor, ativo = :ativo';

        $params = [
            'id' => $id,
            'nome' => $data['nome'],
            'marca' => $data['marca'],
            'cor' => $data['cor'],
            'valor' => $data['valor'],
            'ativo' => $data['ativo'],
        ];

        if (!empty($data['senha'])) {
            $sql .= ', senha = :senha';
            $params['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        }

        $sql .= ' WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function brandExists(string $marca, ?int $ignoreId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM produtos WHERE marca = :marca';
        $params = ['marca' => $marca];

        if ($ignoreId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $ignoreId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }
}
