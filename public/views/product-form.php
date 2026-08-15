<?php
$isEdit = $action === 'edit';
$formTitle = $isEdit ? 'Editar produto' : 'Cadastrar novo produto';
$submitLabel = $isEdit ? 'Salvar alterações' : 'Cadastrar produto';
$data = $product ?? [];
?>
<section class="content-card p-4 p-lg-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="h3 mb-1"><?= $formTitle; ?></h2>
            <p class="text-secondary mb-0">Preencha os dados do produto. Os campos são validados no front-end e no back-end.</p>
        </div>
        <a class="btn btn-outline-secondary" href="/?action=list">Voltar para listagem</a>
    </div>

    <form method="post" class="row g-4 needs-validation" novalidate>
        <input type="hidden" name="action" value="<?= $isEdit ? 'update' : 'create'; ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= (int) $data['id']; ?>">
        <?php endif; ?>

        <div class="col-md-6">
            <label for="nome" class="form-label">Nome do produto</label>
            <input type="text" class="form-control <?= isset($errors['nome']) ? 'is-invalid' : ''; ?>" id="nome" name="nome" minlength="3" required value="<?= old('nome', $data); ?>">
            <div class="invalid-feedback"><?= escape($errors['nome'] ?? 'Informe o nome do produto.'); ?></div>
        </div>

        <div class="col-md-6">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control <?= isset($errors['marca']) ? 'is-invalid' : ''; ?>" id="marca" name="marca" required value="<?= old('marca', $data); ?>">
            <div class="invalid-feedback"><?= escape($errors['marca'] ?? 'Informe a marca do produto.'); ?></div>
        </div>

        <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control <?= isset($errors['senha']) ? 'is-invalid' : ''; ?>" id="senha" name="senha" minlength="6" <?= $isEdit ? '' : 'required'; ?>>
            <div class="form-text"><?= $isEdit ? 'Preencha somente se desejar alterar a senha.' : 'Use pelo menos 6 caracteres.'; ?></div>
            <div class="invalid-feedback"><?= escape($errors['senha'] ?? 'Informe uma senha válida.'); ?></div>
        </div>

        <div class="col-md-6">
            <label for="cor" class="form-label">Cor</label>
            <input type="text" class="form-control <?= isset($errors['cor']) ? 'is-invalid' : ''; ?>" id="cor" name="cor" required value="<?= old('cor', $data); ?>">
            <div class="invalid-feedback"><?= escape($errors['cor'] ?? 'Informe a cor do produto.'); ?></div>
        </div>

        <div class="col-md-6">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" step="0.01" min="0" class="form-control <?= isset($errors['valor']) ? 'is-invalid' : ''; ?>" id="valor" name="valor" required value="<?= old('valor', $data); ?>">
            <div class="invalid-feedback"><?= escape($errors['valor'] ?? 'Informe um valor válido.'); ?></div>
        </div>

        <div class="col-md-6">
            <label class="form-label d-block">Status</label>
            <?php
            $checked = ($_SESSION['old']['ativo'] ?? $data['ativo'] ?? 0) ? 'checked' : '';
            ?>
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" name="ativo" <?= $checked; ?>>
                <label class="form-check-label" for="ativo">Produto ativo</label>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex flex-column flex-sm-row gap-3">
                <button type="submit" class="btn btn-primary px-4"><?= $submitLabel; ?></button>
                <button type="reset" class="btn btn-light border">Limpar formulário</button>
            </div>
        </div>
    </form>
</section>
