<?php

require '../conexao.php';

$dia = $_GET['atualizar'];

$sql = "SELECT crm, medico, andar, sala, mesa, dia, ti, turno FROM presenca WHERE dia = '$dia';";

echo $sql;

$result = mysqli_query($strcon, $sql);
$output .= ' <table id="presenca" class="table bg-success bg-gradient rounded text-white">
          <thead>
            <tr>
              <th scope="col">CRM</th>
              <th scope="col">NOME</th>
              <th scope="col">ANDAR</th>
              <th scope="col">SALA</th>
              <th scope="col">MESA</th>
              <th scope="col">DIA</th>
              <th scope="col">TI</th>
              <th scope="col">TURNO</th>
              <th scope="col-2">
                <input type="text" name="dia" id="dia" class="form-control" placeholder="Escolha uma data" />
              </th>
            </tr>
    ';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
            <tr>

            <td scope="col" class="border">' . $row["crm"] . '</td>

            <td scope="col" class="border">' . $row["medico"] . '</td>

            <td scope="col" class="border">' . $row["andar"] . '</td>

            <td scope="col" class="border">' . $row["sala"] . '</td>

            <td scope="col" class="border">' . $row["mesa"] . '</td>

            <td scope="col" class="border">' . $row["dia"] . '</td>

            <td scope="col" class="border">' . $row["ti"] . '</td>

            <td scope="col" class="border">' . $row["turno"] . '</td>

            <td scope="col" class="border">botoes</td>

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
