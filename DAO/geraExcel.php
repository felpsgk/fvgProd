<?php



if (isset($_POST['export'])) {

    $dia = $_POST['diaExcel'];



    require('../codeigniter/app/Libraries/PHPExcel.php');

    require('../conexao.php');



    $excel = new PHPExcel();

    //selecting active sheet
    $excel->setActiveSheetIndex(0);

    //populate the data
    //$dia = date("Y-m-d");

    $result = mysqli_query($strcon, "SELECT * FROM presenca WHERE dia = '$dia';");

    //echo $sql;

    $linha = 3;

    while ($data = mysqli_fetch_object($result)) {

        $excel->getActiveSheet()
            ->setCellValue('A' . $linha, $data->medico)
            ->setCellValue('B' . $linha, $data->crm)
            ->setCellValue('C' . $linha, $data->andar)
            ->setCellValue('D' . $linha, $data->sala)
            ->setCellValue('E' . $linha, $data->mesa)
            ->setCellValue('F' . $linha, $data->dia)
            ->setCellValue('G' . $linha, $data->ti)
            ->setCellValue('H' . $linha, $data->turno);
        //increment the row
        $linha++;
    }

    //set column width
    $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

    //make table headers
    $excel->getActiveSheet()
        ->setCellValue('A1', 'PRESENÇAS DO DIA') //this is a title
        ->setCellValue('A2', 'NOME')
        ->setCellValue('B2', 'CRM')
        ->setCellValue('C2', 'ANDAR')
        ->setCellValue('D2', 'SALA')
        ->setCellValue('E2', 'MESA')
        ->setCellValue('F2', 'TI')
        ->setCellValue('G2', 'TURNO')
        ->setCellValue('H2', 'DIA');

    //merging the title
    $excel->getActiveSheet()->mergeCells('A1:H1');

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
    $excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(
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
    $excel->getActiveSheet()->getStyle('A3:H' . ($linha - 1))->applyFromArray(
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
    header('Content-Disposition: attachment;filename="presencasDia'.$dia.'.xlsx"');
    header('Cache-Control: max-age=0');

    //write the result to a file
    $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    //output to php output instead of filename
    $file->save('php://output');
}
