<?php
//session_start();
include 'verificaLogin.php';
//echo $_SESSION['perfil'];
switch ($_SESSION['perfil']) {
    case '6':
        echo '<style type="text/css">
        .atendimentoForm {
            display: none;
            }
            #atualizaatendimento {
                display: none;
            }
            #deletaatendimento {
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
            <li class="nav-item">
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
            <li class="nav-item active">
                <a class="nav-link" href="atendimento.php">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Atendimentos</span></a>
            </li>
            <li class="nav-item">
                <a id="medicoCadModalBt" class="nav-link" href="#" data-toggle="modal" data-target="#medicoCadModal">
                    <i class="fa-solid fa-address-card"></i>Cadastrar médico</a>
            </li>

            <!-- divisor -->
            <hr class="sidebar-divisor bg-success">

            <!-- Titulo opaco menu 
            <div class="sidebar-heading">
                Visualizar
            </div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-chart-bar"></i>
                    <span>Gráficos</span></a>
            </li>-->

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Registro de atendimentos</h1>

                    <form class="atendimentoForm" action="DAO/atendimentoDAO.php" name="fromAtendimento" method="post">
                        <!-- linha medico -->
                        <div class="row">
                            <!-- linha nome -->
                            <!-- coluna nome -->
                            <div class="col">
                                <!-- seleção do medico -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Médico</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="rownome" class="row mb-2">
                                            <div class="col">
                                                <input class="form-control shadow-sm" autocomplete="off" list="datalistOptionsDia" id="medico" placeholder="Digite o nome nome medico" name="medico" required="required" onchange="myFunctionDia()">
                                                <datalist id="datalistOptionsDia">
                                                    <?php
                                                    require 'DAO/medicoDAO.php';
                                                    readMedicoDia();
                                                    ?>
                                                    <input type="hidden" id="txtcrm" name="crm" value=""></input>
                                                    <script>
                                                        function myFunctionDia() {
                                                            //PEGA A ID DO INPUT
                                                            var val = document.getElementById('medico').value;
                                                            //PEGA O ID DA OPÇÃO SELECIONADA
                                                            var text = $('#datalistOptionsDia').find('option[value="' + val + '"]').attr('id');
                                                            //alert(text);
                                                            //PEGA O CRM E GUARDA NO HIDDEN PARA SALVAR NA TABELA
                                                            document.getElementById("txtcrm").value = text;
                                                        }
                                                    </script>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- linha sistema e erro -->
                        <div class="row">
                            <!-- coluna sistema -->
                            <div class="col">
                                <!-- seleção do sistema -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <input class="form-control shadow-sm" autocomplete="off" list="datalistOptionsSis" id="sistema" placeholder="Digite o sistema" name="sistema" required="required" onchange="myFunctionDia()">
                                        <datalist id="datalistOptionsSis">
                                            <?php
                                            require 'DAO/sistemaDAO.php';
                                            readSistema();
                                            ?>
                                            <!--
                                            <input type="hidden" id="txtcrm" name="crm" value=""></input>
                                            <script>
                                            function myFunctionDia() {
                                                //PEGA A ID DO INPUT
                                                var val = document.getElementById('medico').value;
                                                //PEGA O ID DA OPÇÃO SELECIONADA
                                                var text = $('#datalistOptionsDia').find('option[value="' + val + '"]').attr('id');
                                                //alert(text);
                                                //PEGA O CRM E GUARDA NO HIDDEN PARA SALVAR NA TABELA
                                                document.getElementById("txtcrm").value = text;
                                            }
                                            </script>-->
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <!-- coluna erro -->
                            <div class="col">
                                <!-- seleção do sistema -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Erro</h6>
                                    </div>
                                    <div class="card-body">
                                        <input class="form-control shadow-sm" autocomplete="off" list="datalistOptionsErr" id="erro" placeholder="Digite o erro" name="erro" required="required" onchange="myFunctionDia()">
                                        <datalist id="datalistOptionsErr">
                                            <?php
                                            require 'DAO/erroDAO.php';
                                            readErro();
                                            ?>
                                            <!--
                                            <input type="hidden" id="txtcrm" name="crm" value=""></input>
                                            <script>
                                            function myFunctionDia() {
                                                //PEGA A ID DO INPUT
                                                var val = document.getElementById('medico').value;
                                                //PEGA O ID DA OPÇÃO SELECIONADA
                                                var text = $('#datalistOptionsDia').find('option[value="' + val + '"]').attr('id');
                                                //alert(text);
                                                //PEGA O CRM E GUARDA NO HIDDEN PARA SALVAR NA TABELA
                                                document.getElementById("txtcrm").value = text;
                                            }
                                            </script>-->
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- linha criticidade -->
                        <div class="row">
                            <!-- coluna criticidade -->
                            <div class="col">
                                <!-- seleção do criticidade -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Criticidade</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="criticidade" class="row mb-2">
                                            <div class="btn-group" role="criticidade" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="btnradioCrit" value="BAIXA" id="btnRadBaixa" required="required" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnRadBaixa">Baixa</label>

                                                <input type="radio" class="btn-check" name="btnradioCrit" value="MEDIA" id="btnRadMedia" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnRadMedia">Media</label>

                                                <input type="radio" class="btn-check" name="btnradioCrit" value="ALTA" id="btnRadAlta" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnRadAlta">Alta</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- linha descrição e solução -->
                        <div class="row">
                            <!-- coluna descrição -->
                            <div class="col">
                                <!-- texto do criticidade -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Descrição do erro</h6>
                                    </div>
                                    <div class="card-body">
                                        <textarea maxLength="512" autocomplete="on" class="form-control shadow-sm" required="required" id="txtDescErro" name="txtDescErro" placeholder="Como ocorreu o erro?" name="txtDescErro"></textarea>
                                        <p class="small text-end"><span class="caracteresDescErro">512</span> Restantes</p>
                                        <!--<input type="text" class="form-control shadow-sm" id="txtDescErro" name="txtDescErro" aria-describedby="emailHelp" required="required" placeholder="Descrição do erro">-->
                                    </div>
                                </div>
                            </div>
                            <!-- coluna solução -->
                            <div class="col">
                                <!-- texto do criticidade -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Solução para o erro</h6>
                                    </div>
                                    <div class="card-body">
                                        <textarea maxLength="512" autocomplete="on" class="form-control shadow-sm" required="required" id="txtSolErro" name="txtSolErro" placeholder="Como solucionou o erro?" name="txtSolErro"></textarea>
                                        <p class="small text-end"><span class="caracteresSolErro">512</span> Restantes</p>
                                        <!--<input type="text" class="form-control shadow-sm" id="txtSolErro" name="txtSolErro" aria-describedby="emailHelp" required="required" placeholder="Solução do erro">-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- linha status -->
                        <div class="row">
                            <!-- coluna status -->
                            <div class="col">
                                <!-- seleção do status -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="criticidade" class="row mb-2">
                                            <div class="btn-group" role="solucao" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="btnradioSol" value="RESOLVIDO" id="btnRes" required="required" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnRes">Resolvido</label>

                                                <input type="radio" class="btn-check" name="btnradioSol" value="RESOLVIDO PALIATIVO" id="btnResPal" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnResPal">Resolvido paliativo</label>

                                                <input type="radio" class="btn-check" name="btnradioSol" value="EM ANALISE" id="btnAnalise" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnAnalise">Em análise</label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="ti" name="ti" value="<?php echo $_SESSION['usuario']; ?>"></input>
                                        <button type="submit" name="submit" class="col-12 mb-1 shadow-sm btn btn-success bg-gradient">salvar</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <!-- linha excel gera -->
                <div class="row">
                    <!-- coluna excel gera -->
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Gerar relatório entre datas específicas</h6>
                            </div>
                            <div class="card-body">
                                <form id="geraExcelAtendimento" action="DAO/geraExcelAtendimento.php" name="fromExcel" method="GET">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <input type="text" required="" autocomplete="off" name="diaInicio" id="diaInicio" class="form-control shadow-sm " placeholder="Escolha a data inicial">
                                        </div>
                                        <div class="col">
                                            <input type="text" required="" autocomplete="off" name="diaFim" id="diaFim" class="form-control shadow-sm " placeholder="Escolha a data final">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="submit" name="export" id="geraExcel" value="Gerar Excel" class="col-12 mb-1 shadow-sm btn btn-success bg-gradient">
                                        </div>
                                    </div>
                                </form>
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Atendimentos do dia</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex bd-highlight">
                            <div class="bd-highlight">
                                <input type="text" name="dia" id="dia" class="form-control shadow-sm" placeholder="Escolha uma data para visualizar" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table bg-secondary bg-gradient rounded text-white" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border">CRM</th>
                                        <th scope="col" class="border">NOME</th>
                                        <th scope="col" class="border">ANDAR</th>
                                        <th scope="col" class="border">SALA</th>
                                        <th scope="col" class="border">MESA</th>
                                        <th scope="col" class="border">SISTEMA</th>
                                        <th scope="col" class="border">CRITICIDADE</th>
                                        <th scope="col" class="border">ERRO</th>
                                        <th scope="col" class="border">DESCRIÇÃO</th>
                                        <th scope="col" class="border">STATUS</th>
                                        <th scope="col" class="border">OBSERVAÇÃO</th>
                                        <th scope="col" class="border">DIA</th>
                                        <th scope="col" class="border">MÊS</th>
                                        <th scope="col" class="border">HORA</th>
                                        <th scope="col" class="border">TI</th>
                                        <th scope="col" class="border">
                                        <th scope="col" class="border">
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'DAO/atendimentoDAO.php';
                                    readAtendimento();
                                    ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                paging: false,
                select: true,
                fixedHeader: true,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    title: 'atendimentos do dia',
                }],
                responsive: false

            });
        });
    </script>
</body>
</html>
<!--CONTA CARACTERES RESTANTES-->
<script>
    $(document).on("input", "#txtDescErro", function() {
        var limite = 512;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;
        $(".caracteresDescErro").text(caracteresRestantes);
    });
</script>
<!--CONTA CARACTERES RESTANTES-->
<script>
    $(document).on("input", "#txtSolErro", function() {
        var limite = 512;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;
        $(".caracteresSolErro").text(caracteresRestantes);
    });
</script>
<script>
    $(document).ready(function() {
        $('#dia').datetimepicker({
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
        $("#dia").change(function() {
            var data = $("#dia").val();
            $.ajax({
                url: 'DAO/atendimentoDAO.php',
                method: "GET",
                data: {
                    atualizar: data
                },
                success: function(data) {
                    $('#dataTable').html(data);
                }

            })

        })
        $.datetimepicker.setLocale('pt-BR');
    });
</script>