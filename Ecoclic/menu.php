        <nav id="sidebar">

            <div id="fermer-telephone" class="bouton">
                <p>x</p>
                <div>Fermer</div>
            </div>

            <div class="sidebar-header">
                <a href="accueil.php">
                    <img id="logoEcoclic" src="img/logoEcoclic.png" style="width: -webkit-fill-available;">
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#" tabindex="1" id="retrecir" class="bouton">
                        <h3 id="retrecirBoutonG">
                            Rétrécir
                            <img src="img/Flechetype.svg" alt="Tableau de bord" style="margin-left: 20px">
                        </h3>
                        <img src="img/menuBurger.svg" id="retrecirBoutonP" alt="Menu">
                    </a>

                    <div id="scrollNav" style="overflow-x: hidden; overflow-y: auto;">
                        <a href="accueil.php" tabindex="2">
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
                        
                        <a href="recommandations.php" tabindex="2">
                            <img class="iconMenu" src="img/recommandations.svg">
                            <span>Recommandations</span>
                        </a>

                        <a href="statistiques.php" tabindex="2">
                            <img class="iconMenu" src="img/statistiques.svg">
                            <span>Statistiques</span>
                        </a>

                        <?php
                        if(SessionHelper::GetCurrentUser()->Admin == 1 && SessionHelper::GetCurrentUser()->SuperAdmin == 0){
                        ?>
                            <a href="parametres.php" tabindex="2" >
                                <img class="iconMenu" src="img/parametres.svg">
                                <span>Paramètres</span>
                            </a>
                        <?php
                        } elseif (SessionHelper::GetCurrentUser()->SuperAdmin == 1) {
                        ?>
                            <a href="parametresAdmin.php" tabindex="2" >
                                <img class="iconMenu" src="img/parametres.svg">
                                <span>Paramètres</span>
                            </a>
                        <?php
                        }
                        ?>

                        <a href="historique.php" tabindex="2" style="border-top: #00857A 1px solid;">
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
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

<script>

    

    

    $(document).ready(function () {
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

        $i = 0;
        $('#categorie').on('click', function () {
            if ($i == 1) {
                $i = 0;
                $('#sousMenu').css("display", "none");
            } else {
                $i = 1;
                $('#sousMenu').css("display", "block");
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

    });

    
</script>