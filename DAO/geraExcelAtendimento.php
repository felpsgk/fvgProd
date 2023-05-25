<?php

require('../codeigniter/app/Libraries/PHPExcel.php');

require('../conexao.php');

$excel = new PHPExcel();


//selecting active sheet

$excel->setActiveSheetIndex(0);

//populate the data

//SELECT * FROM atendimento WHERE `dia` BETWEEN '2021-08-10' AND '2021-08-20';

$diaInicio = $_GET['diaInicio'];
$diaFim = $_GET['diaFim'];



$sql = "SELECT * FROM atendimento WHERE dia BETWEEN '$diaInicio' AND '$diaFim';";

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





//redirect to browser (download) instead of saving the result as a file

//this is for MS Office Excel xls format

ob_clean();

ob_start(); # added 

header('Content-type: application/vnd.ms-excel; charset=UTF-8');

header('Content-Disposition: attachment;filename="Atendimentos_' . $diaInicio . '_a_' . $diaFim . '.xlsx"');

header('Cache-Control: max-age=0');



//write the result to a file

$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');

//output to php output instead of filename

$file->save('php://output');
