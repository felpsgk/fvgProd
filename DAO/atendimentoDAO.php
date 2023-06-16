<?php
//CODIGO REFERENTE A ATUALIZAÇÃO DA TABELA
if (isset($_GET['atualizar'])) {


    include '../conexao.php';

    $dia = $_GET['atualizar'];

    $sql = "SELECT ti, crm, medico, andar, sala, 
    mesa, sistema, criticidade, erro,descricao, 
    status, observacao, dia, mes, hora FROM atendimento WHERE dia = '$dia';";

    //echo $sql;
    $output = '';
    $result = mysqli_query($strcon, $sql);
    // $output .= ' <table id="dataTable" class="table table-bordered dataTable">
    //       <thead>
    //         <tr>
    //             <th scope="col" class="border sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="CRM: Ordenar colunas de forma descendente" style="width: 54.9688px;" aria-sort="ascending">CRM</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="NOME: Ordenar colunas de forma ascendente" style="width: 334.281px;">NOME</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ANDAR: Ordenar colunas de forma ascendente" style="width: 57.1406px;">ANDAR</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="SALA: Ordenar colunas de forma ascendente" style="width: 40px;">SALA</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="MESA: Ordenar colunas de forma ascendente" style="width: 44.0469px;">MESA</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="SISTEMA: Ordenar colunas de forma ascendente" style="width: 100.047px;">SISTEMA</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="CRITICIDADE: Ordenar colunas de forma ascendente" style="width: 98.125px;">CRITICIDADE</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ERRO: Ordenar colunas de forma ascendente" style="width: 219.391px;">ERRO</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="DESCRIÇÃO: Ordenar colunas de forma ascendente" style="width: 556.531px;">DESCRIÇÃO</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="STATUS: Ordenar colunas de forma ascendente" style="width: 65.8438px;">STATUS</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="OBSERVAÇÃO: Ordenar colunas de forma ascendente" style="width: 585.406px;">OBSERVAÇÃO</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="DIA: Ordenar colunas de forma ascendente" style="width: 59.7969px;">DIA</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="MÊS: Ordenar colunas de forma ascendente" style="width: 39.4375px;">MÊS</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="HORA: Ordenar colunas de forma ascendente" style="width: 46.0938px;">HORA</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="TI: Ordenar colunas de forma ascendente" style="width: 39.0312px;">TI</th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label=" : Ordenar colunas de forma ascendente" style="width: 48.9219px;"></th>
    //             <th scope="col" class="border sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label=" : Ordenar colunas de forma ascendente" style="width: 34.5469px;"></th>
    //         </tr>
    // ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tbody>
            <tr>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["crm"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["medico"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["andar"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["sala"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["mesa"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["sistema"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["criticidade"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["erro"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["descricao"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["status"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["observacao"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["dia"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["mes"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["hora"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">' . $row["ti"] . '</td>
            <td scope="col" class="border" style="white-space: nowrap">Não é possível excluir egistros passados!</td>
            <td scope="col" class="border" style="white-space: nowrap"></td>

        </tr>
        </tbody>
            ';
        }
    } else {
        $output .= '
        <tr>
        <td colspan="16">Nada encontrado</td>
        </tr>
        ';
    }
    $output .= '</table';
    echo $output;
}

if (isset($_POST['submit'])) {

    insertAtendimento();
}



function insertAtendimento()

{

    require '../conexao.php';

    //echo $_SESSION['usuario'];



    $crm = $_POST['crm'];

    $medico = $_POST['medico'];

    $dia = date("Y-m-d");



    $sqlSel = "SELECT andar, sala, mesa 

    FROM presenca WHERE dia = '$dia' AND medico = '$medico';";



    //echo $sqlSel;



    $resultSel = mysqli_query($strcon, $sqlSel);



    while ($row = mysqli_fetch_array($resultSel)) {

        $andar = $row['andar'];

        $sala = $row['sala'];

        $mesa = $row['mesa'];
    }





    $sistema = $_POST['sistema'];

    $criticidade = $_POST['btnradioCrit'];

    $erro = $_POST['erro'];

    $descricao = $_POST['txtDescErro'];

    $status = $_POST['btnradioSol'];

    $observacao = $_POST['txtSolErro'];



    $mes = date("m");

    switch ($mes) {
        case 1:
            $mes = 'JANEIRO';
            break;
        case 2:
            $mes = 'FEVEREIRO';
            break;
        case 3:
            $mes = 'MARCO';
            break;
        case 4:
            $mes = 'ABRIL';
            break;
        case 5:
            $mes = 'MAIO';
            break;
        case 6:
            $mes = 'JUNHO';
            break;
        case 7:
            $mes = 'JULHO';
            break;
        case 8:
            $mes = 'AGOSTO';
            break;
        case 9:
            $mes = 'SETEMBRO';
            break;
        case 10:
            $mes = 'OUTUBRO';
            break;
        case 11:
            $mes = 'NOVEMBRO';
            break;
        case 12:
            $mes = 'DEZEMBRO';
            break;
    }

    $hora = date("H:i");



    $ti = $_POST['ti'];



    $sql = "INSERT INTO atendimento (crm, medico, andar, sala, mesa, sistema, criticidade, erro, 

    descricao, status, observacao, dia, mes, hora, ti) 

VALUES ('$crm','$medico','$andar','$sala','$mesa','$sistema','$criticidade','$erro','$descricao',

'$status','$observacao','$dia','$mes','$hora','$ti');";



    //echo $sql;



    mysqli_query($strcon, $sql);



    header('Location: ../atendimento.php');
}


if (isset($_POST['deletaatendimento'])) {

    require '../conexao.php';

    $idmedico = $_POST['id'];

    $sql = "DELETE FROM atendimento WHERE id = '$idmedico';";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: ../atendimento.php');
    } else {
?>
        <script>
            alert('erro ao deletar atendimento');
        </script>
    <?php
    }
}

if (isset($_POST['atualizaatendimento'])) {

    require '../conexao.php';

    $idmedico = $_POST['id'];

    $sql = "SELECT * FROM atendimento WHERE id = '$idmedico';";

    $result = mysqli_query($strcon, $sql);

    while ($row = mysqli_fetch_array($result)) {

        $crm = $row['crm'];
        $medico = $row['medico'];
        $andar = $row['andar'];
        $sala = $row['sala'];
        $mesa = $row['mesa'];
        $sistema = $row['sistema'];
        $criticidade = $row['criticidade'];
        $erro = $row['erro'];
        $descricao = $row['descricao'];
        $status = $row['status'];
        $observacao = $row['observacao'];
        $ti = $row['ti'];
    }
    ?>
    <form action="atendimentoDAO.php" method="POST">

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
                <input required="required" type="text" id="sala" name="sala" class="form-control" placeholder="SALA" value="<?php echo $sala ?>">
            </div>
            <div class="form-group">
                <label for="nome">Mesa do médico</label>
                <input type="text" required="required" name="mesa" id="mesa" class="form-control" placeholder="MESA" value="<?php echo $mesa ?>">
            </div>
            <div class="form-group">
                <label for="crm">Sistema</label>
                <input required="required" type="text" id="sistema" name="sistema" class="form-control" placeholder="TURNO" value="<?php echo $sistema ?>">
            </div>
            <div class="form-group">
                <label for="crm">Criticidade</label>
                <input required="required" type="text" id="criticidade" name="criticidade" class="form-control" placeholder="TURNO" value="<?php echo $criticidade ?>">
            </div>
            <div class="form-group">
                <label for="crm">Erro</label>
                <input required="required" type="text" id="erro" name="erro" class="form-control" placeholder="TURNO" value="<?php echo $erro ?>">
            </div>
            <div class="form-group">
                <label for="crm">Descrição</label>
                <input required="required" type="text" id="descricao" name="descricao" class="form-control" placeholder="TURNO" value="<?php echo $descricao ?>">
            </div>
            <div class="form-group">
                <label for="crm">Status</label>
                <input required="required" type="text" id="status" name="status" class="form-control" placeholder="TURNO" value="<?php echo $status ?>">
            </div>
            <div class="form-group">
                <label for="crm">Observação</label>
                <input required="required" type="text" id="observacao" name="observacao" class="form-control" placeholder="TURNO" value="<?php echo $observacao ?>">
            </div>
            <div class="form-group">
                <label for="crm">TI Responsável</label>
                <input required="required" type="text" id="ti" name="ti" class="form-control" placeholder="TURNO" value="<?php echo $ti ?>">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="updateAt" class="btn btn-info">Atualizar</button>
        </div>
    </form>
    <?php
}

if (isset($_POST['updateAt'])) {
    require '../conexao.php';

    $idmedico = $_POST['id'];

    $crm = $_POST['crm'];
    $medico = $_POST['nome'];
    $andar = $_POST['andar'];
    $sala = $_POST['sala'];
    $mesa = $_POST['mesa'];
    $sistema = $_POST['sistema'];
    $criticidade = $_POST['criticidade'];
    $erro = $_POST['erro'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $observacao = $_POST['observacao'];
    $ti = $_POST['ti'];

    $sql = "UPDATE atendimento SET ti = '$ti', crm = '$crm', medico = '$medico', andar = '$andar',
    sala = '$sala', mesa = '$mesa', sistema = '$sistema', criticidade = '$criticidade', erro = '$erro',
    descricao = '$descricao', status = '$status', observacao = '$observacao'  WHERE id = '$idmedico'";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: ../atendimento.php');
    } else {
    ?>
        <script>
            alert('erro ao atualizar médico');
        </script>
    <?php
    }
}

function readAtendimento()
{
    require 'conexao.php';

    $dia = date("Y-m-d");

    $sql = "SELECT id, crm, medico, andar, sala, mesa, sistema, criticidade, erro, 

    descricao, status, observacao, dia, mes, hora, ti FROM atendimento WHERE dia = '$dia';";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);
    $corLinha = "table-light";
    //echo $result;
    while ($row = mysqli_fetch_array($result)) :; ?>

        <?php echo '<tr class="' . $corLinha . '">'; ?>
        <form onsubmit="return confirm('Deseja realmente realizar esta ação?')" action="DAO/atendimentoDAO.php" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"></input>

            <td scope="row" class="border" style="white-space: nowrap"><?php echo $row['crm'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['medico'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['andar'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['sala'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['mesa'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['sistema'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['criticidade'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['erro'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['descricao'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['status'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['observacao'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['dia'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['mes'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['hora'] ?></td>

            <td scope="" class="border" style="white-space: nowrap"><?php echo $row['ti'] ?></td>

            <td>
                <button type="submit" id="atualizaatendimento" name="atualizaatendimento" class="btn btn-sm btn-info">Atualizar</a>
            </td>

            <td><button type="submit" id="deletaatendimento" name="deletaatendimento" class="btn btn-sm btn-danger">Excluir</button></td>
        </form>
        </tr>

<?php
        if ($corLinha === "table-light") {
            $corLinha = "table-success";
        } else {
            $corLinha = "table-light";
        }
    endwhile;
}



?>