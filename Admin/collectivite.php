<?php
include "../Autoload.php";

include "Common.php";

$selectedNav = "collectivite";

require "header.php";

?>

<title>L'éco-clic Admin - Collectivités</title>

<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<div class="col-md-12">
    <div class="info" style="height: 130px; margin-top: 30px;">
        <div id="traitVertical" class="col-3">
            <h5 id="OPSNName"></h5>
            <h2 id="titreColOPSN">Mes collectivités</h2>
        </div>

        <div id="progress2">
            <div id="nbCol" class="center">
                <p id="nbCol2" class="size29"></p>
                <p class="size13">collectivités engagées</p>
            </div>

            <div class="center">
                <p style="margin-bottom: 0;"><span id="moyenne" class="size29"></span>/100</p>
                <p class="size13">score moyen</p>
            </div>
        </div>
        
    </div>
</div>

<div class="px-3">
    <div id="gridContainer"></div>
</div>

<style>
    .dx-texteditor.dx-editor-outlined{
        margin: 0;
    }

    .px-3 {
        margin-top: 11px;
    }

    .dx-datagrid-header-panel {
        border-bottom: 1px solid #08433D !important;
        margin-bottom: 6px;
    }

</style>

<script src="./js/collectivite.js"></script>