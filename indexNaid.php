<?php
session_start();
include 'verificaLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NAID - Um projeto Felps</title>
    <!-- Favicon-->
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">NAID</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#consumo">Calcular consumo</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#regra3">Regra
                            de 3</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#ganhosUber">Ganhos na Uber</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">NAID - Um projeto Felps</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Programador - Estudante - Criativo</p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="consumo">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">CALCULAR CONSUMO</h2>
            <p class="text-center fw-bolder text-uppercase text-break">Use esta seção para saber quanto de gasolina
                abastecer para uma determinada viagem</p>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>

            </div>

            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Quantos KM seu carro faz por litro?</label>
                        <input type="number" class="form-control" id="kmLitro" min="0" value="0" step=".05">
                    </div>
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Qual valor da gasolina?</label>
                        <input type="number" class="form-control" id="gasolina" min="0" value="0" step=".10">
                    </div>
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Qual KM percorrido?</label>
                        <input type="number" class="form-control" id="distancia" min="0" value="0" step="10">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="calculate" class="btn btn-primary btn-lg mt-2">Calcular</button>
                        <p id="result" class="mt-1 text-center fw-bolder text-uppercase"></p>
                    </div>
                    <script>
                        var calculate = document.getElementById("calculate");
                        var result = document.getElementById("result");

                        function calculatePercentage() {

                            var kmLitro = parseFloat(document.getElementById("kmLitro").value);
                            var gasolina = parseFloat(document.getElementById("gasolina").value);
                            var distancia = parseFloat(document.getElementById("distancia").value);
                            var litrosGasto = (distancia * 1) / kmLitro;
                            var valorAbastecer = litrosGasto * gasolina;

                            result.innerHTML = "Abasteça cerca de R$" + valorAbastecer.toFixed(2) + ".";
                        }

                        calculate.addEventListener('click', calculatePercentage);
                    </script>

                </div>
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="regra3">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase mb-0">Regra de 3</h2>
            <p class="text-center fw-bolder text-uppercase text-break">Use esta seção para calcular uma regra de 3
                simples</p>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 mb-5">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text">Valor A</span>
                            <input type="number" required id="a" class="form-control me-1">
                            <span class="input-group-text">Valor B</span>
                            <input type="number" required id="b" class="form-control">
                        </div>
                    </div>
                    <div class="col mt-1">
                        <div class="input-group">
                            <span class="input-group-text">Valor C</span>
                            <input type="number" required id="c" class="form-control me-1" onchange="calculater3()">
                            <span class="input-group-text">Valor X</span>
                            <input type="text" id="resultador3" class="form-control">
                        </div>
                    </div>
                    <script>
                        function calculater3() {
                            var result = document.getElementById("resultador3");
                            var a = parseFloat(document.getElementById("a").value);
                            var b = parseFloat(document.getElementById("b").value);
                            var c = parseFloat(document.getElementById("c").value);
                            var resultado = (c * b) / a;
                            if (document.getElementById("a").value == "") {
                                result.value = "preencha o valor A";
                            } else if (document.getElementById("b").value == "") {
                                result.value = "preencha o valor B";
                            } else if (document.getElementById("c").value == "") {
                                result.value = "preencha o valor C";
                            } else {
                                //alert("resultado " + a + " " + b + " " + c + " " + resultado);
                                result.value = resultado;
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section portfolio" id="ganhosUber">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Ganhos na uber</h2>
            <p class="text-center fw-bolder text-uppercase text-break">Use esta seção para saber qual seu lucro na uber
            </p>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>

            </div>

            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Quantos KM seu carro faz por litro? (decida
                            entre álcool e gasolina</label>
                        <input type="number" class="form-control" id="kmLitroGan" min="0" value="0" step=".05">
                    </div>
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Qual valor do combustível escolhido?</label>
                        <input type="number" class="form-control" id="gasolinaGan" min="0" value="0" step=".10">
                    </div>
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label">Qual KM percorrido?</label>
                        <input type="number" class="form-control" id="distanciaGan" min="0" value="0" step="10">
                    </div>
                    <div class="portfolio-item mx-auto" data-bs-target="#portfolioModal1">
                        <label for="exampleInputEmail1" class="form-label mt-2">Qual valor ganho nos App's?</label>
                        <br>
                        <small for="exampleInputEmail1" class="form-label">- faça a soma dos ganhos de todos os apps
                            caso trabalhe em mais de um.</small>
                        <br>
                        <small for="exampleInputEmail1" class="form-label">- este calculo leva em conta uma porcentagem
                            para poupança para futuras manutenções.</small>
                        <input type="number" class="form-control" id="ganhosGan" min="0" value="0" step="10">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="calcularGan" class="btn btn-primary btn-lg mt-2">Calcular</button>
                        <p id="resultGanhos" class="mt-1 text-center fw-bolder text-uppercase"></p>
                    </div>
                    <script>
                        var calcularGan = document.getElementById("calcularGan");
                        var resultGanhos = document.getElementById("resultGanhos");

                        function calculateGanhos() {

                            var ganhosGan = parseFloat(document.getElementById("ganhosGan").value);
                            var kmLitroGan = parseFloat(document.getElementById("kmLitroGan").value);
                            var gasolinaGan = parseFloat(document.getElementById("gasolinaGan").value);
                            var distanciaGan = parseFloat(document.getElementById("distanciaGan").value);
                            var litrosGastoGan = (distanciaGan * 1) / kmLitroGan;
                            var valorAbastecerGan = litrosGastoGan * gasolinaGan;
                            var lucroApps = ganhosGan - valorAbastecerGan;
                            var revisao = lucroApps * 0.10;
                            var lucrofinal = lucroApps - revisao;

                            resultGanhos.innerHTML = "Você deverá separar R$" + valorAbastecerGan.toFixed(2) + " para abastecer.<br>Levamos em conta o valor de R$"+revisao.toFixed(2)+" a ser guardado para futuras revisões.<br>Considere um lucro líquido de R$"+lucrofinal.toFixed(2);
                        }

                        calcularGan.addEventListener('click', calculateGanhos);
                    </script>

                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Location</h4>
                    <p class="lead mb-0">
                        2215 John Daniel Drive
                        <br />
                        Clark, MO 65243
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Around the Web</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">About Freelancer</h4>
                    <p class="lead mb-0">
                        Freelance is a free to use, MIT licensed Bootstrap theme created by
                        <a href="http://startbootstrap.com">Start Bootstrap</a>
                        .
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Your Website 2022</small></div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>