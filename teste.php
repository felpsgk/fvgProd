<?php
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/PHPMailer.php');
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/SMTP.php');
 require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPMailer/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
 //require '../codeigniter/vendor/autoload.php';
 
 
require('/home2/hnrtco66/felps.hnrt.com.br/codeigniter/app/Libraries/PHPExcel.php');

require('/home2/hnrtco66/felps.hnrt.com.br/conexao.php');

$excel = new PHPExcel();


//selecting active sheet

//populate the data

//SELECT * FROM atendimento WHERE `dia` BETWEEN '2021-08-10' AND '2021-08-20';

$mes = date(m);

switch ($mes) {
        case 1:
            $mes = 'DEZEMBRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 2:
            $mes = 'JANEIRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 3:
            $mes = 'FEVEREIRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 4:
            $mes = 'MARCO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 5:
            $mes = 'ABRIL';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 6:
            $mes = 'MAIO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 7:
            $mes = 'JUNHO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 8:
            $mes = 'JULHO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 9:
            $mes = 'AGOSTO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 10:
            $mes = 'SETEMBRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 11:
            $mes = 'OUTUBRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
        case 12:
            $mes = 'NOVEMBRO';
$sql = "SELECT * FROM atendimento WHERE mes = '$mes';";
            break;
    }


$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setTitle("RELATORIO ".$mes);

//echo $sql;

$result = mysqli_query($strcon, $sql);


$linha = 3;

while ($data = mysqli_fetch_object($result)) {

    $diaExcel = $data->dia;
    
    $excel->getActiveSheet()

        ->setCellValue('A' . $linha, $data->ti)

        ->setCellValue('B' . $linha, date("d/m/Y", strtotime($diaExcel)))

        ->setCellValue('C' . $linha, $data->mes)

        ->setCellValue('D' . $linha, $data->hora)

        ->setCellValue('E' . $linha, $data->crm)

        ->setCellValue('F' . $linha, $data->medico)

        ->setCellValue('G' . $linha, $data->sistema)

        ->setCellValue('H' . $linha, $data->criticidade)

        ->setCellValue('I' . $linha, $data->erro)

        ->setCellValue('J' . $linha, $data->descricao)

        ->setCellValue('L' . $linha, $data->status)

        ->setCellValue('M' . $linha, $data->sala)

        ->setCellValue('N' . $linha, $data->mesa)

        ->setCellValue('O' . $linha, $data->andar)

        ->setCellValue('P' . $linha, $data->observacao);

    //increment the row

    $linha++;
}

//set column width
/*
$excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

$excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
 */
//make table headers

$excel->getActiveSheet()

    ->setCellValue('A1', 'ATENDIMENTOS') //this is a title

    ->setCellValue('A2', 'TI')

    ->setCellValue('B2', 'DIA')

    ->setCellValue('C2', 'MES')

    ->setCellValue('D2', 'HORA')

    ->setCellValue('E2', 'CRM')

    ->setCellValue('F2', 'MEDICO')

    ->setCellValue('G2', 'SISTEMA')

    ->setCellValue('H2', 'CRITICIDADE')

    ->setCellValue('I2', 'ERRO')

    ->setCellValue('J2', 'DESCRICAO DO ERRO')

    ->setCellValue('K2', 'ATENDIMENTO')

    ->setCellValue('L2', 'STATUS')

    ->setCellValue('M2', 'SALA')

    ->setCellValue('N2', 'MESA')

    ->setCellValue('O2', 'ANDAR')

    ->setCellValue('P2', 'OBS');

//merging the title

$excel->getActiveSheet()->mergeCells('A1:P1');

//aligning

$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');



//styling

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(

    array(

        'font' => array(

            'size' => 22

        )

    )

);

$excel->getActiveSheet()->getStyle('A2:P2')->applyFromArray(

    array(

        'font' => array(

            'bold' => true,

            'size' => 14,

        ),

        'borders' => array(

            'allborders' => array(

                'style' => PHPExcel_Style_Border::BORDER_THIN

            )

        ),

        'alignment' => array(

            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,

        )

    )

);

//give borders to data

$excel->getActiveSheet()->getStyle('A3:P' . ($linha - 1))->applyFromArray(

    array(

        'borders' => array(

            'outline' => array(

                'style' => PHPExcel_Style_Border::BORDER_THIN

            ),

            'vertical' => array(

                'style' => PHPExcel_Style_Border::BORDER_THIN

            )

        ),

        'alignment' => array(

            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,

        )

    )

);

/** GRﾃ：ICOS QUE Nﾃグ DERAM CERTO AINDA
 * 
 * 
$excel->createSheet(1);
$excel->setActiveSheetIndex(1);
$excel->getActiveSheet()->setTitle("Graficos");


$values = new PHPExcel_Chart_DataSeriesValues('Number', 'Base AGOSTO!H3:H965');
$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Base AGOSTO!A3:A965');

//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
    PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
    PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
    array(0),                                       // plotOrder
    array(),                                        // plotLabel
    array($categories),                             // plotCategory
    array($values)                                  // plotValues
  );
  $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_VERTICAL);

  $layout = new PHPExcel_Chart_Layout();
  $plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));
  $xTitle = new PHPExcel_Chart_Title('xAxisLabel');
  $yTitle = new PHPExcel_Chart_Title('yAxisLabel');

  $chart = new PHPExcel_Chart('sample', null, null, $plotarea, true,0,$xTitle,$yTitle);

  $chart->setTopLeftPosition('A2');
  $chart->setBottomRightPosition('J20');
  
$excel->getActiveSheet()->setCellValue('A1', 'ATENDIMENTOS');
//	Add the chart to the worksheet
$excel->getActiveSheet()->addChart($chart);
 * 
 * 
**/

//redirect to browser (download) instead of saving the result as a file

//this is for MS Office Excel xls format

ob_clean();

ob_start(); # added 

//header('Content-type: application/vnd.ms-excel; charset=UTF-8');

//header('Content-Disposition: attachment;filename="Atendimentos_' . $diaInicio . '_a_' . $diaFim . '.xlsx"');

//header('Cache-Control: max-age=0');


$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->setIncludeCharts(TRUE);

//output to php output instead of filename

$file->save('/home2/hnrtco66/felps.hnrt.com.br/rel/'.$mes.'reports.xlsx');

//write the result to a file


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
    $mail->setFrom('envio@felps.hnrt.com.br', 'Relatorio');
    $mail->addAddress('contatofemachado@gmail.com', 'Felipe');     //Add a recipient
    $mail->addCC('huberton.campos@unimedbh.com.br');

    //Attachments
    $mail->addAttachment('/home2/hnrtco66/felps.hnrt.com.br/rel/reports.xlsx');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Relatorio mensal telessaude';
    $mail->Body    = 'Referente ao mes anterior';
    $mail->AltBody = 'sem html';

    $mail->send();
    echo 'Email enviado';
} catch (Exception $e) {
    echo "Email nao enviado. Mailer Error: {$mail->ErrorInfo}";
}
 
?>