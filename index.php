<?php
//session_start();
include 'verificaLogin.php';
//echo $_SESSION['perfil'];
//echo $_SESSION['id'];
switch ($_SESSION['perfil']) {
    case '6':
        echo '<style type="text/css">
        .registroPresenca {
            display: none;
            }
            #atualizamedico {
                display: none;
            }
            #deletamedico {
                display: none;
            }
            #medicoCadModalBt {
                display: none;
            }
            </style>';
        break;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include 'includes/head.php';
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" style="background-color:#198754;" id="accordionSidebar">

            <!-- Sidebar - LOGO + Nome -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FVG</div>
            </a>

            <!-- divisor -->
            <hr class="sidebar-divisor bg-success my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- divisor -->
            <hr class="sidebar-divisor bg-success">

            <!-- Titulo opaco menu -->
            <div class="sidebar-heading">
                Registrar
            </div>

            <!-- Nav Item - Opcao opaco menu -->
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="presenca.php">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Presença</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="atendimento.php">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Atendimentos</span></a>
            </li>
            <li class="nav-item">
                <a id="medicoCadModalBt" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#medicoCadModal">
                    <i class="fa-solid fa-address-card"></i>Cadastrar médico</a>
            </li>
            <li class="nav-item">
                <a id="chamaModalChat" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#chatModal">
                    <i class="fa-solid fa-address-card"></i>Chat</a>
            </li>
            <!-- divisor -->
            <hr class="sidebar-divisor bg-success">
            <!-- divisor -->
            <hr class="sidebar-divisor d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divisor d-none d-sm-block">

                        </div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="img/undraw_profile.svg" width="40" height="40" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <h6 class="dropdown-header"><?php echo $_SESSION['usuario']; ?></h6>
                                <div class="dropdown-divider"></div>
                                <!--<a class="dropdown-item" href="#">Edit Profile</a>-->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Titulo opaco menu -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                        <form id="geraExcelAtendimento" action="DAO/geraExcelAtendimento.php" name="fromExcel" method="GET">

                            <div class="d-flex flex-row-reverse bd-highlight">
                                <div class="col mt-2">
                                    <input type="text" required="" autocomplete="off" name="diaFim" id="diaFim" class="form-control shadow-sm" placeholder="Escolha a data final">
                                </div>
                                <div class="col mt-2">
                                    <input type="text" required="" autocomplete="off" name="diaInicio" id="diaInicio" class="form-control shadow-sm" placeholder="Escolha a data inicial">
                                </div>
                                <div class="col mt-2 d-flex justify-content-end">
                                    <input type="submit" name="export" id="geraExcel" value="Gerar Excel" style="background-color:#198754;" class="align-middle btn btn-sm mt-1 text-white shadow-sm"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        $('#diaInicio').datetimepicker({
                            lang: 'pt-BR',
                            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                            nextText: 'Próximo',
                            prevText: 'Anterior',
                            format: 'Y-m-d',
                            timepicker: false
                        });
                        $('#diaFim').datetimepicker({
                            lang: 'pt-BR',
                            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                            nextText: 'Próximo',
                            prevText: 'Anterior',
                            format: 'Y-m-d',
                            timepicker: false
                        });
                        $.datetimepicker.setLocale('pt-BR');
                    </script>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body pt-2 pb-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fs-3 text-center fw-bold text-danger text-uppercase mb-1">
                                                Casos confirmados de covid-19
                                            </div>
                                            <div class="mb-0 fs-5 text-center fw-bold text-gray-800">
                                                <?php
                                                $curl = curl_init();
                                                $dMenosUm = date("Ymd", strtotime('-1 day', strtotime(date("Ymd"))));
                                                $url = "https://covid19-brazil-api.vercel.app/api/report/v1/brazil/" . $dMenosUm;
                                                curl_setopt_array($curl, array(
                                                    CURLOPT_URL => $url,
                                                    CURLOPT_RETURNTRANSFER => true,
                                                    CURLOPT_ENCODING => "",
                                                    CURLOPT_MAXREDIRS => 10,
                                                    CURLOPT_TIMEOUT => 30,
                                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                    CURLOPT_CUSTOMREQUEST => "GET"
                                                ));

                                                $response = curl_exec($curl);

                                                curl_close($curl);

                                                if (strstr($response, 'Minas Gerais')) {
                                                    $json = json_decode($response);
                                                    foreach ($json->data as $item) {
                                                        if ($item->uid == "31") {
                                                            $data = date_create($item->datetime);
                                                            echo "Em " .
                                                                date_format($data, "d/m/Y") . ", " .
                                                                $item->state . " tem " .
                                                                number_format($item->cases, 0, ",", ".") .
                                                                " casos confirmados";
                                                            echo " e um total de " .
                                                                number_format($item->deaths, 0, ",", ".") .
                                                                " óbitos.";
                                                        }
                                                    }
                                                } else {
                                                    echo "Sem dados hoje";
                                                }



                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  font-weight-bold text-primary text-uppercase mb-1">
                                                Acionamentos/mês</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include 'conexao.php';

                                                $sql = "select count(id) from 
                                                atendimento WHERE  month(dia) = month(CURDATE()) 
                                                AND year(dia) = year(CURDATE())";

                                                $buscar = mysqli_query($strcon, $sql);
                                                while ($dados = mysqli_fetch_array($buscar)) {
                                                    $dadoos = $dados['count(id)'];
                                                }
                                                echo $dadoos;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-double fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Acionamentos em análise/mês</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include 'conexao.php';

                                                $sql = "select count(id) from atendimento 
                                                WHERE status = 'em analise' 
                                                AND month(dia) = month(CURDATE()) 
                                                AND year(dia) = year(CURDATE())";

                                                $buscar = mysqli_query($strcon, $sql);
                                                while ($dados = mysqli_fetch_array($buscar)) {
                                                    $dadoos = $dados['count(id)'];
                                                }
                                                echo $dadoos;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">

                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Acionamentos paliativos/mês</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include 'conexao.php';

                                                $sql = "select count(id) from atendimento 
                                                WHERE status = 'resolvido paliativo' 
                                                AND month(dia) = month(CURDATE())
                                                 AND year(dia) = year(CURDATE())";

                                                $buscar = mysqli_query($strcon, $sql);
                                                while ($dados = mysqli_fetch_array($buscar)) {
                                                    $dadoos = $dados['count(id)'];
                                                }
                                                echo $dadoos;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-star-half-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Acionamentos resolvidos/mês</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include 'conexao.php';

                                                $sql = "select count(id) from atendimento 
                                                WHERE status = 'resolvido' 
                                                AND month(dia) = month(CURDATE())
                                                 AND year(dia) = year(CURDATE())";

                                                $buscar = mysqli_query($strcon, $sql);
                                                while ($dados = mysqli_fetch_array($buscar)) {
                                                    $dadoos = $dados['count(id)'];
                                                }
                                                echo $dadoos;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-star fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- graficos de pizza -->
                        <div class="col">
                            <div class="card shadow mb-4">
                                <!-- cabeçalho card -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sistemas em alta/hoje</h6>
                                </div>
                                <!-- corpo card -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="sistHj"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pie Chart -->
                        <div class="col">
                            <div class="card shadow mb-4">
                                <!-- cabeçalho card -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Erros em alta/hoje</h6>
                                    <!-- graficos de pizza 
									<div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divisor"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- corpo Card -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="errHj"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col">
                            <div class="card shadow mb-4">
                                <!-- cabeçalho card -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Médicos em alta/hoje</h6>
                                    <!-- graficos de pizza 
									<div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divisor"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- corpo card -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="medHj"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <!-- cabeçalho card -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Consolidado últimos 7 dias</h6>
                                    <!-- 3 pontinhos opções
									<div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- corpo card -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class="">
                                                </div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class="">
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="semanal" style="display: block; width: 661px; height: 320px;" width="661" height="320" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; FelpsTI 2022</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- MEDICO Modal-->
        <?php
        include 'includes/modalMedico.php';
        ?>
        <!-- chat Modal-->
        <?php
        include 'includes/chat.php';
        ?>
        <!-- logout Modal-->
        <?php
        include 'includes/logout.php';
        ?>
        <?php
        include 'includes/footer.php';
        ?>
</body>
<?php
function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}
?>

<script>
    var ctx = document.getElementById("semanal");

    <?php

    include 'conexao.php';
    $dias = [];
    $erros = [];
    $colors = [];
    $i = 0;

    $sql = "SELECT dia, COUNT(erro) as qtderro 
    FROM atendimento 
    WHERE dia > now() - INTERVAL 7 day 
    GROUP BY dia";

    $buscar = mysqli_query($strcon, $sql);
    while ($dados = mysqli_fetch_array($buscar)) {
        $dias[$i] = $dados['dia'];
        $erros[$i] = $dados['qtderro'];
        $colors[$i] = rand_color();
        $i++;
    }
    ?>

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($dias as $dia) { ?> '<?php echo $dia; ?>', <?php } ?>],
            datasets: [{
                label: "Atendimentos no dia",
                lineTension: 0.3,
                backgroundColor: "rgba(35, 160, 250, 1)",
                borderColor: "rgba(35, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(0, 0, 0, 1)",
                pointBorderColor: "rgba(35, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(35, 115, 223, 1)",
                pointHoverBorderColor: "rgba(0, 0, 0, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php foreach ($erros as $erro) { ?> '<?php echo $erro; ?>', <?php } ?>],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<script>
    // grafico donut sistemas alta hj
    // Pie Chart Example
    <?php
    include 'conexao.php';
    $sql = "SELECT sistema, 
                    COUNT(sistema) AS atendimentosXsistema 
                    FROM atendimento 
                    WHERE dia = DATE(NOW())
                    group by sistema 
                    order by atendimentosXsistema 
                    DESC LIMIT 5";

    $buscar = mysqli_query($strcon, $sql);
    $sistemas = [];
    $atds = [];
    $colors = [];
    $i = 0;
    while ($dados = mysqli_fetch_array($buscar)) {
        $sistemas[$i] = $dados['sistema'];
        $atds[$i] = $dados['atendimentosXsistema'];
        $colors[$i] = rand_color();
        $i++;
    }
    ?>

    var ctx = document.getElementById("sistHj");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {

            labels: [<?php foreach ($sistemas as $sistema) { ?> '<?php echo $sistema; ?>', <?php } ?>],
            datasets: [{
                data: [<?php foreach ($atds as $atd) { ?> '<?php echo $atd; ?>', <?php } ?>],
                backgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBackgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>

<script>
    // grafico donut erros alta hj
    // Pie Chart Example

    <?php
    include 'conexao.php';
    $sql = "SELECT erro, 
                    COUNT(erro) AS atendimentosXerro 
                    FROM atendimento 
                    WHERE dia = DATE(NOW())
                    group by erro 
                    order by atendimentosXerro 
                    DESC LIMIT 5";

    $buscar = mysqli_query($strcon, $sql);
    $erros = [];
    $atds = [];
    $colors = [];
    $i = 0;
    while ($dados = mysqli_fetch_array($buscar)) {
        $erros[$i] = $dados['erro'];
        $atds[$i] = $dados['atendimentosXerro'];
        $colors[$i] = rand_color();
        $i++;
    }
    ?>

    var ctx = document.getElementById("errHj");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {

            labels: [<?php foreach ($erros as $erro) { ?> '<?php echo $erro; ?>', <?php } ?>],
            datasets: [{
                data: [<?php foreach ($atds as $atd) { ?> '<?php echo $atd; ?>', <?php } ?>],
                backgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBackgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>


<script>
    // grafico donut medicos alta hj
    // Pie Chart Example

    <?php
    include 'conexao.php';

    $sql = "SELECT medico, 
                    COUNT(medico) AS atendimentosXmedico 
                    FROM atendimento 
                    WHERE dia = DATE(NOW())
                    group by medico 
                    order by atendimentosXmedico 
                    DESC LIMIT 5
                    ";

    $buscar = mysqli_query($strcon, $sql);
    $medicos = [];
    $atds = [];
    $colors = [];
    $i = 0;
    while ($dados = mysqli_fetch_array($buscar)) {
        $medicos[$i] = $dados['medico'];
        $atds[$i] = $dados['atendimentosXmedico'];
        $colors[$i] = rand_color();
        $i++;
    }
    ?>

    var ctx = document.getElementById("medHj");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {

            labels: [<?php foreach ($medicos as $medico) { ?> '<?php echo $medico; ?>', <?php } ?>],
            datasets: [{
                data: [<?php foreach ($atds as $atd) { ?> '<?php echo $atd; ?>', <?php } ?>],
                backgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBackgroundColor: [<?php foreach ($colors as $cor) { ?> '<?php echo $cor; ?>', <?php } ?>],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>

</html>