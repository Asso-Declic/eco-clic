        <nav id="sidebar">

            <div id="fermer-telephone" class="bouton">
                <p>x</p>
                <div>Fermer</div>
            </div>

            <div class="sidebar-header">
                <a href="accueil.php">
                    <img id="logoEcoclic" src="img/logoEcoclic.png" style="width: -webkit-fill-available;">
                    <img id="faviconEcoclic" src="img/favicon.png" style="display:none; width: -webkit-fill-available;">
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>

                    <div id="scrollNav" style="overflow-x: hidden; overflow-y: auto;">
                        <a id="accueil" href="accueil.php" tabindex="2">
                            <img class="iconMenu" src="img/Icongraphcool.svg">
                            <span>Tableau de bord</span>
                        </a>

                        <a href="#" tabindex="1" id="categorie">
                            <img class="iconMenu" src="img/bubble.svg">
                            <span>
                                Catégories
                                <img src="img/Flechetype2.svg" alt="Catégories" style="margin-left: 20px">
                            </span>
                        </a>

                        <div id="sousMenu" style="display: none;"></div>
                        
                        <a hidden id="reco2" href="recommandations.php" tabindex="2">
                            <img class="iconMenu" src="img/survey.png">
                            <span>Plan d’action</span>
                        </a>

                        <!-- <a href="statistiques.php" tabindex="2">
                            <img class="iconMenu" src="img/statistiques.svg">
                            <span>Statistiques</span>
                        </a> -->

                        <?php
                        if(SessionHelper::GetCurrentUser()->Admin == 1){
                        ?>
                            <a id="gestUser" href="parametres.php" tabindex="2" >
                                <img class="iconMenu" src="img/Icon feather-users.svg">
                                <span>Gestion des utilisateurs</span>
                            </a>
                        <?php
                        }
                        ?>

                        <!-- <a href="historique.php" tabindex="2" style="border-top: #00857A 1px solid;">
                            <i class="fas fa-clock hidden" id="footer0" style="color: #08453F; font-size: 20px;"></i>
                            <span class="Menufooter">Historique</span>
                        </a>

                        <a href="accessibilite.php" tabindex="2">
                            <i class="fas fa-info-circle hidden" id="footer1" style="color: #08453F; font-size: 20px;"></i>
                            <span class="Menufooter">Accessibilité et aides</span>
                        </a>
                        
                        <a href="mentions-legales.php" tabindex="2">
                            <i class="fas fa-balance-scale hidden" id="footer2" style="color: #08453F; font-size: 20px;"></i>
                            <span class="Menufooter">Mentions légales</span>
                        </a> -->
                    
                        <a href="#" tabindex="1" id="retrecir" class="bouton" style="padding: 5px;">
                            <h3 id="retrecirBoutonG">
                                <img src="img/Icon awesome-chevron-circle-left.svg" alt="Tableau de bord" style="margin-left: 30px;">
                                Réduire le menu
                            </h3>
                            <img src="img/menuBurger.svg" id="retrecirBoutonP" alt="Menu" style="margin-left: 5px;">
                        </a>

                    </div>

                </li>
            </ul>
        </nav>

<script>

    $(document).ready(function () {

        $userProgression = [];
        $.ajax({
            url: './AjaxLoader/getUserProgression.php?CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>' ,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function(data) {
                $userProgression = data.data;
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });

        $.ajax({
            url: './AjaxLoader/getCategInfo.php',
            type: 'get',
            async: false,
            dataType: 'json',
            success: function(data) {
                $Nbquestion = 0;
                $Nbrep = 0;
                for (let a = 0; a < data['data'].length; a++) {
                    $Nbquestion += data['data'][a].nbQuestion;
                    if ($userProgression[a] != undefined) {
                        $Nbrep += $userProgression[a].NbRepondu;
                    }
                    else {
                        $Nbrep += 0;
                    }
                }

                if ($Nbrep < $Nbquestion) {
                    document.getElementById('reco2').hidden = true;
                } else {
                    document.getElementById('reco2').hidden = false;
                }

            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });

        $.ajax({
            url: './AjaxLoader/getCateg.php',
            type: 'get',
            async: false,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data['data'].length; i++) {

                    let a = document.createElement('a');
                    a.setAttribute("href", "categories.php?CategorieId="+data['data'][i].Id);
                    a.setAttribute("tabindex", "2");
                    document.getElementById('sousMenu').append(a);

                    let p = document.createElement('p');
                    p.setAttribute("class", "space");
                    p.textContent = data['data'][i].Nom;
                    a.append(p);

                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });

        function Timeout() {
            setTimeout(sidebarScroll, 300);
        }

        $(window).on('resize', sidebarScroll);

        function sidebarScroll() {
            if (document.getElementById("sidebar").className == 'active' == true) {
                var newHeight = $(window).height() - 175 + 90;
                $('#scrollNav').height(newHeight);
            } else {
                var newHeight = $(window).height() - 175;
                $('#scrollNav').height(newHeight);
            }
        }

        $("#retrecir").on('click', Timeout);
        $("#categorie").on('click', Timeout);

        sidebarScroll();
        
        $('.bouton').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#footer0').toggleClass('hidden');
            $('#footer1').toggleClass('hidden');
            $('#footer2').toggleClass('hidden');
            $('#sousMenu').toggleClass('hidden');
        });

        $('#categorie').on('click', function () {

            if ($("#sousMenu")[0].style.display == "block") {
                $('#sousMenu').css("display", "none");
                updatePreferences();
            } else {
                $('#sousMenu').css("display", "block");
                updatePreferences();
            }

            if (document.getElementById("sidebar").className == 'active' && window.innerWidth > 970) {
                $('#sidebar').toggleClass('active');
                $('#sousMenu').toggleClass('hidden');
                $('#sousMenu').css("display", "block");
                $i = 1;
                $('#footer0').toggleClass('hidden');
                $('#footer1').toggleClass('hidden');
                $('#footer2').toggleClass('hidden');
            }

            if (window.innerWidth < 970) {
                $('#sousMenu').toggleClass('hidden');
            }
        });
        
        getPreferences();

        menuActive();

    });

    function updatePreferences() {
        $.ajax({
            url: './AjaxLoader/UpdatePreferenceCategories.php',
            type: 'GET',
            async: true,
            data: {
                display: $('#sousMenu').css("display")
            },
            dataType: 'JSON',
            success: function(reponse) {
                
            },
            error: function(resultat, statut, erreur) {
                console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
            }
        });
    }

    function getPreferences() {
        $.ajax({
            url: './AjaxLoader/GetPreferenceCategories.php',
            type: 'GET',
            async: false,
            dataType: 'html',
            success: function(reponse) {
                $('#sousMenu').css("display", reponse)
            },
            error: function(resultat, statut, erreur) {
                console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
            }
        });
    }

    function menuActive() {
        for (let g = 0; g < $("#scrollNav")[0].children.length; g++) {
            if ($("#scrollNav")[0].children[g].href == window.location.href.split("#")[0]) {
                $("#scrollNav")[0].children[g].classList = "menuActive";
            }
        }

        for (let t = 0; t < $("#sousMenu")[0].children.length; t++) {
            if ($("#sousMenu")[0].children[t].href == window.location.href.split("#")[0]) {
                $("#sousMenu")[0].style.display = "block";
                $("#sousMenu")[0].children[t].classList = "menuActive";
            }
        }
    }
    
</script>