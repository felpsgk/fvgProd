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
              <li><a class="dropdown-item active bg-success" href="relatorioatddia.php">Hoje</a></li>
              <li><a class="dropdown-item" href="relatorioatdmed.php">Data específica</a></li>
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
  <!-- fim Modal -->

  <div class="container">
    <div class="row shadow bg-white p-3 mb-5 rounded">
      <div class="col bg-white">
        <div class="row">
          <div class="row  mb-2">
            <h2 class="text-center">Relação (em gráficos) do dia de hoje</h2>
            <div class="col bg-white table-responsive shadow rounded">

              <script type="text/javascript">
                google.charts.load('current', {
                  packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                  var data = google.visualization.arrayToDataTable([

                    ['SISTEMA',
                      {
                        label: 'Chamados',
                        type: 'number'
                      }
                    ],

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
                    while ($dados = mysqli_fetch_array($buscar)) {
                      $sistema = $dados['sistema'];
                      $chamados = $dados['atendimentosXsistema'];

                    ?>['<?php echo $sistema ?>',
                        <?php echo $chamados ?>, ],

                    <?php
                    }
                    ?>
                  ]);

                  var options = {
                    title: 'Relação top 5 sistemas que mais solicitam atendimento',
                    chartArea: {
                      width: '70%',
                      height: '80%'
                    },
                    width: '70%',
                    height: 700,
                    colors: ['#42a7f5'],
                    hAxis: {
                      title: 'atendimentos',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Sistemas'
                    }
                  };

                  var chart = new google.visualization.ColumnChart(document.getElementById('atdXdia'));
                  chart.draw(data, options);
                }
              </script>
              <div id="atdXdia"></div>

              <script type="text/javascript">
                google.charts.load('current', {
                  packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                  var data = google.visualization.arrayToDataTable([

                    ['ERROS',
                      {
                        label: 'Chamados',
                        type: 'number'
                      }
                    ],

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
                    while ($dados = mysqli_fetch_array($buscar)) {
                      $erro = $dados['erro'];
                      $chamados = $dados['atendimentosXerro'];

                    ?>['<?php echo $erro ?>',
                        <?php echo $chamados ?>, ],

                    <?php
                    }
                    ?>
                  ]);

                  var options = {
                    title: 'Relação top 5 erros que mais solicitam atendimento',
                    chartArea: {
                      width: '70%',
                      height: '80%'
                    },
                    width: '70%',
                    height: 700,
                    colors: ['#42a7f5'],
                    hAxis: {
                      title: 'atendimentos',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Erros'
                    }
                  };

                  var chart = new google.visualization.ColumnChart(document.getElementById('errXdia'));
                  chart.draw(data, options);
                }
              </script>
              <div id="errXdia"></div>

              <script type="text/javascript">
                google.charts.load('current', {
                  packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                  var data = google.visualization.arrayToDataTable([

                    ['MÉDICOS',
                      {
                        label: 'Chamados',
                        type: 'number'
                      }
                    ],

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
                    while ($dados = mysqli_fetch_array($buscar)) {
                      $medico = $dados['medico'];
                      $chamados = $dados['atendimentosXmedico'];

                    ?>['<?php echo $medico ?>',
                        <?php echo $chamados ?>, ],

                    <?php
                    }
                    ?>
                  ]);

                  var options = {
                    title: 'Relação top 5 medicos que mais solicitam atendimento',
                    chartArea: {
                      width: '70%',
                      height: '80%'
                    },
                    width: '70%',
                    height: 700,
                    colors: ['#42a7f5'],
                    hAxis: {
                      title: 'atendimentos',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Médicos'
                    }
                  };

                  var chart = new google.visualization.BarChart(document.getElementById('medXdia'));
                  chart.draw(data, options);
                }
              </script>
              <div id="medXdia"></div>

              <script type="text/javascript">
                google.charts.load('current', {
                  packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                  var data = google.visualization.arrayToDataTable([

                    ['Médicos',
                      {
                        label: 'ATENDIMENTOS',
                        type: 'number'
                      },
                      {
                        label: 'CASOS RESOLVIDOS',
                        type: 'number',
                        fill: '#109618'
                      },
                      {
                        role: 'style'
                      },
                      {
                        label: 'CASOS EM ANALISE',
                        type: 'number'
                      },
                      {
                        role: 'style'
                      },
                      {
                        label: 'CASOS PALIATIVO',
                        type: 'number'
                      },
                      {
                        role: 'style'
                      }
                    ],

                    <?php
                    include 'conexao.php';

                    $sql = "SELECT medico, COUNT(medico) AS atendimentosXmedico, 
                    SUM(CASE WHEN status = 'resolvido' THEN 1 ELSE 0 end) AS resolvido,
                    SUM(CASE WHEN status = 'em analise' THEN 1 ELSE 0 end) AS analise,
                    SUM(CASE WHEN status = 'resolvido paliativo' THEN 1 ELSE 0 end) AS paliativo
                    FROM atendimento 
                    WHERE dia = DATE(NOW())
                    group by medico 
                    order by atendimentosXmedico
                    DESC LIMIT 5";

                    $buscar = mysqli_query($strcon, $sql);
                    while ($dados = mysqli_fetch_array($buscar)) {
                      $medico = $dados['medico'];
                      $atendimentos = $dados['atendimentosXmedico'];
                      $resolvido = $dados['resolvido'];
                      $analise = $dados['analise'];
                      $paliativo = $dados['paliativo'];

                    ?>['<?php echo $medico ?>',
                        <?php echo $atendimentos ?>,
                        <?php echo $resolvido ?>, 'GREEN',
                        <?php echo $analise ?>, 'RED',
                        <?php echo $paliativo ?>, 'ORANGE'],

                    <?php
                    }
                    ?>
                  ]);

                  var options = {
                    title: 'Relação top 5 médicos que mais solicitam e sua situação no dia',
                    chartArea: {
                      width: '45%',
                      height: '80%'
                    },
                    width: '45%',
                    height: 500,
                    colors: ['#42a7f5', 'green', 'red', 'orange'],
                    hAxis: {
                      title: 'atendimentos',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Médicos'
                    }
                  };

                  var chart = new google.visualization.BarChart(document.getElementById('atdmedicoXdia'));
                  chart.draw(data, options);
                }
              </script>
              <div id="atdmedicoXdia"></div>

              <script type="text/javascript">
                google.charts.load('current', {
                  packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                  var data = google.visualization.arrayToDataTable([

                    ['Erros',
                      {
                        label: 'ATENDIMENTOS',
                        type: 'number'
                      },
                      {
                        label: 'CASOS RESOLVIDOS',
                        type: 'number',
                        fill: '#109618'
                      },
                      {
                        role: 'style'
                      },
                      {
                        label: 'CASOS EM ANALISE',
                        type: 'number'
                      },
                      {
                        role: 'style'
                      },
                      {
                        label: 'CASOS PALIATIVO',
                        type: 'number'
                      },
                      {
                        role: 'style'
                      }
                    ],

                    <?php
                    include 'conexao.php';

                    $sql = "SELECT erro, COUNT(erro) AS atendimentosXerro, 
                    SUM(CASE WHEN status = 'resolvido' THEN 1 ELSE 0 end) AS resolvido,
                    SUM(CASE WHEN status = 'em analise' THEN 1 ELSE 0 end) AS analise,
                    SUM(CASE WHEN status = 'resolvido paliativo' THEN 1 ELSE 0 end) AS paliativo
                    FROM atendimento 
                    WHERE dia = DATE(NOW())
                    group by erro 
                    order by atendimentosXerro
                    DESC LIMIT 5";

                    $buscar = mysqli_query($strcon, $sql);
                    while ($dados = mysqli_fetch_array($buscar)) {
                      $erro = $dados['erro'];
                      $atendimentos = $dados['atendimentosXerro'];
                      $resolvido = $dados['resolvido'];
                      $analise = $dados['analise'];
                      $paliativo = $dados['paliativo'];

                    ?>['<?php echo $erro ?>',
                        <?php echo $atendimentos ?>,
                        <?php echo $resolvido ?>, 'GREEN',
                        <?php echo $analise ?>, 'RED',
                        <?php echo $paliativo ?>, 'ORANGE'],

                    <?php
                    }
                    ?>
                  ]);

                  var options = {
                    title: 'Relação top 5 erros e sua situação no dia',
                    chartArea: {
                      width: '45%',
                      height: '60%'
                    },
                    width: '45%',
                    height: 500,
                    colors: ['#42a7f5', 'green', 'red', 'orange'],
                    hAxis: {
                      title: 'atendimentos',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Erros'
                    }
                  };

                  var chart = new google.visualization.BarChart(document.getElementById('atderroXdia'));
                  chart.draw(data, options);
                }
              </script>
              <div id="atderroXdia"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>