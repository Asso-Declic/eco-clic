<!-- Header  -->
<?= $view->render('partials/header.php') ?>
<head>
    <title>L'éco-clic - Profil</title>
</head>
<!-- Sidebar  -->
<?= $view->render('partials/menu.php') ?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?= $view->render('partials/recherche.php') ?>

    <!-- <div class="col-12 fil-ariane py-2 px-4">
        <img src="./img/parametres.svg" alt="">
        <a class="fil-ariane" href="./profil.php">Profil</a>
    </div> -->

    <div id="header">
        <div class="info line col-xl-12">
            <div id="titreCat" class="col-3">
                <h2 id="col">
                    Gestion du profil
                </h2>
            </div>
            <div class="traitVertical" style="height: auto;"></div>
            <!-- <div class="col-6" style="margin-right: 150px; height: 150px; overflow: hidden;"> -->
            <!-- </div> -->
        </div>
        <button id="enregistrer"><i class="fas fa-save"></i>Enregistrer</button>
        <div class="traitHorizontal"></div>
    </div>

    <div class="profil-body" style="overflow: auto;">
        <div class="titreBloc">
            <div class="cercle"><i class="fas fa-user-edit"></i></div>
            <span class="titre">Mon profil</span>
        </div>

        <div class="monProfil">
            <form action="<?= $urlGenerator->generate('utilisateur_update_profil') ?>?type=infos" id="formulaire">
                <div id="form_profil" class="formBlock"></div>
            </form>
        </div>

        <div class="titreBloc">
            <div class="cercle"><i class="fas fa-lock" style="left: 12px;"></i></div>
            <span class="titre">Mon mot de passe</span>
        </div>

        <div class="motDePasse">
            <form action="<?= $urlGenerator->generate('utilisateur_update_profil') ?>?type=mdp" id="formulaireMdp">
                <div id="formMdp" class="formBlock" style="padding-top: 10px;"></div>
            </form>
        </div>
    </div>
    <style>
        .dx-editor-outlined {
            border-radius: 40px !important;
            height: 80px !important;
        }

        .line {
            height: 156px;
            margin: 4px 24px 0px 24px;
            border-radius: 5px;
        }

        .traitHorizontal {
            border-bottom: solid 1px #08433D;
            margin-inline: 24px;
            margin-top: 79px;
        }

        #enregistrer {
            float: right;
            color: white;
            font-size: 16px;
            margin: 12px 24px 12px 0px;
            padding-inline: 24px;
            padding-block: 12px;
            border-radius: 10px;
            background-color: #00857A;
            border: solid 2px #00857A;
        }

        .fa-save {
            margin-right: 24px;
        }

        #col {
            font-size: 36px;
            height: 100%;
            width: 45%;
            padding: 12px;
        }

        .titreBloc {
            margin-left: 24px;
            margin-top: 24px;
            display: flex;
            align-items: center;
        }

        .cercle {
            background-color: #08453F;
            height: 38px;
            width: 38px;
            color: white;
            display: inline-block;
            border-radius: 40px;
        }

        .cercle i {
            position: relative;
            top: 7px;
            left: 11px;
        }

        .cercle i {
            position: relative;
            top: 7px;
            left: 11px;
        }

        .titre {
            margin-left: 12px;
            color: #08453F;
            font-size: 28px;
            font-weight: bold;
        }

        .formBlock {
            background-color: white;
            border-left: 8px solid #00857A;
            margin-inline: 24px;
            margin-top: 24px;
            padding-inline: 24px;
        }
    </style>
    <script src="./js/profil.js"></script>