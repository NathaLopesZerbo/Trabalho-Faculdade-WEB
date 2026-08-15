document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });

    const deleteModal = document.getElementById('deleteModal');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');

            document.getElementById('deleteProductId').value = productId;
            document.getElementById('deleteProductName').textContent = productName;
        });
    }
});
