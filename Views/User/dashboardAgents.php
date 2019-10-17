<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>
    


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
                    <h5 class="card-title">EN ATTENTES</h5>
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

    <div id="chartContainer" style="height: 500px; width: 100%;"></div>

</div>







    <!--<table class="table table-hover datatable" id="table-di">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="small-col">N°</th>
                <th scope="col">Contrat</th>
                <th scope="col">Sujet</th>
                <th scope="col">Collaborateur</th>
                <th scope="col">Date</th>
                <th scope="col" class="small-col">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($interventionRequests) == 0){
                    echo '<tr>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row">Aucune DI</th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>';
                } else {
                    for($i = 0; $i < count($interventionRequests); $i++){
                        echo '<tr class="row-link" onclick="window.location.href=\'index.php?page=interventionRequest/Answer&id='.$interventionRequests[$i]['id'].'\'">
                                <th scope="row">'.$interventionRequests[$i]['id'].'</th>
                                <th scope="row">'.$interventionRequests[$i][1].'</th>
                                <th scope="row">'.$interventionRequests[$i]['subject'].'</th>';

                        if($interventionRequests[$i]['collaborator_id'] == 0){
                            echo '<th scope="row">-</th>';
                        } else {
                            $collaborator = $db->prepare("SELECT name, firstname FROM users WHERE id = ?");
                            $collaborator->execute(array(
                                $interventionRequests[$i]['collaborator_id']
                            ));
                            $collaborator = $collaborator->fetchAll();

                            echo '<th scope="row">'.$collaborator[0]['name'].' '.$collaborator[0]['firstname'].'</th>';
                        }

                        echo '<th scope="row">'.$interventionRequests[$i]['deposit_date'].'</th>';

                        switch ($interventionRequests[$i][5]){
                            case 'à traiter': echo '<th scope="row"><span class="badge badge-pill badge-danger">'.$interventionRequests[$i][5].'</span></th></tr>';break;
                            case 'en cours de traitement': echo '<th scope="row"><span class="badge badge-pill badge-warning">'.$interventionRequests[$i][5].'</span></th></tr>';break;
                            case 'en attente': echo '<th scope="row"><span class="badge badge-pill badge-secondary">'.$interventionRequests[$i][5].'</span></th></tr>';break;
                            case 'close': echo '<th scope="row"><span class="badge badge-pill badge-success">'.$interventionRequests[$i][5].'</span></th></tr>';break;
                            case 'annulée': echo '<th scope="row"><span class="badge badge-pill badge-secondary">'.$interventionRequests[$i][5].'</span></th></tr>';break;
                        }
                    }
                }
            ?>
            
        </tbody>
    </table>
    
    
</div>-->







<!--<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>

    <h1><span class="oi oi-list"></span> Liste des demandes d'intervention</h1>
    <table class="table table-hover datatable" id="table-di">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N° DI</th>
                <th scope="col">Contrat</th>
                <th scope="col">Sujet</th>
                <th scope="col">Collaborateur</th>
                <th scope="col">Date</th>
                <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($di) == 0){
                    echo '<tr>
                            <th scope="row">Aucune donnée</th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>';
                } else {
                    for($i = 0; $i < count($di); $i++){
                        echo '<tr class="row-link" onclick="window.location.href=\'index.php?page=user/ViewProfil&id='.$id.'\'">
                                <th scope="row">'.$di[$i]['id'].'</th>
<!--renvoie id seulement-->     <th scope="row">'.$di[$i]['contract_type_id'].'</th>
                                <th scope="row">'.$di[$i]['subject'].'</th>
<!--renvoie id seulement-->     <th scope="row">'.$di[$i]['collaborator_id'].'</th>
                                <th scope="row">'.$di[$i]['date'].'</th>
<!--renvoie id seulement-->     <th scope="row">'.$di[$i]['status_id'].'</th>';
                       
                        echo '</tr>
                        ';
                    }
                }
            ?>
            
        </tbody>
    </table>
    <?php
        if($qualification == User::USER_TYPE_AGENT){
            echo '<div class="container-fluid blue-container">
            <h3><span class="oi oi-home"></span> Mon établissement</h3>
            <div class="form-row">
                <div class="form-group col-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="prepend-name">Raison sociale</span>
                        </div>
                        <input type="text" class="form-control form-control-lg" id="name" value="'.$institution[0]['company_name'].'" aria-describedby="prepend-name" readonly>
                    </div>
                </div>
                <div class="form-group col-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="prepend-siret">N° SIRET</span>
                        </div>
                        <input type="text" class="form-control form-control-lg" id="siret" value="'.$institution[0]['siret'].'" aria-describedby="prepend-siret" readonly>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-10">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="prepend-full-name">Nom complet</span>
                        </div>
                        <input type="text" class="form-control form-control-lg" id="full-name" value="'.$institution[0]['complete_company_name'].'" aria-describedby="prepend-full-name" readonly>
                    </div>
                </div>
            </div>
        </div>';
        }




    ?>
</div>-->