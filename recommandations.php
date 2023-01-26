<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>



<!-- Header  -->
<?php require "header.php"?>
<head>
    <title>L'éco-clic - Pland'action</title>
</head>
<!-- Sidebar  -->
<?php require "menu.php"?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php"?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- <div class="col-12 fil-ariane py-2 px-4">
        <img src="img/recommandations.svg" alt="">
        <a class="fil-ariane" href="./recommandations.php">Recommandations</a>            
    </div> -->

    <div class="col-md-12">
        <div class="info" style="height: 130px; margin-top: 30px;">
            <div id="traitVertical" class="col-3">
                <h2>Plan d'action</h2>
            </div>

            <div id="progress">
                <svg class="progress-ring" width="105" height="105">
                    <circle id="cercle0" class="progress-ring__circle" stroke="white" stroke-width="4" fill="transparent" r="45" cx="50" cy="55" style="stroke-dasharray: 326.726, 326.726; stroke-dashoffset: 326.726;"></circle> 
                </svg>

                <!-- <p class="progressContent" id="indice" style="top: 32px; left: 26px; color: #08453F;" hidden="true">
                    Score </br><span id="score" style="font-size: 18px; color: #000;"></span>
                </p> -->
                <p class="progressContent" id="indice" style="top: 14px; line-height: 1; left: 15px; color: #fafafa; font-size: 26px;background-image: linear-gradient(#08433D 0 0); background-position: bottom center; background-size: 79% 1.5px; background-repeat: no-repeat;" hidden="true">
                    <span id="A" class="scoreLetter" style="color: #038141;">A</span><span id="B" class="scoreLetter" style="color: #627A39;">B</span><span id="C" class="scoreLetter" style="color: #966A09;">C</span><span id="D" class="scoreLetter" style="color: #B65713;">D</span><span id="E" class="scoreLetter" style="color: #A80000;">E</span>
                </p>
            </div>
            
        </div>
    </div>

    <div style="margin: 15px; padding: 10px 0px; border-bottom: 1px solid #08433D;">
        <div class="dropdown">
            <button class="btn filtres dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <i class="fas fa-filter"></i><span class="px-4">Catégorie</span>
            </button>
            <ul id="selectCateg" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div id="treeview"></div>
            </ul>
        </div>
    </div>

    <div id="recommandations" class="page-content">
    </div>

    <div id="divErreur" style="text-align: center; margin: 100px;">
        <p>Veuillez compléter toutes les catégories!</p>
    </div>

    <style>
        .btn:hover {
            color: #000 !important;
        }

        .scoreRectangle {
            top: 27px !important;
        }
    </style>

<script>
    
    $(function() {
        $(".filtres").width($(".dropdownFiltres").width());

        $(".bouton-filtres-the").on('click', function() {
            $(".filtres-the").toggleClass('d-none');
        });

        $(".bouton-filtres-geo").on('click', function() {
            $(".filtres-geo").toggleClass('d-none');
        });

        ///////////////////////////////////// Devextreme treeview /////////////////////////////////////

        var treeViewCount = 0;
        var treeView = $("#treeview").dxTreeView({
            dataSource: "./AjaxLoader/GetRecomandationFiltres.php",
            dataStructure: "plain",
            width: 340,
            height: 320,
            showCheckBoxesMode: "selectAll",
            keyExpr: "Id",
            parentIdExpr: "IdCategorie",
            selectionMode: "multiple",
            displayExpr: "Nom",
            selectAllText: 'Toutes les catégories',
            selectByClick: true,
            onSelectionChanged: function(e) {
                $tabNotSelect = [];
                const selectedNodes2 = e.component.getSelectedNodes();
                const selectedNodes = e.component.getNodes();
                for (let k = 0; k < selectedNodes.length; k++) {
                    if (selectedNodes[k].selected == false) {
                        $tabNotSelect.push(selectedNodes[k].key);
                    }
                    
                    for (let g = 0; g < selectedNodes[k].children.length; g++) {
                        if (selectedNodes[k].children[g].selected == false) {
                            $tabNotSelect.push(selectedNodes[k].children[g].key);
                        }
                    }
                    
                }

                for (let p = 0; p < $tabNotSelect.length; p++) {
                    if(document.getElementById("parent"+$tabNotSelect[p]) != null) {
                        document.getElementById("parent"+$tabNotSelect[p]).hidden = true;
                    }
                    for (let g = 0; g < document.getElementsByClassName($tabNotSelect[p]).length; g++) {
                        document.getElementsByClassName($tabNotSelect[p])[g].hidden = true;
                    }
                }

                for (let s = 0; s < selectedNodes2.length; s++) {
                    if(document.getElementById("parent"+selectedNodes2[s].key) != null) {
                        document.getElementById("parent"+selectedNodes2[s].key).hidden = false;
                    }
                    for (let f = 0; f < document.getElementsByClassName(selectedNodes2[s].key).length; f++) {
                        document.getElementsByClassName(selectedNodes2[s].key)[f].hidden = false;
                    }
                    
                    
                }
                
                
            },
            onContentReady: function(e) {
                var id = getUrlParam("Id", "")
                if (id != "") {
                    e.component.selectItem(id);
                } else {
                    if (treeViewCount != 1) {
                        treeViewCount = 1;
                        e.component.selectAll();
                    }
                }
                $('.dx-treeview-select-all-item').removeClass('dx-widget')
            },
        }).dxTreeView('instance');
    });

    function dropdown(e) {
        var str = e.attr('id');
        str = str.substring(8, );
        $("#description_" + str).slideToggle()
    }
    
    $.ajax({
        url: './AjaxLoader/getUserScore.php?CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>' ,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            // $('#progress')[0].style.backgroundColor = "#E9FBF9";
            // $('#progress')[0].style.borderRadius = "90px";
            // $('#progress')[0].style.marginRight = "5px";
            // document.querySelector('#score').textContent = Math.floor(data['data'][0].score * 100 / data['data'][0].nb)+"/100";
            // $('#indice').removeAttr('hidden');

            $Nbrep = data['data'][0].nb;

            $('#progress')[0].style.backgroundColor = "#fff";
            document.getElementById("progress").classList.add("scoreRectangle");

            $score = Math.floor(data['data'][0].score * 100 / data['data'][0].nb);

            if ($score >= 80) {
                document.getElementById("A").classList.add("scoreZoom");
            } else if($score < 80  && $score >= 60) {
                document.getElementById("B").classList.add("scoreZoom");
            } else if($score < 60 && $score >= 40) {
                document.getElementById("C").classList.add("scoreZoom");
            } else if($score < 40 && $score >= 20) {
                document.getElementById("D").classList.add("scoreZoom");
            } else if($score < 20) {
                document.getElementById("E").classList.add("scoreZoom");
            }

            $('#indice').removeAttr('hidden');
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
                for (let a = 0; a < data['data'].length; a++) {
                    $Nbquestion += data['data'][a].nbQuestion;
                }

                if ($Nbquestion != $Nbrep) {
                    document.getElementById('progress').hidden = true;
                    document.getElementById('recommandations').hidden = true;
                    document.getElementById('dropdownMenuButton1').hidden = true;
                    document.getElementById('divErreur').hidden = false;
                } else {
                    document.getElementById('progress').hidden = false;
                    document.getElementById('recommandations').hidden = false;
                    document.getElementById('dropdownMenuButton1').hidden = false;
                    document.getElementById('divErreur').hidden = true;
                }
            },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });

    function reduire($div) {
        for (let f = 0; f < document.getElementsByClassName($div).length; f++) {
            if (document.getElementsByClassName($div)[f].hidden == true) {
                document.getElementsByClassName($div)[f].hidden = false;
                document.getElementById("img"+$div).style.cssText += "transform: rotate(0deg);"
            } else {
                document.getElementsByClassName($div)[f].hidden = true;
                document.getElementById("img"+$div).style.cssText += "transform: rotate(180deg);"
            }
        }
        
    }

    $.ajax({
        url: './AjaxLoader/getReco.php',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {

            $categorie = [];
            for (let e = 0; e < data['data'].length; e++) {
                if (!$categorie.includes(data['data'][e].categorieId)) {
                    $categorie.push(data['data'][e].categorieId);
                }
            }

            $theme = [];
            for (let y = 0; y < data['data'].length; y++) {
                if (!$theme.includes(data['data'][y].themeId)) {
                    $theme.push(data['data'][y].themeId);
                }
            }

            $obj = [];
            for (let a = 0; a < $categorie.length; a++) {
                $temp = [];
                for (let i = 0; i < data['data'].length; i++) {
                    if (data['data'][i].categorieId == $categorie[a]) {
                        
                        $temp.push([data['data'][i]]);
                        
                    }
                }

                $obj2 = [];
                for (let u = 0; u < $theme.length; u++) {
                    $temp2 = [];
                    for (let o = 0; o < $temp.length; o++) {
                        if ($temp[o][0].themeId == $theme[u]) {
                            $temp2.push($temp[o][0]);
                        }
                    }
                    $obj2[$theme[u]] = $temp2;
                }

                for (let z = 0; z < $theme.length; z++) {
                    if ($obj2[$theme[z]].length == 0) {
                        delete $obj2[$theme[z]];
                    }
                }

                $obj[$categorie[a]] = $obj2;
            }

            $count = 1;

            var a1 = Object.keys($obj).map(function (k) { return $obj[k];})

            for (let h = 0; h < a1.length; h++) {

                $nb = 0;
                let div0 = document.createElement('div');
                
                document.getElementById('recommandations').append(div0);
                
                var a2 = Object.keys(a1[h]).map(function (k) { return a1[h][k];})

                div0.setAttribute("id", "parent"+a2[0][0].categorieId);

                for (let w = 0; w < a2.length; w++) {
                    $nb2 = 0;
                    for (let n = 0; n < a2[w].length; n++) {
                        
                        if ($nb == 0) {

                            let div6 = document.createElement('div');
                            div6.setAttribute("class", "divIconCateg");
                            div0.append(div6);

                            let div7 = document.createElement('div');
                            div7.setAttribute("class", "divRond");
                            div6.append(div7);

                            let img = document.createElement('img');
                            img.setAttribute("class", "IconCateg");
                            if (a2[w][n].Img != null && a2[w][n].Img != "") {
                                img.setAttribute("src", "./img/"+a2[w][n].Img);
                                img.setAttribute("alt", a2[w][n].Categorie);
                            }
                            div7.append(img);

                            let p = document.createElement('p');
                            p.setAttribute("class", "categ");
                            p.textContent = a2[w][n].Categorie;
                            div6.append(p);

                            let div8 = document.createElement('div');
                            div8.setAttribute("id", "trait2");
                            div6.append(div8);

                            let img2 = document.createElement('img');
                            img2.setAttribute("id", "img"+a2[w][n].categorieId);
                            img2.setAttribute("style", "cursor: pointer; margin: auto 10px; filter: brightness(0) saturate(100%) invert(20%) sepia(88%) saturate(387%) hue-rotate(125deg) brightness(92%) contrast(99%);");
                            img2.setAttribute("src", "img/Flechetype2.svg");
                            img2.setAttribute("onclick", "reduire('"+a2[w][n].categorieId+"')");
                            div6.append(img2);

                            $nb = 1;
                        }

                        if ($nb2 == 0) {

                            let p2 = document.createElement('p');
                            p2.setAttribute("class", "theme "+a2[w][n].categorieId+" "+a2[w][n].themeId);
                            p2.textContent = a2[w][n].Theme;
                            div0.append(p2);
                            $nb2 = 1;
                        }

                        let div1 = document.createElement('div');
                        div1.setAttribute("class", "cadreReco2 "+a2[w][n].categorieId+" "+a2[w][n].themeId);
                        div0.append(div1);

                        let div2 = document.createElement('div');
                        div2.setAttribute("class", "num3");
                        div1.append(div2);

                        let h3 = document.createElement('h3');
                        // h3.textContent = $count;
                        div2.append(h3);

                        let div3 = document.createElement('div');
                        div3.setAttribute("class", "contenuReco col-11");
                        div1.append(div3);

                        let div9 = document.createElement('div');
                        div9.setAttribute("class", "contenuReco col-1");
                        div1.append(div9);

                        for (let t = 0; t < 2; t++) {
                            if (a2[w][n].Tag != undefined) {
                                let p5 = document.createElement('p');
                                p5.setAttribute("style", "color: #00857A;");
                                p5.textContent = a2[w][n].Tag;
                                div9.append(p5);
                            }
                        }

                        let div4 = document.createElement('div');
                        div4.setAttribute("class", "titreReco2");
                        div3.append(div4);

                        let p3 = document.createElement('p');
                        p3.setAttribute("style", "margin-bottom: 0rem;");
                        p3.textContent = a2[w][n].Question;
                        div4.append(p3);

                        let div5 = document.createElement('div');
                        div5.setAttribute("class", "textReco2");
                        div3.append(div5);

                        let p4 = document.createElement('p');
                        p4.textContent = a2[w][n].Text;
                        div5.append(p4);

                        $count += 1;
                    }
                }
            }

        },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });

</script>