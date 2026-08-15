<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/ProductRepository.php';

$repository = new ProductRepository(getConnection());
$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$errors = getFormErrors();
$product = null;

function validateProduct(array $input, bool $isEdit = false, ?int $ignoreId = null): array
{
    global $repository;

    $errors = [];
    $nome = trim($input['nome'] ?? '');
    $marca = trim($input['marca'] ?? '');
    $senha = $input['senha'] ?? '';
    $cor = trim($input['cor'] ?? '');
    $valor = filter_var($input['valor'] ?? null, FILTER_VALIDATE_FLOAT);

    if ($nome === '' || strlen($nome) < 3) {
        $errors['nome'] = 'Informe um nome com pelo menos 3 caracteres.';
    }

    if ($marca === '' || strlen($marca) < 2) {
        $errors['marca'] = 'Informe uma marca válida.';
    } elseif ($repository->brandExists($marca, $ignoreId)) {
        $errors['marca'] = 'A marca informada já está cadastrada.';
    }

    if (!$isEdit || $senha !== '') {
        if (strlen($senha) < 6) {
            $errors['senha'] = 'A senha deve possuir pelo menos 6 caracteres.';
        }
    }

    if ($cor === '') {
        $errors['cor'] = 'Informe a cor do produto.';
    }

    if ($valor === false || $valor < 0) {
        $errors['valor'] = 'Informe um valor numérico válido.';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['action'] ?? '';

    if ($postAction === 'create') {
        $errors = validateProduct($_POST);
        storeOldInput($_POST);

        if ($errors === []) {
            $repository->create([
                'nome' => trim($_POST['nome']),
                'marca' => trim($_POST['marca']),
                'senha' => $_POST['senha'],
                'cor' => trim($_POST['cor']),
                'valor' => (float) $_POST['valor'],
                'ativo' => isset($_POST['ativo']) ? 1 : 0,
            ]);

            clearOldInput();
            setFlash('success', 'Produto cadastrado com sucesso.');
            redirect('/?action=list');
        }

        setFormErrors($errors);
        setFlash('danger', 'Corrija os erros do formulário para continuar.');
        redirect('/?action=create');
    }

    if ($postAction === 'update' && isset($_POST['id'])) {
        $productId = (int) $_POST['id'];
        $errors = validateProduct($_POST, true, $productId);
        storeOldInput($_POST);

        if ($errors === []) {
            $repository->update($productId, [
                'nome' => trim($_POST['nome']),
                'marca' => trim($_POST['marca']),
                'senha' => $_POST['senha'],
                'cor' => trim($_POST['cor']),
                'valor' => (float) $_POST['valor'],
                'ativo' => isset($_POST['ativo']) ? 1 : 0,
            ]);

            clearOldInput();
            setFlash('success', 'Produto atualizado com sucesso.');
            redirect('/?action=list');
        }

        setFormErrors($errors);
        setFlash('danger', 'Corrija os erros do formulário para continuar.');
        redirect('/?action=edit&id=' . $productId);
    }

    if ($postAction === 'delete' && isset($_POST['id'])) {
        $repository->delete((int) $_POST['id']);
        setFlash('warning', 'Produto removido com sucesso.');
        redirect('/?action=list');
    }
}

if ($action === 'edit' && $id !== null) {
    $product = $repository->find($id);

    if ($product === null) {
        setFlash('danger', 'Produto não encontrado.');
        redirect('/?action=list');
    }
}

$products = $repository->all();
$flash = getFlash();

require __DIR__ . '/views/layout.php';
