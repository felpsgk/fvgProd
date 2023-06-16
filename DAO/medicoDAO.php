<?php

use CodeIgniter\Exceptions\AlertError;

if (isset($_POST['inserirmedico'])) {

    require '../conexao.php';

    //echo $_SESSION['usuario'];

    $crm = $_POST['crmModal'];

    $medico = $_POST['nome'];
    // Deixa tudo maiúsculo
    mb_internal_encoding('UTF-8');
    $crmUpperCase = mb_strtoupper($medico);
    $medicoUpperCase = mb_strtoupper($medico);

    $sql = "INSERT INTO medico (medico, crm) VALUES ('$medicoUpperCase','$crmUpperCase');";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: ../index.php');
    } else {
?>
        <script>
            alert('erro ao inserir médico');
        </script>
<?php
    }
}
?>
<?php
if (isset($_POST['atualizamedico'])) {

    require '../conexao.php';

    $idmedico = $_POST['id'];

    $sql = "SELECT * FROM `presenca` WHERE id = '$idmedico';";



    $result = mysqli_query($strcon, $sql);

    while ($row = mysqli_fetch_array($result)) {

        $crm = $row['crm'];
        $medico = $row['medico'];
        $andar = $row['andar'];
        $sala = $row['sala'];
        $mesa = $row['mesa'];
        $dia = $row['dia'];
        $turno = $row['turno'];
        $ti = $row['ti'];
    }
?>
    <form action="medicoDAO.php" method="POST">

        <input type="hidden" id="id" name="id" value="<?php echo $idmedico ?>"></input>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">CRM do médico</label>
                <input type="text" maxlength="8" required="required" name="crm" id="crm" class="form-control" placeholder="CRM" value="<?php echo $crm ?>">
            </div>
            <div class="form-group">
                <label for="crm">Nome do médico</label>
                <input required="required" type="text" id="nome" name="nome" class="form-control" placeholder="NOME" value="<?php echo $medico ?>">
            </div>
            <div class="form-group">
                <label for="nome">Andar do médico</label>
                <input type="text" required="required" name="andar" id="andar" class="form-control" placeholder="ANDAR" value="<?php echo $andar ?>">
            </div>
            <div class="form-group">
                <label for="crm">Sala do médico</label>
                <input maxlength="8" required="required" type="text" id="sala" name="sala" class="form-control" placeholder="SALA" value="<?php echo $sala ?>">
            </div>
            <div class="form-group">
                <label for="nome">Mesa do médico</label>
                <input type="text" required="required" name="mesa" id="mesa" class="form-control" placeholder="MESA" value="<?php echo $mesa ?>">
            </div>
            <div class="form-group">
                <label for="crm">Turno do médico</label>
                <input maxlength="8" required="required" type="text" id="turno" name="turno" class="form-control" placeholder="TURNO" value="<?php echo $turno ?>">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="update" class="btn btn-info">Atualizar</button>
        </div>
    </form>
    <?php
}

if (isset($_POST['deletamedico'])) {



    require '../conexao.php';

    $idmedico = $_POST['id'];

    $sql = "DELETE FROM presenca WHERE id = '$idmedico';";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: ../index.php');
    } else {
    ?>
        <script>
            alert('erro ao deletar médico');
        </script>
    <?php
    }
}


if (isset($_POST['update'])) {
    require '../conexao.php';

    $idmedico = $_POST['id'];

    $crm = $_POST['crm'];
    $nome = $_POST['nome'];
    $andar = $_POST['andar'];
    $sala = $_POST['sala'];
    $mesa = $_POST['mesa'];
    $turno = $_POST['turno'];

    $sql = "UPDATE presenca SET crm = '$crm', medico = '$nome', andar = '$andar', sala = '$sala', 
    mesa = '$mesa', turno = '$turno' WHERE id = '$idmedico'";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: ../index.php');
    } else {
    ?>
        <script>
            alert('erro ao atualizar médico');
        </script>
    <?php
    }
}


function readMedicoList()

{
    require 'conexao.php';

    $sql = "SELECT medico, crm FROM medico;";

    //echo $sql;
    $result = mysqli_query($strcon, $sql);

    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>

        <option id="<?php echo $row['crm'] ?>" value="<?php echo $row['medico'] ?>"><?php echo $row['crm'] ?></option>

    <?php endwhile;
}

function readMedico()
{
    require 'conexao.php';
    $sql = "SELECT medico, crm FROM medico;";
    //echo $sql;
    $result = mysqli_query($strcon, $sql);
    //echo $result;
    while ($row = mysqli_fetch_array($result)) :; ?>
        <option id="crm" value="<?php echo $row['crm'] ?>"><?php echo $row['medico'] ?></option>
    <?php endwhile;
}

function readMedicoDia()
{
    require 'conexao.php';
    $dia = date("Y-m-d");
    $sql = "SELECT medico, crm FROM presenca WHERE dia = '$dia' GROUP BY medico;";
    $result = mysqli_query($strcon, $sql);
    //echo $result;
    while ($row = mysqli_fetch_array($result)) :; ?>
        <option id="<?php echo $row['crm'] ?>" value="<?php echo $row['medico'] ?>"><?php echo $row['crm'] ?></option>



<?php endwhile;
}

?>