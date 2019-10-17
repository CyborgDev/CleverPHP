<div class="container-fluid">
    <div class="container" style="margin-top:50px">
        <?php echo $message; ?>
    </div>

    <h1><span class="oi oi-list-rich"></span> Liste des collaborateurs</h1>
    <table class="table table-hover datatable" id="table-coll$collaborators">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="small-col">Genre</th>
                <th scope="col">Nom Prénom</th>
                <th scope="col" class="medium-col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($collaborators) == 0){
                    echo '<tr>
                            <th scope="row">Aucune donnée</th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>';
                } else {
                    for($i = 0; $i < count($collaborators); $i++){
                        echo '<tr class="row-link" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$id.'\'">
                                <th scope="row">'.$collaborators[$i]['gender'].'</th>
                                <th scope="row">'.$collaborators[$i]['name'].' '.$collaborators[$i]['firstname'].'</th>
                                <th scope="row"></th>
                                </tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <h1><span class="oi oi-list-rich"></span> Liste des DI</h1>
    <table class="table table-hover datatable" id="table-coll$interventionRequests">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="small-col">N°</th>
                <th scope="col">Sujet</th>
                <th scope="col" class="medium-col">Réattribuer</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($interventionRequests) == 0){
                    echo '<tr>
                            <th scope="row">Aucune donnée</th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>';
                } else {
                    for($i = 0; $i < count($interventionRequests); $i++){
                        echo '<tr class="row-link" onclick="window.location.href=\'index.php?page=user/ViewProfile&id='.$id.'\'">
                                <th scope="row">'.$interventionRequests[$i]['N°'].'</th>
                                <th scope="row">'.$interventionRequests[$i]['sujet'].'</th>
                                <th scope="row">'.$interventionRequests[$i]['réattribuer'].'</th>
                                </tr>';
                    }
                }
            ?>
            
        </tbody>
    </table>
</div>
