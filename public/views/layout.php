<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro de Produtos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="hero-section shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/?action=list">ProdutoLab</a>
                <div class="ms-auto d-flex gap-2">
                    <a class="btn btn-outline-light btn-sm" href="/?action=list">Listagem</a>
                    <a class="btn btn-warning btn-sm" href="/?action=create">Novo Produto</a>
                </div>
            </div>
        </nav>
        <div class="container py-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge rounded-pill text-bg-warning mb-3">CRUD em PHP + MySQL + Docker</span>
                    <h1 class="display-5 fw-semibold">Cadastro de produtos com interface responsiva e validação completa.</h1>
                    <p class="lead mb-0">Projeto acadêmico com operações de criação, leitura, edição e exclusão, usando Bootstrap no front-end, JavaScript para interação e PHP com PDO no back-end.</p>
                </div>
                <div class="col-lg-5">
                    <div class="hero-card">
                        <p class="mb-2 text-uppercase small fw-semibold">Recursos implementados</p>
                        <ul class="list-unstyled mb-0">
                            <li>Cadastro com senha protegida por hash</li>
                            <li>Listagem tabular com status visual</li>
                            <li>Edição parcial sem trocar senha obrigatoriamente</li>
                            <li>Exclusão com confirmação em modal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">
        <?php if ($flash !== null): ?>
            <div class="alert alert-<?= escape($flash['type']); ?> alert-dismissible fade show" role="alert">
                <?= escape($flash['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if ($action === 'list'): ?>
            <?php require __DIR__ . '/product-list.php'; ?>
        <?php else: ?>
            <?php require __DIR__ . '/product-form.php'; ?>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
