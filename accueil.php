<?php include "Common.php"?>



<!-- Header  -->
<?php require "header.php"?>
<head>
    <title>L'éco-clic - Accueil</title>
</head>
<!-- Sidebar  -->
<?php require "menu.php"?>

<script src="./js/statistiques.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php";?>

    <div class="page-content ">
        <div class="row">
            <!-- Main  -->
            <div class="col-xl-6 col-md-12">
                <div class="info">
                    <div>
                        <h2 id="col"></h2>
                        <h3><span id="type"></span><span> - </span><span id="CP"></span></h3>
                        <a id="commencer" hidden style="text-decoration: underline; cursor: pointer;">Démarrer le questionnaire</a>
                    </div>
                    <div id="progress" class="">
                        <svg class="progress-ring" width="105" height="105">
                            <circle id="cercle0" class="progress-ring__circle" stroke="white" stroke-width="4" fill="transparent" r="45" cx="50" cy="55" style="stroke-dasharray: 326.726, 326.726; stroke-dashoffset: 326.726;"></circle> 
                        </svg>

                        <p class="progressContent" id="completion" style="top: 40px; left: 22px;" hidden="true">
                            Complété à </br><span id="pourcentage" style="font-size: 18px;"></span>
                        </p>

                        <p class="progressContent" id="indice" style="top: 14px; line-height: 1; left: 15px; color: #fafafa; font-size: 26px;background-image: linear-gradient(#08433D 0 0); background-position: bottom center; background-size: 79% 1.5px; background-repeat: no-repeat;" hidden="true">
                            <!-- Score </br><span id="score" style="font-size: 18px; color: #000;"></span> -->
                            <span id="A" class="scoreLetter" style="color: #038141;">A</span><span id="B" class="scoreLetter" style="color: #627A39;">B</span><span id="C" class="scoreLetter" style="color: #966A09;">C</span><span id="D" class="scoreLetter" style="color: #B65713;">D</span><span id="E" class="scoreLetter" style="color: #A80000;">E</span>
                        </p>
                    </div>
                    
                </div>

                <!-- <div id="stat">
                    <div id="titreStat">
                        <h3 style="margin-bottom: 0;">Statistiques</h3>
                        <div id="trait"></div>
                        <a href="#" style="text-decoration: underline; cursor: pointer;line-height: 2; padding-top: 2px;">Voir tout</a>
                    </div>

                    <div id="graph">
                        <div class="col-12 pt-5">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                <span class="sous-titre" style="font-weight: bold; margin: auto 0;">Votre évolution</span>
                                
                                <div>
                                    <div class="dropdown">
                                        <button class="align-items-center btn d-flex justify-content-between btn filtres dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            <span class="px-4">Thématiques</span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <div id="treeview"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="chart"></div>
                        </div>
                    </div>
                    
                </div> -->
            </div>

            <div id="recommandations" class="col-xl-6 col-md-12 row">

                <a id="last" class="tous div1 col-xl-5 col-md-12 p-0" style="color: #fff;" href="recommandations.php">
                    
                    <div class="pTous">
                        <div style="font-size:large">Accéder au plan </div>
                        <div style="font-size:large">d'action</div>
                    </div>

                    <div class="fleche flecheTous">
                        <i class="fa-solid fa-arrow-right fa-xl"></i>
                    </div>
                    
                </a>
                    
            </div>
        </div>
    </div>
<style>
</style>

<script>
    
    $(document).ready(function(){

        function Timeout() {
            setTimeout(size, 300);
        }

        $(window).on('resize', size);
        $("#retrecir").on('click', Timeout);
        size();

        function size() {
            if (window.innerWidth > 970) {
                $('#content').width(window.innerWidth - $('#sidebar').width());
                // $('#chart').dxChart("instance").render();
            } else {
                $('#content').width("100%");
            }
            
        }

        $Siret = "";
        $.ajax({
            url: './AjaxLoader/GetInfoColId.php?Id=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId ?>' ,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function(data) {
                document.getElementById("col").textContent = data[0].Nom;
                if (data[0].Type == "Mairie") {
                    document.getElementById("type").textContent = "Commune";
                } else {
                    document.getElementById("type").textContent = data[0].Type;
                }
                
                $Siret = data[0].Siret;
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });

        $.ajax({
            url: './AjaxLoader/GetInfoBySiret.php?Siret='+$Siret ,
            type: 'get',
            async: true,
            dataType: 'json',
            success: function(data) {
                document.getElementById("CP").textContent = data.CodePostal;
            },
            error: function(jqXhr, textStatus, errorThrown) {
                document.getElementById("CP").textContent = "";
            }
        });

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

        $userProgression2 = undefined;
        $count = 0;
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

                var circumference = 52 * 2 * Math.PI;
                var percent = ($Nbrep / $Nbquestion) * 100;
                const offset = circumference - percent / 100 * circumference;
                if (offset != 0) {
                    document.querySelector('#cercle0').style.strokeDashoffset = offset;
                    document.querySelector('#pourcentage').textContent = Math.round(percent)+"%";
                    $('#completion').removeAttr('hidden');
                } else {
                    // appel ajax qui recup ponderation des questions
                    $.ajax({
                        url: './AjaxLoader/getUserScore.php?CollectiviteId=<?php echo SessionHelper::GetCurrentUser()->CollectiviteId; ?>' ,
                        type: 'get',
                        async: false,
                        dataType: 'json',
                        success: function(data) {
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
                            $('#last').removeAttr('hidden');
                        },
                        error: function(jqXhr, textStatus, errorThrown) {
                            alert('Une erreur est survenue');
                        }
                    });
                    
                }
                

                for (let i = 0; i < data['data'].length; i++) {

                    for (let y = 0; y < $userProgression.length; y++) {
                        if ($userProgression[y].CategorieId == data['data'][i].Id) {
                            $userProgression2 = $userProgression[y];
                            break;
                        } else {
                            $userProgression2 = undefined;
                        }
                        
                    }

                    var circumference2 = 32 * 2 * Math.PI;
                    if ($userProgression2 != undefined) {
                        var percent2 = ($userProgression2.NbRepondu / data['data'][i].nbQuestion) * 100;
                    } else {
                        var percent2 = (0 / data['data'][i].nbQuestion) * 100;
                    }
                    const offset2 = circumference2 - percent2 / 100 * circumference2;

                    let div1 = document.createElement('div');
                    div1.setAttribute("class", "reco div1 col-xl-5 col-md-12");
                    document.getElementById('recommandations').insertBefore(div1, document.getElementById('last'));

                    let div2 = document.createElement('div');
                    div2.setAttribute("class", "recoTitre row");
                    div1.append(div2);

                    let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    svg.setAttribute("class", "progress-ring");
                    svg.setAttribute("width", "90");
                    svg.setAttribute("height", "120");
                    div2.append(svg);

                    let circle = document.createElementNS('http://www.w3.org/2000/svg' ,'circle');
                    circle.setAttribute("id", "cercle"+i);
                    circle.setAttribute("class", "progress-ring__circle");
                    circle.setAttribute("stroke", "#12857A");
                    circle.setAttribute("stroke-width", "3");
                    circle.setAttribute("fill", "#fff");
                    circle.setAttribute("r", "32");
                    circle.setAttribute("cx", "60");
                    circle.setAttribute("cy", "60");
                    circle.setAttribute("style", "stroke-dasharray: "+circumference2+", "+circumference2+"; stroke-dashoffset: "+offset2+";");
                    svg.append(circle);

                    let img = document.createElement('img');
                    img.setAttribute("class", "progressContent progressReco");
                    if (data['data'][i].Img != null && data['data'][i].Img != "") {
                        img.setAttribute("src", "./img/"+data['data'][i].Img);
                        img.setAttribute("alt", data['data'][i].Nom);
                    }
                    div2.append(img);

                    let p1 = document.createElement('p');
                    p1.setAttribute("class", "pReco");
                    p1.textContent = data['data'][i].Nom;
                    div2.append(p1);
                    
                    let div3 = document.createElement('div');
                    div3.setAttribute("class", "recoQuestion row");
                    div1.append(div3);

                    let i1 = document.createElement('img');
                    i1.setAttribute("style", "padding-bottom: 15px;");
                    i1.setAttribute("src", "./img/questionMessage.svg");
                    div3.append(i1);

                    let p2 = document.createElement('p');
                    p2.setAttribute("class", "recoNumber");
                    if ($userProgression2 != undefined) {
                        p2.textContent = $userProgression2.NbRepondu+"/"+data['data'][i].nbQuestion;
                        $count = 0;

                        if (document.getElementById("commencer").hidden == true && $userProgression2.NbRepondu != data['data'][i].nbQuestion) {
                            document.getElementById("commencer").hidden = false;
                            document.getElementById("commencer").href = "categories.php?CategorieId="+data['data'][i].Id;
                        }
                    } else {
                        p2.textContent = 0+"/"+data['data'][i].nbQuestion;
                        $count = $count+1;

                        if (document.getElementById("commencer").hidden == true) {
                            document.getElementById("commencer").hidden = false;
                            document.getElementById("commencer").href = "categories.php?CategorieId="+data['data'][i].Id;
                        }
                    }
                    div3.append(p2);

                    let p3 = document.createElement('p');
                    p3.setAttribute("class", "recoText");
                    p3.textContent = "questions complétées";
                    div3.append(p3);

                    let div4 = document.createElement('div');
                    div4.setAttribute("class", "recoDispo row");
                    div1.append(div4);

                    let i2 = document.createElement('img');
                    i2.setAttribute("style", "padding-bottom: 15px;");
                    i2.setAttribute("src", "./img/clipboard.svg");
                    div4.append(i2);

                    let p4 = document.createElement('p');
                    p4.setAttribute("class", "recoNumber");
                    p4.textContent = data['data'][i].nbReco;
                    div4.append(p4);

                    let p5 = document.createElement('p');
                    p5.setAttribute("class", "recoText");
                    p5.textContent = "recommandations disponibles";
                    div4.append(p5);

                    let div5 = document.createElement('div');
                    div5.setAttribute("class", "fleche");
                    div1.append(div5);

                    let a = document.createElement('a');
                    a.setAttribute("href", "categories.php?CategorieId="+data['data'][i].Id);
                    div5.append(a);

                    let i3 = document.createElement('i');
                    i3.setAttribute("class", "fa-solid fa-arrow-right fa-xl");
                    a.append(i3);
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });

        
    });
</script>