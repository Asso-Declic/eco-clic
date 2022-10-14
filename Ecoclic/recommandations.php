<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>


<!-- Header  -->
<?php require "header.php"?>

<!-- Sidebar  -->
<?php require "menu.php"?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php"?>

    <div class="col-12 fil-ariane py-2 px-4">
        <img src="img/recommandations.svg" alt="">
        <a class="fil-ariane" href="./recommandations.php">Recommandations</a>            
    </div>

    <div class="d-flex col-12 justify-content-end">
        <button id='imprimer' class="bouton-ecoclic px-5 py-3 rounded text-white"><i class="fas fa-print pr-2"></i>Imprimer</button>
    </div>

    <div id="recommandations" class="page-content">
    </div>

<script>
    $("#imprimer").on("click", function() {
        var printContents = document.getElementById("recommandations").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    })

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
                
                for (let w = 0; w < a2.length; w++) {
                    $nb2 = 0;
                    for (let n = 0; n < a2[w].length; n++) {
                        
                        if ($nb == 0) {

                            let p = document.createElement('p');
                            p.setAttribute("class", "categ");
                            p.textContent = a2[w][n].Categorie;
                            div0.append(p);
                            $nb = 1;
                        }

                        if ($nb2 == 0) {

                            let p2 = document.createElement('p');
                            p2.setAttribute("class", "theme");
                            p2.textContent = a2[w][n].Theme;
                            div0.append(p2);
                            $nb2 = 1;
                        }

                        let div1 = document.createElement('div');
                        div1.setAttribute("class", "cadreReco2");
                        div0.append(div1);

                        let div2 = document.createElement('div');
                        div2.setAttribute("class", "num");
                        div1.append(div2);

                        let h3 = document.createElement('h3');
                        h3.textContent = $count;
                        div2.append(h3);

                        let div3 = document.createElement('div');
                        div3.setAttribute("class", "contenuReco");
                        div1.append(div3);

                        let div4 = document.createElement('div');
                        div4.setAttribute("class", "titreReco");
                        div3.append(div4);

                        let p3 = document.createElement('p');
                        p3.textContent = a2[w][n].Question;
                        div4.append(p3);

                        let div5 = document.createElement('div');
                        div5.setAttribute("class", "textReco");
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