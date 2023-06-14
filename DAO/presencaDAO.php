<?php

if (isset($_GET['atualizar'])) {


    include '../conexao.php';

    $dia = $_GET['atualizar'];

    $sql = "SELECT crm, medico, andar, sala, mesa, dia, ti, turno FROM presenca WHERE dia = '$dia';";

    //echo $sql;

    $output = '';
    $result = mysqli_query($strcon, $sql);
    $output .= ' <table id="presenca" class="table bg-success bg-gradient rounded text-white">
          <thead>
            <tr>
                <th scope="col" class="border">CRM</th>
                <th scope="col" class="border">NOME</th>
                <th scope="col" class="border">ANDAR</th>
                <th scope="col" class="border">SALA</th>
                <th scope="col" class="border">MESA</th>
                <th scope="col" class="border">DIA</th>
                <th scope="col" class="border">TI</th>
                <th scope="col" class="border">TURNO</th>
                <th colspan="col-2" class="border">
              
              </th>
            </tr>
    ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["crm"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["medico"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["andar"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["sala"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["mesa"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["dia"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["ti"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["turno"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">Não é possível excluir registros passados!</td>

        </tr>
            ';
        }
    } else {
        $output .= '
        <tr>
        <td colspan="9">Nada encontrado</td>
        </tr>
        ';
    }
    $output .= '</table';
    echo $output;
}

if (isset($_POST['submit'])) {

    insertPresenca();
}


function insertPresenca()

{

    require '../conexao.php';

    //echo $_SESSION['usuario'];



    $crm = $_POST['crm'];

    $medico = $_POST['medico'];

    $andar = $_POST['andar'];

    $sala = $_POST['sala'];

    $mesa = $_POST['mesa'];

    $dia = date("Y-m-d");

    $ti = $_POST['ti'];

    $turno = $_POST['turno'];



    $sql = "INSERT INTO presenca (crm, medico, andar, sala, mesa, dia, ti, turno) 

VALUES ('$crm','$medico','$andar','$sala','$mesa','$dia','$ti','$turno');";



    //echo $sql;



    mysqli_query($strcon, $sql);



    header('Location: ../index.php');
}



function readPresenca()
{
    require 'conexao.php';

    $dia = date("Y-m-d");

    $sql = "SELECT id, crm, medico, andar, sala, mesa, dia, ti, turno FROM presenca WHERE dia = '$dia';";

    $result = mysqli_query($strcon, $sql);

    while ($row = mysqli_fetch_array($result)) :; ?>
        <tr>
            <form onsubmit="return confirm('Deseja realmente realizar esta ação?')" action="DAO/medicoDAO.php" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"></input>
                <td scope="col" class="border" name="crm" style="white-space: nowrap"><?php echo $row['crm'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['medico'] ?>" style="white-space: nowrap"><?php echo $row['medico'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['andar'] ?>" style="white-space: nowrap"><?php echo $row['andar'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['sala'] ?>" style="white-space: nowrap"><?php echo $row['sala'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['mesa'] ?>" style="white-space: nowrap"><?php echo $row['mesa'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['dia'] ?>" style="white-space: nowrap"><?php echo $row['dia'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['ti'] ?>" style="white-space: nowrap"><?php echo $row['ti'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['turno'] ?>" style="white-space: nowrap"><?php echo $row['turno'] ?></td>

                <td>
                    <button type="submit" id="atualizamedico" name="atualizamedico" class="btn btn-sm btn-info atualizamedico">Atualizar</a>
                </td>

                <td><button type="submit" id="deletamedico" name="deletamedico" class="btn btn-sm btn-danger deletamedico">Excluir</button></td>
            </form>
        </tr>
<?php endwhile;
}
?>