<section class="content-card p-4 p-lg-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="h3 mb-1">Produtos cadastrados</h2>
            <p class="text-secondary mb-0">Gerencie os registros gravados no banco de dados `sistema_db`.</p>
        </div>
        <a class="btn btn-primary" href="/?action=create">Cadastrar produto</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Cor</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Criação</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products === []): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-secondary">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($products as $item): ?>
                    <tr>
                        <td><?= escape((string) $item['id']); ?></td>
                        <td class="fw-semibold"><?= escape($item['nome']); ?></td>
                        <td><?= escape($item['marca']); ?></td>
                        <td><?= escape($item['cor']); ?></td>
                        <td>R$ <?= number_format((float) $item['valor'], 2, ',', '.'); ?></td>
                        <td>
                            <span class="badge rounded-pill text-bg-<?= (int) $item['ativo'] === 1 ? 'success' : 'secondary'; ?>">
                                <?= (int) $item['ativo'] === 1 ? 'Ativo' : 'Inativo'; ?>
                            </span>
                        </td>
                        <td><?= escape(date('d/m/Y H:i', strtotime($item['data_criacao']))); ?></td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="/?action=edit&id=<?= (int) $item['id']; ?>">Editar</a>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-product-id="<?= (int) $item['id']; ?>"
                                    data-product-name="<?= escape($item['nome']); ?>"
                                >
                                    Excluir
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Deseja realmente excluir o produto <strong id="deleteProductName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteProductId">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
