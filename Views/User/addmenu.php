<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>

    <!--<h1><span class="oi oi-key"></span> <s>Administrateur</s> <u>DIEU</u></h1>
    <div class="row" style="height: 30px;"></div>
    <div class="container-fluid">
        <div class="form-row">
            <input type="submit" class="form-control btn btn-info col-md-3" value="Ajouter un menu" name="addmenu"><div class="col-md-1"></div>
            <input type="submit" class="form-control btn btn-info col-md-3" value="Ajouter un logiciel" name="addsoftware"><div class="col-md-1"></div>
            <input type="submit" class="form-control btn btn-info col-md-3" value="Gerer les utilisateurs" name="modifuser">
        </div>
    </div>-->
        

    <h1><span class="oi oi-pencil"></span> Ajouter un menu:</h1>
    <div class="row" style="height: 30px;"></div>
    <div class="container-fluid">
        <div class="form-group row">
            <div class="col-md-2">
                <h4>Logiciel : </h4>
            </div>
            <div class="col-md-3">
                <select class="custom-select" name="" id="">
                    <option selected>Choisir...</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2">
                <h4>Menu 1 : </h4>
            </div>
            <div class="col-md-4">
                <select class="custom-select" name="" id="">
                    <option selected>Choisir...</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Saisir...">
            </div>
            <div class="col-md-1">
            <button type="button" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </div>

</div>