<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>

    <h1><span class="oi oi-pencil"></span> Gerer les utilisateurs:</h1>
    <div class="row" style="height: 30px;"></div>
    <div class="container-fluid grey-container">
        <div class="row mb-2">
            &nbsp;
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="oi oi-menu"></span>
            </button>
            <h3>&nbsp;Rechercher</h3>
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
    </div>
    <div class="container-fluid grey-container">
        <div class="row mb-2">
            &nbsp;
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                <span class="oi oi-menu"></span>
            </button>
            <h3>&nbsp;Selectionner</h3>
        </div>
        <div class="collapse" id="collapseExample2">
            <table class="table table-hover datatable" id="exampleTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Première colonne</th>
                        <th scope="col">Deuxième colonne</th>
                        <th scope="col">Troisième colonne</th>
                        <th scope="col">Quatrième colonne</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                    <tr class="row-link" onclick="window.location.href='#'">
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                        <th scope="row">Aucune donnée</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid grey-container">
        <div class="row mb-2">
            &nbsp;
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                <span class="oi oi-menu"></span>
            </button>
            <h3>&nbsp;Modifier</h3>
        </div>
        <div class="collapse" id="collapseExample3">
            <h4><span class="oi oi-person"></span> Nom & Prénom</h4>
            <hr>
            <div class="form-group row">
                <div class="col-md-3">
                    <label class="col-form-label" for="" ><strong>Profil</strong></label>
                    <select class="custom-select" name="" id="" aria-describedby="">
                        <option selected>Choisir...</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                        <label class="col-form-label" for="" ><strong>Actif</strong></label>
                    </div>
                </div>
                <div class="col-md-2"> 
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="col-form-label" for="" ><strong>Inactif</strong></label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="" ><strong>RESET</strong></label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10"></div>
                <div class="col-md">
                    <input type="submit" class="form-control btn btn-success" value="Valider"/>
                </div>
            </div>
        </div>
    </div>
</div>