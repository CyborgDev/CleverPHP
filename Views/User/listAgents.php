<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>

    <h1><span class="oi oi-list-rich"></span> Liste des agents</h1>
    <div class="container-fluid grey-container">
        <div class="row mb-2">
            &nbsp;
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="oi oi-menu"></span>
            </button>
            <h3>&nbsp;Recherche Avancée</h3>
        </div>
            <div class="collapse" id="collapseExample">
                <div class="form-group row">
                    <div class="col-md-2">   
                        <label class="col-form-label" for="canopee-id" ><strong>N° Canopée</strong></label>
                        <input type="text" class="form-control form-control" name="canopee-id" id="canopee-id" aria-describedby="prepend-canopee-id">
                    </div>

                    <div class="col-md-5">
                        <label class=" col-form-label" for="name" ><strong>Nom</strong></label>
                        <input type="text" class="form-control" id="name" aria-describedby="prepend-name" >
                    </div>
                
                    <div class="col-md-3">
                        <label class="col-form-label" for="firstname" ><strong>Prénom</strong></label>
                        <input type="text" class="form-control" id="firstname" aria-describedby="prepend-firstname" >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-5">   
                        <label class="col-form-label" for="mail" ><strong>Adresse mail</strong></label>
                        <input type="text" class="form-control form-control" name="mail" id="mail" aria-describedby="prepend-mail">
                    </div>

                    <div class="col-md-6">
                        <label class=" col-form-label" for="institution" ><strong>Etablissement</strong></label>
                        <input type="text" class="form-control" name="institution" id="institution" aria-describedby="prepend-institution" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <input type="checkbox" class="form-control form-control" name="" id="" placeholder="" aria-label="" aria-describedby="">
                                <div class="input-group-prepend">
                                    <h6>Inactif inclus</h6>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md">
                        <input type="submit" class="form-control btn btn-info" value="Rechercher"/>
                    </div>
                </div>
            </div>    
    </div><br />                      
    <table class="table table-hover datatable" id="table-agents">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Adresse email</th>
                <th scope="col">Etablissement</th>
                <th scope="col">Inactif</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($agents) == 0){
                    echo '<tr>
                            <th scope="row">Aucune donnée</th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>';
                } else {
                    for($i = 0; $i < count($agents); $i++){
                        echo '<tr class="row-link">
                                <th scope="row">'.$agents[$i]['canopee_id'].'</th>
                                <th scope="row" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$agents[$i]['id'].'\'">'.$agents[$i]['name'].'</th>
                                <th scope="row" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$agents[$i]['id'].'\'">'.$agents[$i]['firstname'].'</th>
                                <th scope="row" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$agents[$i]['id'].'\'">'.$agents[$i]['mail'].'</th>
                                <th scope="row" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$agents[$i]['id'].'\'">'.$agents[$i]['company_name'].'</th>';
                        if($agents[$i]['inactive'] == 0){
                            echo '<th scope="row" class="text-center"><span class="badge badge-success">Non</span></th>';
                        } else {
                            echo '<th scope="row" class="text-center"><span class="badge badge-danger">Oui</span></th>';
                        }
                        echo '</tr>';
                    }
                }
            ?>
            
        </tbody>
    </table>
<div>
