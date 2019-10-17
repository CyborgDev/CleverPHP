<?php $title = "Création d'un nouveau référent technique"; ?>

<?php ob_start(); ?>
    <link rel="stylesheet" href="webroot/css/custom-style.css" />
    <link rel="stylesheet" href="webroot/css/sidenav.css" />
    <link rel="stylesheet" href="webroot/css/topnav.css" />
    <?= ConfigEC::INCLUDE_SUMMERNOTE_CSS ?>
<?php $stylesheets = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php include_once 'view/menus.html.php'; ?>
<?php $menus = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div class="container-fluid"> 
        <h1><span class="oi oi-script"></span> Créer un nouveau référent technique</h1>
        <form action="index.php?page=user/AddTech" method="POST">   
            <div class="container-fluid grey-container">
                <h3>Informations utilisateur</h3>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="gender" ><strong>Genre</strong></label>
                        <select class="custom-select" name="gender" id="gender">
                            <option selected disabled>Choisir...</option>
                            <?php foreach($infos['genders'] as $gender): ?>
                                <option value="<?= $gender['gender_id'] ?>"><?= $gender['gender_wording'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                
                    <div class="form-group col-md">
                        <label for="name" ><strong>Nom</strong></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="NOM">
                    </div>

                    <div class="form-group col-md">
                        <label for="firstname" ><strong>Prénom</strong></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom">
                    </div>
                </div> 

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="phone" ><strong>Téléphone</strong></label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="N/A">
                    </div>    
                    
                    <div class="form-group col-md-2">
                        <label for="fax" ><strong>Fax</strong></label>
                        <input type="text" class="form-control" name="fax" id="fax" placeholder="N/A">
                    </div>

                    <div class="form-group col-md">
                        <label for="function"><strong>Fonction</strong></label>
                        <input type="text" class="form-control" name="function" id="function">
                    </div>

                    <div class="form-group col-md">
                        <label for="service"><strong>Service</strong></label>
                        <input type="text" class="form-control" name="service" id="service">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="institution"><strong>Etablissement</strong></label>
                        <input type="text" class="form-control" name="institution" id="institution">
                    </div>
                </div>
            </div>

            <div class="container-fluid grey-container">
                <h3>Informations du compte</h3>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="profile"><strong>Profil</strong></label>
                        <select class="custom-select" name="profile" id="profile">
                            <option selected disabled>Choisir...</option>
                            <?php foreach($infos['profiles'] as $profile): ?>
                                <option value="<?= $profile['profile_id'] ?>"><?= $profile['profile_wording'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>               
                    <div class="form-group col-md-4">
                        <label for="mail" ><strong>Adresse mail</strong></label>
                        <input type="email" class="form-control" name="mail" id="mail" placeholder="exemple@domaine.ext">
                    </div>
                </div>
            </div>
            <button type="submit" class="col-md-2 btn btn-success">Créer</button>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
    <script>
            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp[0].addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false;}
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                            /*create a DIV element for each matching element:*/
                            b = document.createElement("DIV");
                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                            b.innerHTML += arr[i].substr(val.length);
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                                /*insert the value for the autocomplete text field:*/
                                inp[0].value = this.getElementsByTagName("input")[0].value;
                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });
                /*execute a function presses a key on the keyboard:*/
                inp[0].addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                        }
                    }
                });
                function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                }
                function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                    }
                }
                function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                    }
                }
                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
                });
            }

            <?php
                $institutions = '[';
                $firstDone = FALSE;
                foreach($infos['institutions'] as $institution){
                    if(!$firstDone){
                        $institutions = $institutions.'"'.Encrypter::decrypt($institution['company_name']).'"';
                    } else {
                        $institutions = $institutions.',"'.Encrypter::decrypt($institution['company_name']).'"';
                    }
                }
                $institutions = $institutions.']';
            ?>
            var institutions = <?= $institutions ?>;

            autocomplete($('#institution'), institutions);
        </script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>