<?php include "Common.php" ?>

<head>
    <title>L'éco-clic - Catégories</title>
</head>
<!-- Header  -->
<?php require "header.php" ?>

<!-- Sidebar  -->
<?php require "menu.php" ?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php" ?>

    <!-- Main  -->

    <div id="header">

        <div class="info line col-xl-12">

            <div id="titreCat" class="col-3">
                <h2 id="col44"></h2>

                <p id="nbQuestions" style="font-size: 13px;"></p>
            </div>

            <div class="traitVertical" style="height: auto;"></div>

            <div class="col-6" style="margin-right: 150px; height: 150px; overflow: hidden;">
                <p style="height: inherit;" id="description"></p>
            </div>

            <div class="traitVertical" style="height: auto;"></div>

            <div id="progress" style="top: 40px;">

                <div style="display: inline-grid; justify-items: center;">
                    <button id="modif" onclick="modif();" hidden>
                        <i class="fa-solid fa-pen" style="color: #FFF;"></i>
                    </button>
                    <p id="textModif" hidden>Modifier</p>
                </div>

                <div hidden id="divSave" style="display: inline-grid; justify-items: center;">
                    <img src="img/check-circle.svg" alt="save" style="width: 50px;">
                    <p id="textSave" style="font-size: 12px;">Enregistrement...</p>
                </div>

                <svg class="progress-ring" width="110" height="110">
                    <circle id="cercle0" class="progress-ring__circle" stroke="white" stroke-width="4" fill="transparent" r="42" cx="60" cy="55" style="stroke-dasharray: 263.500, 326.726; stroke-dashoffset: 326.726;"></circle>
                </svg>
                <p class="progressContent" id="completed%" style="top: 30px; left: 26px;">
                    Complété à </br><span id="pourcentage" style="font-size: 18px;"></span>
                </p>
            </div>

        </div>

        <div id="questionReco">
            <button id="btnQuestion" onclick="questionReco('questionnaire')" style="border-bottom: 4px solid #08453F;outline: none;" class="btnType col-6">Questionnaire</button>
            <button id="btnReco" onclick="questionReco('reco'), affichReco()" style="outline: none;" class="btnType col-6">Recommandations</button>
        </div>
    </div>

    <div class="page-content" id="questionnaire">
    </div>

    <div class="page-content" id="reco" hidden>
        <div id="msgReco1" class="msgReco">
            <p>Nous n'avons pas de recommandation à vous proposer !</p>
        </div>

        <div id="msgReco2" class="msgReco">
            <p>Veuillez terminer et valider le questionnaire pour avoir accès aux recommandations de cette catégorie</p>
        </div>

    </div>

    <div id="descriptionModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5">
                <div class="modal-title"></div>
                <div id="modal-body" class="modal-body p-0 mt-2">
                </div>
                <div class="d-flex flex-row-reverse mt-5">
                    <button type="button" onclick="$('#descriptionModal').toggle()" class="btn btnModal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div id="definitionModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5">
            <div class="modal-title-def modal-title"></div>
                <div id="modal-bodyDef" class="modal-body p-0 mt-2">
                </div>
                <div class="d-flex flex-row-reverse mt-5">
                    <button type="button" onclick="$('#definitionModal').toggle()" class="btn btnModal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <button id="boutonValider" onclick="questionReco('reco'), affichReco(), ChangeEtatBtnVal()" class="btn btn-blueAdico mr-5 rounded-pill" style="float: right; margin-top: 10px; width: 150px;">Valider</button>
    <style>
        body {
            overflow: hidden;
        }

        .dx-texteditor-container {
            height: auto;
        }

        .btn-blueAdico {
            background: #00857A;
            height: 60px !important;
            color: #fff;
        }

        svg {
            vertical-align: bottom !important;
        }
    </style>

    <script>
        function questionReco($type) {
            if ($type == "questionnaire") {
                document.getElementById("reco").hidden = true;
                document.getElementById("btnReco").style.borderBottom = "1px solid #08453F";
                document.getElementById("btnQuestion").style.borderBottom = "4px solid #08453F";
                document.getElementById("boutonValider").hidden = false;
            } else {
                document.getElementById("questionnaire").hidden = true;
                document.getElementById("btnQuestion").style.borderBottom = "1px solid #08453F";
                document.getElementById("btnReco").style.borderBottom = "4px solid #08453F";
                document.getElementById("boutonValider").hidden = true;
            }
            document.getElementById($type).hidden = false;
        }

        $(document).ready(function() {

            $.ajax({
                url: './AjaxLoader/GetCategId.php?CategorieId=<?php echo $_GET["CategorieId"]; ?>',
                type: 'get',
                async: true,
                dataType: 'json',
                success: function(data) {
                    document.getElementById("col44").textContent = data.data[0].Nom;
                    document.getElementById("description").textContent = data.data[0].Description;
                    if (data.data[0].Description == "") {
                        $('#description').height("100px");
                    }
                    resize2();
                    if ($('#description')[0].scrollHeight > $('#description').innerHeight()) {
                        $("#description").after('<p class="align-items-center d-flex seeMore justify-content-end" onclick="openModal()">Voir plus</p>')
                        $("#description").addClass('seeMoreP')
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert('Une erreur est survenue');
                }
            });

            $questionnaire = [];
            $count2 = 0;

            $.ajax({
                url: './AjaxLoader/GetQuestionCateg.php?CategorieId=<?php echo $_GET["CategorieId"]; ?>',
                type: 'get',
                async: false,
                dataType: 'json',
                success: function(data) {

                    $questionnaire = data.data;

                    for (let $i = 0; $i < data.data.length; $i++) {

                        $.ajax({
                            url: './AjaxLoader/GetReponse.php?IdQuestion=' + data.data[$i].Id,
                            type: 'get',
                            async: false,
                            dataType: 'json',
                            success: function(data1) {
                                $questionnaire[$i].reponse = data1.data;
                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                alert('Une erreur est survenue');
                            }
                        });
                    }

                    $theme = [];

                    for (let e = 0; e < $questionnaire.length; e++) {
                        if (!$theme.includes($questionnaire[e].Theme)) {
                            $theme.push($questionnaire[e].Theme);
                        }
                    }

                    $count = 1;

                    for (let a = 0; a < $theme.length; a++) {

                        let div1 = document.createElement('div');
                        document.getElementById('questionnaire').append(div1);

                        let p = document.createElement('p');
                        p.setAttribute("class", "pQuestion");
                        p.textContent = $theme[a];
                        div1.append(p);

                        for (let o = 0; o < $questionnaire.length; o++) {
                            if ($questionnaire[o].Theme == $theme[a]) {

                                let div2 = document.createElement('div');
                                div2.setAttribute("class", "cadreQuestion");
                                document.getElementById('questionnaire').append(div2);

                                let div3 = document.createElement('div');
                                div3.setAttribute("class", "num");
                                div2.append(div3);

                                let h5 = document.createElement('h5');
                                h5.setAttribute("class", "num2");
                                h5.textContent = $count;
                                div3.append(h5);

                                if ($count == 1) {
                                    document.getElementById('nbQuestions').innerHTML = $count + " question";
                                } else {
                                    document.getElementById('nbQuestions').innerHTML = $count + " questions";
                                }


                                let div11 = document.createElement('div');
                                div11.setAttribute("style", "margin-top: 40px;width: 25px;");
                                div3.append(div11);

                                if ($questionnaire[o].Definition != null && $questionnaire[o].Definition != "") {

                                    $def = JSON.stringify($questionnaire[o].Definition);

                                    if ($questionnaire[o].Titre_definition != null && $questionnaire[o].Titre_definition != "") {
                                        $title = $questionnaire[o].Titre_definition;
                                        $(".modal-title-def").html($title)
                                    }
                                    let btn = document.createElement('button');
                                    btn.setAttribute("class", "btnInfo");
                                    btn.setAttribute("onclick", "openModalDef(" + $def + ")");
                                    // btn.setAttribute("onmouseenter", "viewInfo(infoQuestion" + o + ")");
                                    // btn.setAttribute("onmouseleave", "exitInfo(infoQuestion" + o + ")");
                                    div11.append(btn);

                                    let i = document.createElement('i');
                                    i.textContent = "i";
                                    i.setAttribute("style", "font-style: normal !important; font-weight: bold;");
                                    btn.append(i);

                                    // let div13 = document.createElement('div');
                                    // div13.setAttribute("id", "infoQuestion" + o);
                                    // div13.setAttribute("class", "divInfo")
                                    // div13.setAttribute("hidden", true);
                                    // div2.append(div13);

                                    // let p2 = document.createElement('p');
                                    // p2.textContent = $questionnaire[o].Definition;
                                    // div13.append(p2);
                                }

                                let div4 = document.createElement('div');
                                div4.setAttribute("class", "contenuReco");
                                div2.append(div4);

                                let div5 = document.createElement('div');
                                div5.setAttribute("class", "titreReco");
                                div4.append(div5);

                                let div6 = document.createElement('div');
                                div6.setAttribute("class", "textReco");
                                div4.append(div6);

                                let p1 = document.createElement('p');
                                p1.textContent = $questionnaire[o].Question;
                                div6.append(p1);


                                if ($questionnaire[o].InfoComplementaire != "" && $questionnaire[o].InfoComplementaire != null) {
                                    let p11 = document.createElement('p');
                                    p11.setAttribute("class", "infoComplementaire");
                                    p11.textContent = $questionnaire[o].InfoComplementaire;
                                    div6.append(p11);
                                }



                                let div7 = document.createElement('div');
                                div7.setAttribute("class", "reponse");
                                div4.append(div7);

                                let div9 = document.createElement('div');
                                div9.setAttribute("class", "");
                                div7.append(div9);

                                let div8 = document.createElement('div');
                                div7.append(div8);

                                for (let y = 0; y < $questionnaire[o].reponse.length; y++) {
                                    if ($questionnaire[o].reponse[y].Type == "input") {

                                        let div10 = document.createElement('div');
                                        div10.setAttribute("id", $questionnaire[o].reponse[y].Id + "div");
                                        div9.append(div10);

                                        let label = document.createElement('label')
                                        label.textContent = $questionnaire[o].reponse[y].Text;
                                        div10.append(label);

                                        let rep = document.createElement('input')
                                        rep.setAttribute("class", "inputRep");
                                        rep.setAttribute("id", $questionnaire[o].reponse[y].Id);
                                        rep.setAttribute("name", $questionnaire[o].reponse[y].IdQuestion);
                                        rep.setAttribute("placeholder", "Remplissez ici");
                                        rep.setAttribute("onchange", "saveRep('" + $questionnaire[o].reponse[y].IdQuestion + "')");
                                        rep.textContent = $questionnaire[o].reponse[y].Text;
                                        div10.append(rep);

                                    } else {

                                        if ($questionnaire[o].Multiple == 0) {

                                            let article = document.createElement('article');
                                            article.setAttribute("class", "feature");
                                            div8.append(article);

                                            let input1 = document.createElement('input');
                                            input1.setAttribute("type", "radio");
                                            input1.setAttribute("id", $questionnaire[o].reponse[y].Id);
                                            input1.setAttribute("name", $questionnaire[o].reponse[y].IdQuestion);
                                            input1.setAttribute("class", "inputRep2");
                                            input1.setAttribute("onclick", "saveRep('" + $questionnaire[o].reponse[y].IdQuestion + "')");
                                            article.append(input1);

                                            let div12 = document.createElement('div');
                                            div12.setAttribute("class", "btnText");
                                            div12.setAttribute("id", $questionnaire[o].reponse[y].Id + "text");
                                            div12.textContent = $questionnaire[o].reponse[y].Text;
                                            article.append(div12);

                                        } else {

                                            let article = document.createElement('article');
                                            article.setAttribute("class", "feature");
                                            div8.append(article);

                                            let input1 = document.createElement('input');
                                            input1.setAttribute("type", "radio");
                                            input1.setAttribute("id", $questionnaire[o].reponse[y].Id);
                                            input1.setAttribute("name", $questionnaire[o].reponse[y].IdQuestion);
                                            input1.setAttribute("class", "inputRep2");
                                            input1.setAttribute("onclick", "saveRep('" + $questionnaire[o].reponse[y].IdQuestion + "')");
                                            article.append(input1);

                                            let div12 = document.createElement('div');
                                            div12.setAttribute("class", "btnText");
                                            div12.setAttribute("id", $questionnaire[o].reponse[y].Id + "text");
                                            div12.textContent = $questionnaire[o].reponse[y].Text;
                                            article.append(div12);

                                        }

                                    }

                                }

                                $count += 1;

                            }
                        }
                    }

                    $userRep = [];
                    $questions = [];

                    for (let $e = 0; $e < data.data.length; $e++) {

                        $.ajax({
                            url: './AjaxLoader/GetReponseUser.php?IdQuestion=' + data.data[$e].Id + '&CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>',
                            type: 'get',
                            async: false,
                            dataType: 'json',
                            success: function(data2) {
                                $userRep = data2.data;
                                if ($userRep.length > 0) {
                                    $count2 += 1;
                                }

                                $questions = document.getElementsByName(data.data[$e].Id);

                                for (let $u = 0; $u < $userRep.length; $u++) {

                                    for (let $y = 0; $y < $questions.length; $y++) {

                                        if ($userRep[$u].IdReponse == $questions[$y].id) {

                                            if ($questions[$y].className == 'inputRep2') {
                                                $questions[$y].checked = true;
                                            } else if ($questions[$y].className == 'inputRep') {
                                                $questions[$y].value = $userRep[$u].InputText;
                                            }

                                        }

                                    }

                                }

                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                alert('Une erreur est survenue');
                            }
                        });

                    }

                    if ($questionnaire.length == $count2) {

                        document.getElementById("modif").hidden = false;
                        document.getElementById("textModif").hidden = false;


                        $input = [];

                        $input = document.getElementsByClassName("inputRep2");

                        for (let $a = 0; $a < $input.length; $a++) {
                            if ($input[$a].checked == false) {
                                document.getElementById($input[$a].id + "text").hidden = true;
                            } else if ($input[$a].checked == true) {
                                $input[$a].disabled = true;
                            }
                        }

                        $input2 = [];

                        $input2 = document.getElementsByClassName("inputRep");

                        for (let $x = 0; $x < $input2.length; $x++) {
                            if ($input2[$x].value == "") {
                                document.getElementById($input2[$x].id + "div").hidden = true;
                            } else if ($input2[$x].value != "") {
                                $input2[$x].disabled = true;
                            }
                        }
                    }

                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert('Une erreur est survenue');
                }
            });

            userProgression();


        });

        function affichReco() {
            $nbSup = document.getElementsByClassName('cadreReco2').length;
            for (let k = 0; k < $nbSup; k++) {
                document.getElementsByClassName('cadreReco2')[0].remove();
            }

            if ($userProgression[0] == undefined) {
                $temp = 0;
            } else {
                $temp = $userProgression[0].NbRepondu;
            }

            if ($temp != $nbQuestion) {
                document.getElementById('msgReco2').hidden = false;
                document.getElementById('msgReco1').hidden = true;
            } else {
                document.getElementById('msgReco2').hidden = true;
                $.ajax({
                    url: './AjaxLoader/GetRecommandationsCateg.php?CategorieId=<?php echo $_GET["CategorieId"]; ?>&CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>',
                    type: 'get',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        $recommandation = data.data;
                        if ($recommandation == 0) {
                            document.getElementById('msgReco1').hidden = false;
                        } else {
                            document.getElementById('msgReco1').hidden = true;

                            for (let i = 0; i < $recommandation.length; i++) {

                                let div1 = document.createElement('div');
                                div1.setAttribute("class", "cadreReco2");
                                document.getElementById('reco').append(div1);

                                let div2 = document.createElement('div');
                                div2.setAttribute("class", "num3");
                                div1.append(div2);

                                let h3 = document.createElement('h3');
                                // h3.textContent = i+1;
                                div2.append(h3);

                                let div3 = document.createElement('div');
                                div3.setAttribute("class", "contenuReco col-11");
                                div1.append(div3);

                                let div9 = document.createElement('div');
                                div9.setAttribute("class", "contenuReco col-1");
                                div1.append(div9);

                                let div4 = document.createElement('div');
                                div4.setAttribute("class", "titreReco2");
                                div3.append(div4);

                                let h3bis = document.createElement('p');
                                h3bis.setAttribute("style", "margin-bottom: 0rem;");
                                h3bis.textContent = $recommandation[i].Titre;
                                div4.append(h3bis);

                                let div5 = document.createElement('div');
                                div5.setAttribute("class", "textReco2");
                                div3.append(div5);

                                let p = document.createElement('p');
                                p.textContent = $recommandation[i].Text;
                                div5.append(p);
                            }
                        }

                    },
                    error: function(jqXhr, textStatus, errorThrown) {
                        alert('Une erreur est survenue');
                    }
                });
            }


        }

        function modif() {

            $("#boutonValider").removeClass('d-none');

            document.getElementById("modif").hidden = true;
            document.getElementById("textModif").hidden = true;
            document.getElementById("completed%").style.left = "25px";

            $input3 = [];

            $input3 = document.getElementsByClassName("inputRep2");

            for (let $a = 0; $a < $input3.length; $a++) {
                if ($input3[$a].checked == false) {
                    document.getElementById($input3[$a].id + "text").hidden = false;
                } else if ($input3[$a].checked == true) {
                    $input3[$a].disabled = false;
                }
            }

            $input4 = [];

            $input4 = document.getElementsByClassName("inputRep");

            for (let $x = 0; $x < $input4.length; $x++) {
                if ($input4[$x].value == "") {
                    document.getElementById($input4[$x].id + "div").hidden = false;
                } else if ($input4[$x].value != "") {
                    $input4[$x].disabled = false;
                }
            }

        }

        function saveRep($questionId) {

            $elements = document.getElementsByName($questionId);

            $jsonCollectiviteId2 = JSON.stringify("<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>");
            $jsonQuestionId2 = JSON.stringify($elements[0].name);
            $.ajax({
                url: './AjaxLoader/DeleteReponseUser.php',
                type: 'post',
                async: false,
                dataType: 'json',
                data: {
                    'CollectiviteId': $jsonCollectiviteId2,
                    'QuestionId': $jsonQuestionId2
                }
            });

            for (let i = 0; i < $elements.length; i++) {
                if ($elements[i].className == "inputRep2") {
                    if ($elements[i].checked == true) {

                        $jsonCollectiviteId = JSON.stringify("<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>");
                        $jsonReponseId = JSON.stringify($elements[i].id);
                        $jsonQuestionId = JSON.stringify($elements[i].name);
                        $jsonInputText = JSON.stringify("");
                        $.ajax({
                            url: './AjaxLoader/InsertReponseUser.php',
                            type: 'post',
                            async: false,
                            dataType: 'json',
                            data: {
                                'CollectiviteId': $jsonCollectiviteId,
                                'ReponseId': $jsonReponseId,
                                'QuestionId': $jsonQuestionId,
                                'InputText': $jsonInputText
                            },
                            beforeSend: function() {
                                document.getElementById('divSave').hidden = false;
                                document.getElementById('textSave').innerHTML = "Enregistrement...";
                                document.getElementById("completed%").style.left = "120px";
                            },
                            success: function(data) {

                                if (data != 1) {
                                    alert('Une erreur est survenue');
                                }
                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                alert('Une erreur est survenue');
                            },
                            complete: function() {
                                document.getElementById('textSave').innerHTML = "Enregistré";
                                document.getElementById("completed%").style.left = "85px";
                            }
                        });
                    }
                } else if ($elements[i].className == "inputRep") {
                    if ($elements[i].value != '') {

                        $jsonCollectiviteId = JSON.stringify("<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>");
                        $jsonReponseId = JSON.stringify($elements[i].id);
                        $jsonQuestionId = JSON.stringify($elements[i].name);
                        $jsonInputText = JSON.stringify($elements[i].value);
                        $.ajax({
                            url: './AjaxLoader/InsertReponseUser.php',
                            type: 'post',
                            async: false,
                            dataType: 'json',
                            data: {
                                'CollectiviteId': $jsonCollectiviteId,
                                'ReponseId': $jsonReponseId,
                                'QuestionId': $jsonQuestionId,
                                'InputText': $jsonInputText
                            },
                            beforeSend: function() {
                                document.getElementById('divSave').hidden = false;
                                document.getElementById('textSave').innerHTML = "Enregistrement...";
                                document.getElementById("completed%").style.left = "120px";
                            },
                            success: function(data) {

                                if (data != 1) {
                                    alert('Une erreur est survenue');
                                }
                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                alert('Une erreur est survenue');
                            },
                            complete: function() {
                                document.getElementById('textSave').innerHTML = "Enregistré";
                                document.getElementById("completed%").style.left = "85px";
                            }
                        });
                    }
                }
            }
            userProgression();
            userHistorique();
        }

        function userProgression() {

            $.ajax({
                url: './AjaxLoader/getUserProgressionCateg.php?CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>&categId=<?php echo $_GET["CategorieId"]; ?>',
                type: 'get',
                async: false,
                dataType: 'json',
                success: function(data) {
                    $userProgression = data.data;

                    $nbQuestion = document.getElementsByClassName("num2").length;

                    var circumference = 42 * 2 * Math.PI;
                    if ($userProgression.length == 0) {
                        var percent = (0 / $nbQuestion) * 100;
                    } else {
                        var percent = ($userProgression[0].NbRepondu / $nbQuestion) * 100;
                    }
                    document.querySelector('#pourcentage').textContent = Math.round(percent) + "%";

                    // if ($("#pourcentage").text() == "100%") {
                    //     $("#boutonValider").removeClass('d-none');
                    // } else {
                    //     $("#boutonValider").addClass('d-none');
                    // }
                    BtnValider();
                    const offset = circumference - percent / 100 * circumference;
                    document.querySelector('#cercle0').style.strokeDashoffset = offset;

                    if (document.getElementById("modif").hidden == false) {
                        document.getElementById("completed%").style.left = "83px";
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert('Une erreur est survenue');
                }
            });

        }

        function userHistorique() {

            $jsonCollectiviteId3 = JSON.stringify("<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>");

            $.ajax({
                url: './AjaxLoader/InsertHistoriqueScore.php',
                type: 'post',
                async: true,
                dataType: 'json',
                data: {
                    'CollectiviteId': $jsonCollectiviteId3
                },
                success: function(data) {

                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert('Une erreur est survenue');
                }
            });

        }

        function viewInfo($info) {
            $info.hidden = false;
        }

        function exitInfo($info2) {
            $info2.hidden = true;
        }

        function openModal() {
            var content = $("#description").text();
            var modal = $("#descriptionModal");
            $("#modal-body").html(content);
            $(".modal-title").html($("#titreCat:first-child").text());
            modal.toggle();
        }

        function openModalDef($definition) {
            
            $("#modal-bodyDef").html($definition);
            $("#definitionModal").toggle();
        }

        function BtnValider() {

            if (document.getElementById('modif').hidden == false) {
                $("#boutonValider").addClass('d-none');
            } else {
                $("#boutonValider").removeClass('d-none');
            }

        }

        function ChangeEtatBtnVal() {

            $("#boutonValider").addClass('d-none');
            document.getElementById('divSave').hidden = true;
            document.getElementById("modif").hidden = false;
            document.getElementById("textModif").hidden = false;
            document.getElementById("completed%").style.left = "83px";

            $input5 = [];

            $input5 = document.getElementsByClassName("inputRep2");

            for (let $a = 0; $a < $input5.length; $a++) {
                if ($input5[$a].checked == false) {
                    document.getElementById($input5[$a].id + "text").hidden = true;
                } else if ($input5[$a].checked == true) {
                    $input5[$a].disabled = true;
                }
            }

            $input6 = [];

            $input6 = document.getElementsByClassName("inputRep");

            for (let $x = 0; $x < $input6.length; $x++) {
                if ($input6[$x].value == "") {
                    document.getElementById($input6[$x].id + "div").hidden = true;
                } else if ($input6[$x].value != "") {
                    $input6[$x].disabled = true;
                }
            }
        }
    </script>