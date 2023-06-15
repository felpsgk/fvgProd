<?php
require('conexao.php');
//expurgo da mensagem 50 atras
$query = "SELECT * FROM chat ORDER BY id DESC LIMIT 1 OFFSET 39";
$result = $strcon->query($query);
if ($result->num_rows > 0) {
    // Obtém o ID do registro a ser deletado
    $row = $result->fetch_assoc();
    $idToDelete = $row['id'];

    // Excluindo o registro
    $deleteQuery = "DELETE FROM chat WHERE id = $idToDelete";
    if ($strcon->query($deleteQuery) == TRUE) {
        $sql = "SELECT * FROM chat;";
        $result = mysqli_query($strcon, $sql);
        while ($row = mysqli_fetch_array($result)) :; ?>
            <div id="msgs" class="bg-white m-1 text-break">
                <h4 class="text-dark m-1" id="sender"><?php echo $row['msgFrom'] ?></h4>
                <p class="text-dark m-2" id="message"><?php echo $row['msg'] ?></p>
                <div class="row">
                    <p class="col text-start m-2 fst-italic" id="dataMsg"><?php echo $row['dataMsg'] ?></p>
                    <p class="col text-end m-2 fst-italic" id="dataMsg"><?php echo $row['horaMsg'] ?></p>
                </div>
            </div>
        <?php endwhile;
    } else {
        echo "Erro ao excluir o registro: " . $strcon->error;
    }
} else {
    $sql = "SELECT * FROM chat;";
    $result = mysqli_query($strcon, $sql);
    while ($row = mysqli_fetch_array($result)) :; ?>
        <div id="msgs" class="bg-white m-1 text-break">
            <h4 class="text-dark m-1" id="sender"><?php echo $row['msgFrom'] ?></h4>
            <p class="text-dark m-2" id="message"><?php echo $row['msg'] ?></p>
            <div class="row">
                <p class="col text-start m-2 fst-italic" id="dataMsg"><?php echo $row['dataMsg'] ?></p>
                <p class="col text-end m-2 fst-italic" id="dataMsg"><?php echo $row['horaMsg'] ?></p>
            </div>
        </div>
<?php endwhile;
}
?>