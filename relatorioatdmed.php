<?php
session_start();
include 'verificaLogin.php';
?>


<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/black-tie/jquery-ui.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <style>
    .dropdown-item.active,
    .dropdown-item:active {
      color: #fff;
      background-color: #198754;
    }
  </style>

  <title>FVG - Gerência</title>
</head>


<body class="bg-success">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand text-success" href="#">FVG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="atendimento.php">Atendimento</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Relatórios
            </a>
            <ul class="dropdown-menu active" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item " href="relatorioatddia.php">Hoje</a></li>
              <li><a class="dropdown-item active bg-success" href="relatorioatdmed.php">Data específica</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#cadastromedico">Cadastrar médico</a>
          </li>
        </ul>

        <li class="nav-item d-flex">
          <a class="btn btn-success bg-gradient" href="logout.php">Sair</a>

        </li>
      </div>
    </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="cadastromedico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cadastrar novo médico</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="DAO/medicoDAO.php" method="POST">
          <div class="modal-body">


            <div class="form-group">
              <label for="nome">Nome do médico</label>
              <input type="text" required="required" id="nome" name="nome" id="nome" class="form-control" placeholder="nome">
            </div>

            <div class="form-group">
              <label for="crm">CRM do médico</label>
              <input maxlength="8" required="required" type="text" id="crm" name="crm" id="crmModal" class="form-control" placeholder="crm">
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="inserirmedico" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row shadow bg-white p-3 mb-5 rounded">
      <h2 class="text-center">Gerar relatório de uma data específica</h2>
      <hr class="bg-danger border-2 border-top border-success">
      <h4 class="text-center">Escolha uma data</h4>
      <div class="row mb-2">
        <div class="col">
          <input type="hidden" id="diaRelatorios" name="diaRelatorios" value=""></input>
          <input type="text" required name="dataRel" id="dataRel" class="form-control shadow-sm" placeholder="Escolha a data" />
        </div>
      </div>

      <script type="text/javascript">
        google.charts.load('current', {
          packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback();

        function load_sistemas(sistemas, title) {
          var temp_title = "Top 5 sistemas do dia " + ' ' + sistemas + '';
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              sistemas: sistemas
            },
            dataType: "JSON",
            success: function(data) {
              drawSistemasChart(data, temp_title);
            }
          });
        }

        function drawSistemasChart(sistemas, chart_main_title) {
          var jsonData = sistemas;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'sistema');
          data.addColumn('number', 'atendimentosXsistema');

          $.each(jsonData, function(i, jsonData) {
            var sistema = jsonData.sistema;
            var atendimentosXsistema = parseFloat($.trim(jsonData.atendimentosXsistema));
            data.addRows([
              [sistema, atendimentosXsistema]
            ]);
          });
          var options = {
            title: chart_main_title,
            hAxis: {
              title: "sistema"
            },
            vAxis: {
              title: 'atendimentosXsistema'
            }
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('sistemas'));
          chart.draw(data, options);
        }
      </script>
      <div id="sistemas" style="width: 1000px; height: 620px;"></div>

      <script type="text/javascript">
        google.charts.load('current', {
          packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback();

        function load_erros(erros, title) {
          var temp_title = "Top 5 erros do dia " + ' ' + erros + '';
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              erros: erros
            },
            dataType: "JSON",
            success: function(data) {
              drawErrosChart(data, temp_title);
            }
          });
        }

        function drawErrosChart(erros, chart_main_title) {
          var jsonData = erros;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'erro');
          data.addColumn('number', 'atendimentosXerro');

          $.each(jsonData, function(i, jsonData) {
            var erro = jsonData.erro;
            var atendimentosXerro = parseFloat($.trim(jsonData.atendimentosXerro));
            data.addRows([
              [erro, atendimentosXerro]
            ]);
          });
          var options = {
            title: chart_main_title,
            hAxis: {
              title: "erro"
            },
            vAxis: {
              title: 'atendimentosXerro'
            }
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('erros'));
          chart.draw(data, options);
        }
      </script>
      <div id="erros" style="width: 1000px; height: 620px;"></div>

      <script type="text/javascript">
        google.charts.load('current', {
          packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback();

        function load_medicos(medicos, title) {
          var temp_title = "Top 5 medicos do dia " + ' ' + medicos + '';
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              medicos: medicos
            },
            dataType: "JSON",
            success: function(data) {
              drawMedicosChart(data, temp_title);
            }
          });
        }

        function drawMedicosChart(medicos, chart_main_title) {
          var jsonData = medicos;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'medico');
          data.addColumn('number', 'atendimentosXmedico');

          $.each(jsonData, function(i, jsonData) {
            var medico = jsonData.medico;
            var atendimentosXmedico = parseFloat($.trim(jsonData.atendimentosXmedico));
            data.addRows([
              [medico, atendimentosXmedico]
            ]);
          });
          var options = {
            title: chart_main_title,
            hAxis: {
              title: "medico"
            },
            vAxis: {
              title: 'atendimentosXmedico'
            }
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('medicos'));
          chart.draw(data, options);
        }
      </script>
      <div id="medicos" style="width: 1000px; height: 620px;"></div>

      <script type="text/javascript">
        google.charts.load('current', {
          packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback();

        function load_medicos_status(medicos_status, title) {
          var temp_title = "Top 5 medicos e sua situação do dia " + ' ' + medicos_status + '';
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              medicos_status: medicos_status
            },
            dataType: "JSON",
            success: function(data) {
          console.log(data);
              drawMedicos_statusChart(data, temp_title);
            }
          });
        }

        function drawMedicos_statusChart(medicos_status, chart_main_title) {
          var jsonData = medicos_status;
          console.log(medicos_status);
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'medico');
          data.addColumn('number', 'atendimentosXmedicos_status');
          data.addColumn('number', 'resolvido');
          data.addColumn('number', 'analise');
          data.addColumn('number', 'paliativo');

          $.each(jsonData, function(i, jsonData) {
            var medico = jsonData.medico;
            var atendimentosXmedicos_status = parseFloat($.trim(jsonData.atendimentosXmedicos_status));
            var resolvido = parseFloat($.trim(jsonData.resolvido));
            var analise = parseFloat($.trim(jsonData.analise));
            var paliativo = parseFloat($.trim(jsonData.paliativo));
            data.addRows([
              [medico, atendimentosXmedicos_status,resolvido,analise,paliativo]
            ]);
          });
          var options = {
            title: chart_main_title,
            hAxis: {
              title: "medicos_status"
            },
            colors: ['#42a7f5', 'green', 'red', 'orange'],
            vAxis: {
              title: 'atendimentosXmedicos_status'
            }
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('medicos_status'));
          chart.draw(data, options);
        }
      </script>
      <div id="medicos_status" style="width: 1000px; height: 620px;"></div>

      <script type="text/javascript">
        google.charts.load('current', {
          packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback();

        function load_erros_status(erros_status, title) {
          var temp_title = "Top 5 erros e sua situação do dia " + ' ' + erros_status + '';
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              erros_status: erros_status
            },
            dataType: "JSON",
            success: function(data) {
          console.log(data);
              drawErros_statusChart(data, temp_title);
            }
          });
        }

        function drawErros_statusChart(erros_status, chart_main_title) {
          var jsonData = erros_status;
          console.log(erros_status);
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'erro');
          data.addColumn('number', 'atendimentosXerros_status');
          data.addColumn('number', 'resolvido');
          data.addColumn('number', 'analise');
          data.addColumn('number', 'paliativo');

          $.each(jsonData, function(i, jsonData) {
            var erro = jsonData.erro;
            var atendimentosXerros_status = parseFloat($.trim(jsonData.atendimentosXerros_status));
            var resolvido = parseFloat($.trim(jsonData.resolvido));
            var analise = parseFloat($.trim(jsonData.analise));
            var paliativo = parseFloat($.trim(jsonData.paliativo));
            data.addRows([
              [erro, atendimentosXerros_status,resolvido,analise,paliativo]
            ]);
          });
          var options = {
            title: chart_main_title,
            hAxis: {
              title: "erros_status"
            },
            colors: ['#42a7f5', 'green', 'red', 'orange'],
            vAxis: {
              title: 'atendimentosXerros_status'
            }
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('erros_status'));
          chart.draw(data, options);
        }
      </script>
      <div id="erros_status" style="width: 1000px; height: 620px;"></div>


      <script>
        $(document).ready(function() {
          $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
          })
          $(function() {
            $("#dataRel").datepicker();
          });
          $("#dataRel").change(function() {
            var data = $(this).val();
            //var d = String(d);
            if (data != '') {
              load_sistemas(data, 'Month Wise Profit Data For');
              load_erros(data, 'Month Wise Profit Data For');
              load_medicos(data, 'Month Wise Profit Data For');
              load_medicos_status(data, 'Month Wise Profit Data For');
              load_erros_status(data, 'Month Wise Profit Data For');
            }

          })
        });
      </script>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>