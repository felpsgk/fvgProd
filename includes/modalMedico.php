<div class="modal fade" id="medicoCadModal" tabindex="-1" aria-labelledby="medicoCadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="medicoCadModalLabel">Cadastrar novo médico</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="crmModal" name="crmModal" placeholder="CRM do médico" onchange="formatarCRM()" required="required" maxlength="5">
                    <label for="crmModal">CRM do médico (apenas números)</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="nome" placeholder="Nome do médico" required="required">
                    <label for="nome">Nome do médico</label>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" name="inserirmedico" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function formatarCRM() {
        var crmInput = document.getElementById('crmModal');
        var crm = crmInput.value;

        // Verifica se o CRM já contém a sigla "CRM" no começo
        if (!crm.startsWith('CRM')) {
            // Insere a sigla "CRM" no começo
            crmInput.value = 'CRM' + crm;
        }
    }
</script>