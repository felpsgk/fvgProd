<?php
//session_start();
include 'verificaLogin.php';
//echo $_SESSION['perfil'];
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
            <li class="nav-item active">
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

                    <!-- Page cabeçalho -->
                    <h1 class="h3 mb-4 text-gray-800">Registro de presença</h1>

                    <!-- linha nome e local -->
                    <div class="row">
                        <!-- coluna nome e local -->
                        <div class="col-lg-6">
                            <!-- seleção do medico -->
                            <form class="registroPresenca" id="inserir" name="inserir" method="post">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Médico</h6>
                                    </div>
                                    <div class="card-body">

                                        <input class="form-control shadow-sm" list="datalistOptions" id="medico" placeholder="Digite o nome nome medico" name="medico" required="" onchange="myFunction()">
                                        <datalist id="datalistOptions">
                                            <?php
                                            require 'DAO/medicoDAO.php';
                                            readMedicoList();
                                            ?>
                                            <input type="hidden" id="crmtxt" name="crm" value=""></input>
                                            <script>
                                                function myFunction() {
                                                    //PEGA A ID DO INPUT
                                                    var val = document.getElementById('medico').value;
                                                    //PEGA O ID DA OPÇÃO SELECIONADA
                                                    var text = $('#datalistOptions').find('option[value="' + val + '"]').attr('id');
                                                    // ALERTA USADO PRA TESTAR alert(text);
                                                    //PEGA O CRM E GUARDA NO HIDDEN PARA SALVAR NA TABELA
                                                    document.getElementById("crmtxt").value = text;
                                                }
                                            </script>
                                        </datalist>
                                    </div>
                                </div>
                                <!-- seleção do local -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Local</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="rowlocal" class="col">
                                            <div id="rowandarsalabtnsalvar" class="row mb-2">
                                                <div class="col">
                                                    <select class="form-select shadow-sm" id="andar" name="andar" required="required" aria-label="Default select example">
                                                        <option id="erro" value="">Selecione um andar...</option>
                                                        <?php
                                                        require 'DAO/andarDAO.php';
                                                        readAndar();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col ">
                                                    <select class="form-select shadow-sm" id="sala" name="sala" required="required" aria-label="Default select example">
                                                        <option id="erro" value="">Selecione uma sala...</option>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {

                                                                $('#andar').change(function() {
                                                                    var andarId = $(this).val();

                                                                    $.ajax({
                                                                        url: 'DAO/salaDAO.php',
                                                                        type: 'GET',
                                                                        data: {
                                                                            postandar: andarId
                                                                        },
                                                                        dataType: 'json',
                                                                        success: function(response) {

                                                                            var len = response.length;

                                                                            $('#sala').empty();

                                                                            $('#sala').append("<option id='erro' value=''>Selecione uma sala...</option>")
                                                                            for (var i = 0; i < len; i++) {

                                                                                $('#sala').append("<option value='" + response[i] + "'>" + response[i] + "</option>")

                                                                            }

                                                                        }
                                                                    });
                                                                });

                                                            });
                                                        </script>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="rowmesaturnobtnexcel" class="row mb-2">

                                                <div class="col ">
                                                    <select class="form-select shadow-sm" id="mesa" name="mesa" required="required" aria-label="Default select example">
                                                        <option id="erro" value="">Selecione uma mesa...</option>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {

                                                                $('#sala').change(function() {
                                                                    var salaId = $(this).val();
                                                                    var andarId = $('#andar').val();

                                                                    $.ajax({
                                                                        url: 'DAO/mesaDAO.php',
                                                                        type: 'GET',
                                                                        data: {
                                                                            postsala: salaId,
                                                                            postandar: andarId
                                                                        },
                                                                        dataType: 'json',
                                                                        success: function(response) {

                                                                            var len = response.length;

                                                                            $('#mesa').empty();

                                                                            $('#mesa').append("<option id='erro' value=''>Selecione uma mesa...</option>")

                                                                            for (var i = 0; i < len; i++) {

                                                                                $('#mesa').append("<option value='" + response[i] + "'>" + response[i] + "</option>")

                                                                            }

                                                                        }
                                                                    });
                                                                });

                                                            });
                                                        </script>
                                                    </select>
                                                </div>

                                                <div class="col ">
                                                    <select class="form-select shadow-sm" id="turno" name="turno" required="required" aria-label="Default select example">
                                                        <option id="erro" value="">Selecione um turno...</option>
                                                        <?php
                                                        require 'DAO/turnoDAO.php';
                                                        readTurno();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="ti" name="ti" value="<?php echo $_SESSION['usuario']; ?>"></input>
                                        <button type="submit" id="salvarPresenca" name="salvarPresenca" class="col-12 shadow-sm btn btn-success bg-gradient">salvar</button>
                                        <script>
                                            $(document).ready(function() {
                                                $('#inserir').on('submit', function(event) {
                                                    event.preventDefault();
                                                    $.ajax({
                                                        url: "DAO/medico/insert.php",
                                                        method: "POST",
                                                        data: $(this).serialize(),
                                                        dataType: "json",
                                                        success: function(data) {
                                                            if (data.crm) {
                                                                var html = '<tr>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.crm + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.medico + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.andar + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.sala + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.mesa + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.dia + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.ti + '</td>';
                                                                html += '<td scope="col" class="border" name="crm">' + data.turno + '</td>';
                                                                html += '<td scope="col" class="border" name="crm"></td>';
                                                                html += '<td scope="col" class="border" name="crm"></td>';
                                                                $('#corpoTabela').append(html);
                                                                //$('#inserir')[0].reset();
                                                            }
                                                        }
                                                    })
                                                });

                                            });
                                        </script>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- coluna excel -->
                <div class="col-lg-6">
                    <!-- gerar relatorio -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gerar relatório</h6>
                        </div>
                        <div class="card-body">
                            <form action="DAO/geraExcel.php" id="fromExcel" name="fromExcel" method="post">
                                <input type="hidden" form="fromExcel" required="" id="diaExcel" name="diaExcel" value=""></input>
                                <input type="text" form="fromExcel" required="" name="dia" id="dia" class="form-control mt-2" placeholder="Escolha uma data" />
                                <button type="submit" form="fromExcel" id="export" name="export" class="col-12 mt-2 shadow-sm btn btn-success bg-gradient">Gerar excel</button>
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
                                            $("#diaExcel").val(data);
                                            $.ajax({
                                                url: 'DAO/presencaDAO.php',
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
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIM DA ROW nome e local-->
            </div>
            <div class="container shadow bg-white p-3 mb-2 rounded">
                <div class="row">
                    <div class="col table-responsive">
                        <table id="dataTable" class="table bg-secondary bg-gradient rounded text-white" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border">CRM</th>
                                    <th scope="col" class="border">NOME</th>
                                    <th scope="col" class="border">ANDAR</th>
                                    <th scope="col" class="border">SALA</th>
                                    <th scope="col" class="border">MESA</th>
                                    <th scope="col" class="border">DIA</th>
                                    <th scope="col" class="border">TI</th>
                                    <th scope="col" class="border">TURNO</th>
                                    <th scope="col" class="border">
                                    <th scope="col" class="border">
                                </tr>
                            </thead>
                            <tbody id="corpoTabela">
                                <?php
                                require 'DAO/presencaDAO.php';
                                readPresenca();
                                ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer> -->
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
                    title: 'Presencas do dia',
                }],
                responsive: false

            });
        });
    </script>
</body>

</html>