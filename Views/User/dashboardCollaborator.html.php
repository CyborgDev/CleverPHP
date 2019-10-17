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
    <div class="row mx-auto" style="width: 400px; height: 65px;"><h2><span class="oi oi-thumb-up"></span> Satisfaction Clients</h2></div>
    <div class="flexbox">
        <div class="decalee">
            <div class="carte">
                <div class="card note" style="background-color: rgba(202, 201, 201, 0.4); border: 3px solid #CAC9C9;">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="card-title">Note globale</h5>
                            <h1>7.9/10</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carte">
                <div class="card note" style="background-color: rgba(60, 164, 176, 0.4); border: 3px solid #3CA4B0;">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="card-title">Votre note</h5>
                            <h1>7.9/10</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col diag">
            <div id="chartContainer" style="height: 325px; width: 100%;"></div>
        </div>
    </div>
    <div class="row" style="height: 1px;"></div>
    <hr>
    <div class="row" style="height: 10px;"></div>
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

    <hr>
    <div class="row" style="height: 10px;"></div>

    <div class="flexbox2">
    
        <div class="column">
            <div id="chartContainer2" style="height: 400px; width: 100%;"></div>
        </div>
        <div class="column1">
            <div id="chartContainer3" style="height: 400px; width: 100%;"></div>
        </div>

    </div>
    
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?= ConfigEC::INCLUDE_CANVASJS_SCRIPT ?>
<script type="text/javascript">
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            backgroundColor: null,
            title: {
                text: "Satisfaction / semaine && moyenne"
            },
            axisX: {
                valueFormatString: "MMM"
            },
            axisY: {
                title: "Note/semaine",
                includeZero: false,
                prefix: "$",
                lineThickness: 0
            },
            axisY2: {
                title: "Moyenne/semaine",
                labelFormatter: addSymbols
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                color: "#CAC9C9",
                name: "Actual Sales",
                showInLegend: true,
                xValueFormatString: "MMMM YYYY",
                yValueFormatString: "$#,##0",
                dataPoints: [
                    { x: new Date(2016, 0), y: 20000 },
                    { x: new Date(2016, 1), y: 30000 },
                    { x: new Date(2016, 2), y: 25000 },
                    { x: new Date(2016, 3), y: 70000, indexLabel: "High Renewals" },
                    { x: new Date(2016, 4), y: 50000 },
                    { x: new Date(2016, 5), y: 35000 },
                    { x: new Date(2016, 6), y: 30000 },
                    { x: new Date(2016, 7), y: 43000 },
                    { x: new Date(2016, 8), y: 35000 },
                    { x: new Date(2016, 9), y:  30000},
                    { x: new Date(2016, 10), y: 40000 },
                    { x: new Date(2016, 11), y: 50000 }
                ]
            }, 
            {
                type: "line",
                color: "#3CA4B0",
                axisYType: "secondary",
                markerSize: 6,
                name: "Moyenne",
                showInLegend: true,
                dataPoints: [
                    { x: new Date(2016, 00), y: 40421200 },
                    { x: new Date(2016, 01), y: 32717100 },
                    { x: new Date(2016, 02), y: 24930400 },
                    { x: new Date(2016, 03), y: 21628500 },
                    { x: new Date(2016, 04), y: 23070900 },
                    { x: new Date(2016, 05), y: 28267100 },
                    { x: new Date(2016, 06), y: 54446800 },
                    { x: new Date(2016, 07), y: 146232200 },
                    { x: new Date(2016, 08), y: 30222100 },
                    { x: new Date(2016, 09), y: 28914900 },
                    { x: new Date(2016, 10), y: 32666300 },
                    { x: new Date(2016, 11), y: 34840600 }
                ]
            }]
        });

        function addSymbols(e){
            var suffixes = ["", "K", "M", "B"];
            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

            if(order > suffixes.length - 1)                	
                order = suffixes.length - 1;

            var suffix = suffixes[order];      
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }

        CanvasJS.addColorSet("greenShades",
                [//colorSet Array

                "#00cc00",
                "#009900",
                "#006600",
                "#00b200",
                "#007f00"                
                ]);


        var chart2 = new CanvasJS.Chart("chartContainer2", {
            colorSet: "greenShades",
            animationEnabled: true,
            backgroundColor: null,
            title:{
                text: "Vos DI clôturées / mois"
            },
            data: [{        
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "DI",
                dataPoints: [      
                    { y: 29, label: "Janvier" },
                    { y: 25,  label: "Fevrier" },
                    { y: 34,  label: "Mars" },
                    { y: 30,  label: "Avril" },
                    { y: 32,  label: "Mai" },
                    { y: 29, label: "Juin" },
                    { y: 24,  label: "Juillet" },
                    { y: 30,  label: "Août" }
                ]
            }]
        });

        var chart3 = new CanvasJS.Chart("chartContainer3", {
            animationEnabled: true,
            backgroundColor: null,
            title:{
                text: "DI / mois"
            },
            legend: {
                cursor:"pointer",
                itemclick : toggleDataSeries
            },
            toolTip: {
                shared: true,
                content: toolTipFormatter
            },
            data: [{
                type: "bar",
                showInLegend: true,
                name: "A traiter",
                color: "#CB1F00",
                dataPoints: [
                    { y: 200, label: "Janvier" },
                    { y: 264, label: "Fevrier" },
                    { y: 175, label: "Mars" },
                    { y: 210, label: "Avril" },
                    { y: 183, label: "Mai" },
                    { y: 206, label: "Juin" },
                    { y: 243, label: "Juillet" }
                ]
            },
            {
                type: "bar",
                showInLegend: true,
                name: "En cours",
                color: "#F57C23",
                dataPoints: [
                    { y: 212, label: "Janvier" },
                    { y: 186, label: "Fevrier" },
                    { y: 272, label: "Mars" },
                    { y: 229, label: "Avril" },
                    { y: 270, label: "Mai" },
                    { y: 165, label: "Juin" },
                    { y: 200, label: "Juillet" }
                ]
            },
            {
                type: "bar",
                showInLegend: true,
                name: "En attentes",
                color: "#FFCE28",
                dataPoints: [
                    { y: 279, label: "Janvier" },
                    { y: 165, label: "Fevrier" },
                    { y: 196, label: "Mars" },
                    { y: 212, label: "Avril" },
                    { y: 170, label: "Mai" },
                    { y: 186, label: "Juin" },
                    { y: 242, label: "Juillet" }
                ]
            },
            {
                type: "bar",
                showInLegend: true,
                name: "Cloturées",
                color: "green",
                dataPoints: [
                    { y: 100, label: "Janvier" },
                    { y: 150, label: "Fevrier" },
                    { y: 112, label: "Mars" },
                    { y: 124, label: "Avril" },
                    { y: 138, label: "Mai" },
                    { y: 106, label: "Juin" },
                    { y: 143, label: "Juillet" }
                ]
            },
            {
                type: "bar",
                showInLegend: true,
                name: "Annulées",
                color: "grey",
                dataPoints: [
                    { y: 12, label: "Janvier" },
                    { y: 86, label: "Fevrier" },
                    { y: 72, label: "Mars" },
                    { y: 99, label: "Avril" },
                    { y: 70, label: "Mai" },
                    { y: 65, label: "Juin" },
                    { y: 96, label: "Juillet" }
                ]
            }]
        });

        function toolTipFormatter(e) {
            var str = "";
            var total = 0 ;
            var str3;
            var str2 ;
            for (var i = 0; i < e.entries.length; i++){
                var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
                total = e.entries[i].dataPoint.y + total;
                str = str.concat(str1);
            }
            str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
            str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
            return (str2.concat(str)).concat(str3);
        }

        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

        chart.render();
        chart2.render();
        chart3.render();
    }
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>