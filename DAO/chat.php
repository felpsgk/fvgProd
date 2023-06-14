<?php
require('conexao.php');
//expurgo da mensagem 50 atras
$query = "SELECT * FROM chat ORDER BY id DESC LIMIT 1 OFFSET 49";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // Obtém o ID do registro a ser deletado
    $row = $result->fetch_assoc();
    $idToDelete = $row['id'];

    // Excluindo o registro
    $deleteQuery = "DELETE FROM chat WHERE id = $idToDelete";
    if ($conn->query($deleteQuery) == TRUE) {
        echo "O último quinquagésimo registro foi excluído com sucesso!";
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
    }
} else {
    echo "Não foi encontrado o último quinquagésimo registro na tabela.";
}

$sql = "SELECT * FROM chat;";
$result = mysqli_query($strcon, $sql);
while ($row = mysqli_fetch_array($result)) :; ?>
    <div id="msgs" class="bg-white m-1 text-break">
        <h4 class="text-dark m-1" id="sender"><?php echo $row['msgFrom'] ?></h4>
        <p class="text-dark m-2" id="message"><?php echo $row['msg'] ?></p>
    </div>
<?php endwhile;

?>