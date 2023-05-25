<?php
require('conexao.php');
//expurgo de 50 mensagens atras
$sql = "DELETE FROM chat WHERE id=((SELECT id FROM chat order by id desc limit 1)-50);";
$stmt= $connect->prepare($sql);
$stmt->execute();

$sql = "SELECT * FROM chat;";
$result = mysqli_query($strcon, $sql);
while ($row = mysqli_fetch_array($result)) :; ?>
    <div id="msgs" class="bg-white m-1 text-break">
        <h4 class="text-dark m-1" id="sender"><?php echo $row['msgFrom'] ?></h4>
        <p class="text-dark m-2" id="message"><?php echo $row['msg'] ?></p>
    </div>
<?php endwhile;

?>