<div class="modal fade" id="medicoCadModal" tabindex="-1" role="dialog" aria-labelledby="modalCadMedicoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCadMedicoLabel">Cadastrar novo médico</h5>
                <button class="btn btn-close btn-secondary" type="button" data-dismiss="modal"></button>
            </div>
            <form action="DAO/medicoDAO.php" method="POST">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input onchange="formatarCRM()" maxlength="5" type="text" required="required" class="form-control" id="crmModal" name="crmModal" placeholder="CRM do médico">
                        <label for="crmModal">CRM do médico (apenas números)</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" required="required" id="nome" placeholder="Nome do médico">
                        <label for="nome">Nome do médico</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="inserirmedico" class="btn btn-success">Salvar</button>
                </div>
            </form>
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