<?php
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/PHPMailer.php');
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/SMTP.php');
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
require('/home2/hnrtco66/felps.hnrt.com.br/conexao.php');

$url = 'https://unimedbh-my.sharepoint.com/personal/trc6018386_unimedbh_com_br/_layouts/15/download.aspx?UniqueId=320da75a-5a75-40c3-a9ba-3845dba09dee&Translate=false&tempauth=eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTBmZjEtY2UwMC0wMDAwMDAwMDAwMDAvdW5pbWVkYmgtbXkuc2hhcmVwb2ludC5jb21AMzczN2RkZjctMGI2MC00ZjczLWEwY2UtMmFiZTViYjk0Y2Y0IiwiaXNzIjoiMDAwMDAwMDMtMDAwMC0wZmYxLWNlMDAtMDAwMDAwMDAwMDAwIiwibmJmIjoiMTY0Nzg2NzMxOCIsImV4cCI6IjE2NDc4NzA5MTgiLCJlbmRwb2ludHVybCI6Im9scE0yWFJlTGswYTQ4V1FOdFdQaUFmZlZrNFV5L2Jncll6ck5DaTlid0k9IiwiZW5kcG9pbnR1cmxMZW5ndGgiOiIxNTgiLCJpc2xvb3BiYWNrIjoiVHJ1ZSIsImNpZCI6Ik1HVTBOakkxTnpRdFptWmtZaTFpT0RaaExUTmhPRGd0TTJNMk5tTTNNalJsWTJFeSIsInZlciI6Imhhc2hlZHByb29mdG9rZW4iLCJzaXRlaWQiOiJZVGszWWpWaU1URXRZalJoWVMwME9UVTBMVGczWmpZdFpURXhaRFl3TnpKaE56WXoiLCJhcHBfZGlzcGxheW5hbWUiOiJPZmZpY2VIb21lIiwiZ2l2ZW5fbmFtZSI6IkZlbGlwZSIsImZhbWlseV9uYW1lIjoiUGVyZWlyYSBNYWNoYWRvIiwic2lnbmluX3N0YXRlIjoiW1wia21zaVwiXSIsImFwcGlkIjoiNDc2NTQ0NWItMzJjNi00OWIwLTgzZTYtMWQ5Mzc2NTI3NmNhIiwidGlkIjoiMzczN2RkZjctMGI2MC00ZjczLWEwY2UtMmFiZTViYjk0Y2Y0IiwidXBuIjoidHJjNjAxODM4NkB1bmltZWRiaC5jb20uYnIiLCJwdWlkIjoiMTAwMzIwMDBEMEFEMjQ3MiIsImNhY2hla2V5IjoiMGguZnxtZW1iZXJzaGlwfDEwMDMyMDAwZDBhZDI0NzJAbGl2ZS5jb20iLCJzY3AiOiJhbGxmaWxlcy53cml0ZSBhbGxzaXRlcy5yZWFkIiwidHQiOiIyIiwidXNlUGVyc2lzdGVudENvb2tpZSI6bnVsbCwiaXBhZGRyIjoiNDAuMTI2LjQ1LjI0In0.ODJiaCtPTmc2Q3ZObjBmdGdxOHlGajBkLzF4UTJmanpkc0pyWlk1VVBrND0&ApiVersion=2.0';
$file_name = basename($url);
file_put_contents("/home2/hnrtco66/felps.hnrt.com.br/rel/horasTrabalhadas.xlsx", file_get_contents($url));

 $mail = new PHPMailer(true);
 
 try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'felps.hnrt.com.br';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'envio@felps.hnrt.com.br';                     //SMTP username
    $mail->Password   = '84141398aB';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('envio@felps.hnrt.com.br', 'Horas Trabalhadas');
    $mail->addAddress('contatofemachado@gmail.com', 'Felipe');     //Add a recipient
    $mail->addCC('gkgeekstation@gmail.com');

    //Attachments
    $mail->addAttachment('/home2/hnrtco66/felps.hnrt.com.br/rel/horasTrabalhadas.xlsx');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Horas Trabalhadas';
    $mail->Body    = 'Horas trabalhadas referente ao mes em questao';
    $mail->AltBody = 'sem html';

    $mail->send();
    echo 'Email enviado';
} catch (Exception $e) {
    echo "Email nao enviado. Mailer Error: {$mail->ErrorInfo}";
}
?>