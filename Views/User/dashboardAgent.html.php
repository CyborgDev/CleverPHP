






<?php $title = 'Tableau de bord'; ?>

<?php ob_start(); ?>
    <link rel="stylesheet" href="webroot/css/custom-style.css" />
    <link rel="stylesheet" href="webroot/css/sidenav.css" />
    <link rel="stylesheet" href="webroot/css/topnav.css" />
<?php $stylesheets = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php
    include_once 'view/menus.html.php';
?>

<?php $menus = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div class="container-fluid">
        <h1><span class="oi oi-dashboard"></span> Tableau de bord</h1>
        <div class="row" style="height: 30px;"></div>
        <div class="flexbox">
            <div class="carte">
                <div class="card text-light" style="background-color: #CB1F00;">
                    <div class="card-body">
                        <h5 class="card-title">A TRAITER</h5>
                        <div class="text-center">
                            <h1>48</h1>
                            <p class="card-text">Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carte">
                <div class="card text-light" style="background-color: #F57C23;">
                    <div class="card-body">
                        <h5 class="card-title">EN COURS</h5>
                        <div class="text-center">
                            <h1>24</h1>
                            <p class="card-text">Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carte">
                <div class="card text-light bg-warning" style="">
                    <div class="card-body">
                        <h5 class="card-title">EN ATTENTE</h5>
                        <div class="text-center">
                            <h1>15</h1>
                            <p class="card-text">Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carte">
                <div class="card text-light bg-success" style="">
                    <div class="card-body">
                        <h5 class="card-title">CLOTUREES</h5>
                        <div class="text-center">
                            <h1>29</h1>
                            <p class="card-text">Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carte">
                <div class="card text-light bg-secondary" style="">
                    <div class="card-body">
                        <h5 class="card-title">ANNULEES</h5>
                        <div class="text-center">
                            <h1>7</h1>
                            <p class="card-text">Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: 30px;"></div>
        <div class="container-fluid grey-container">
            <div class="form-row">
                <div class="text-center">
                    <h6><span class="oi oi-pin"></span> MESSAGE</h6>
                </div>
            </div>
        </div>
        <div class="row" style="height: 30px;"></div>

        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?= ConfigEC::INCLUDE_CANVASJS_SCRIPT ?>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                backgroundColor: null,
                theme: "light2",
                title:{
                    text: "Nombre de DI ouvertes / Mois"
                },
                axisY:{
                    includeZero: false
                },
                data: [{        
                    type: "line",     
                    dataPoints: [
                        { y: 450 },
                        { y: 414},
                        { y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
                        { y: 460 },
                        { y: 450 },
                        { y: 500 },
                        { y: 480 },
                        { y: 480 },
                        { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                        { y: 500 },
                        { y: 480 },
                        { y: 510 }
                    ]
                }]
            });
            chart.render();
        }
    </script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>