<?php include "Common.php"?>


<!-- Header  -->
<?php require "header.php"?>

<!-- Sidebar  -->
<?php require "menu.php"?>

<script src="./js/statistiques.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php"?>

    <div class="page-content ">
        <div class="row">
            <!-- Main  -->
            <div class="col-xl-6 col-md-12">
                <div class="info">
                    <div>
                        <h2 id="col"></h2>
                        <h3><span id="type"></span><span> - </span><span id="CP"></span></h3>
                    </div>
                    <div id="progress">
                        <svg class="progress-ring" width="120" height="120"> 
                            <circle id="cercle0" class="progress-ring__circle" stroke="white" stroke-width="4" fill="transparent" r="52" cx="60" cy="60" style="stroke-dasharray: 326.726, 326.726; stroke-dashoffset: 326.726;"></circle> 
                        </svg>

                        <p class="progressContent" id="completion" style="top: 40px; left: 25px;" hidden="true">
                            Complété à </br><span id="pourcentage" style="font-size: 18px;"></span>
                        </p>

                        <p class="progressContent" id="indice" style="top: 40px; left: 32px; color: #08453F;" hidden="true">
                            Score </br><span id="score" style="font-size: 18px; color: #000;"></span>
                        </p>
                    </div>
                    
                </div>

                <div id="stat">
                    <div id="titreStat">
                        <h3 style="margin-bottom: 0;">Statistiques</h3>
                        <div id="trait"></div>
                        <button id="btnPrint">
                            <i class="fas fa-print" style="color: #FFF;"></i>
                        </button>
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
                    
                </div>
            </div>

            <div id="recommandations" class="col-xl-6 col-md-12 row">

                <div id="last" class="tous div1 col-xl-5 col-md-12">
                    <p class="pTous">Voir toutes les recommandations</p>

                    <div class="fleche flecheTous">
                        <a href="recommandations.php">
                            <i class="fa-solid fa-arrow-right fa-xl"></i>
                        </a>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
<style>
</style>

<script>
    
    $(document).ready(function(){

        $('#btnPrint').on('click', function () {
            $("#chart").dxChart('instance').print();
        });

        function Timeout() {
            setTimeout(size, 300);
        }

        $(window).on('resize', size);
        $("#retrecir").on('click', Timeout);
        size();

        function size() {
            if (window.innerWidth > 970) {
                $('#content').width(window.innerWidth - $('#sidebar').width());
                $('#chart').dxChart("instance").render();
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
            async: false,
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
            url: './AjaxLoader/getUserProgression.php?userId=<?php echo $utilisateurId; ?>' ,
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
                        url: './AjaxLoader/getUserScore.php?userId=<?php echo $utilisateurId; ?>' ,
                        type: 'get',
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            $('#progress')[0].style.backgroundColor = "#E9FBF9";
                            $('#progress')[0].style.borderRadius = "90px";
                            $('#progress')[0].style.marginRight = "5px";
                            document.querySelector('#score').textContent = Math.ceil(data['data'][0].score * 100 / data['data'][0].nb)+"/100";
                            $('#indice').removeAttr('hidden');
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

                    let i1 = document.createElement('i');
                    i1.setAttribute("class", "fa-regular fa-circle-question fa-xl");
                    div3.append(i1);

                    let p2 = document.createElement('p');
                    p2.setAttribute("class", "recoNumber");
                    if ($userProgression2 != undefined) {
                        p2.textContent = $userProgression2.NbRepondu+"/"+data['data'][i].nbQuestion;
                        $count = 0;
                    } else {
                        p2.textContent = 0+"/"+data['data'][i].nbQuestion;
                        $count = $count+1;
                    }
                    div3.append(p2);

                    let p3 = document.createElement('p');
                    p3.setAttribute("class", "recoText");
                    p3.textContent = "questions complétées";
                    div3.append(p3);

                    let div4 = document.createElement('div');
                    div4.setAttribute("class", "recoDispo row");
                    div1.append(div4);

                    let i2 = document.createElement('i');
                    i2.setAttribute("class", "fa-regular fa-clipboard fa-xl");
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