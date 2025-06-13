// var svg = document.querySelector("#svg");

// var point = svg.createSVGPoint();
// var viewBox = svg.viewBox.baseVal;

// var cachedViewBox = {
//     x: viewBox.x,
//     y: viewBox.y,
//     width: viewBox.width,
//     height: viewBox.height
// };

// $count = 0;
// function elementPosition(a) {

//     if ($count == 0) {
//         var b = a.getBoundingClientRect();

//         var scaleFactor = 3;
//         var scaleDelta = 1 / scaleFactor;

//         point.x = b.x;
//         point.y = b.y;

//         var startPoint = point.matrixTransform(svg.getScreenCTM().inverse());

//         var fromVars = {
//             x: viewBox.x,
//             y: viewBox.y,
//             width: viewBox.width,
//             height: viewBox.height,
//             ease: Power2.easeOut
//         };

//         viewBox.x -= (startPoint.x - viewBox.x) * (scaleDelta - 1);
//         viewBox.y -= (startPoint.y - viewBox.y) * (scaleDelta - 1);
//         viewBox.width *= scaleDelta;
//         viewBox.height *= scaleDelta;

//         TweenLite.from(viewBox, 0.5, fromVars);
//         $count = 1;
//     } else {
//         TweenLite.to(viewBox, 0.4, {
//             x: cachedViewBox.x,
//             y: cachedViewBox.y,
//             width: cachedViewBox.width,
//             height: cachedViewBox.height
//         });
//         $count = 0;
//     }

// }

// recuperer la demande de rattachement a l'OPSN
$.ajax({
    url: '/api/collectivite/rattachement',
    type: 'GET',
    async: false,
    dataType: 'json',
    success: function (data) {
        if (data !== null) {
            document.getElementById('attente').hidden = false;
            document.getElementById('map').hidden = true;
            document.getElementsByClassName('recherche')[0].hidden = true;
        }
    },
    error: function (jqXhr, textStatus, errorThrown) {
        // console.error('Une erreur est survenue');
    }
})

function annulation() { // annuler la demande de rattachement
    $info = "OPSN";
    $.ajax({
        url: '/api/collectivite/rattachement',
        type: 'DELETE',
        success: function () {
            window.location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })
}

var map = document.querySelector('#map');
var paths = map.querySelectorAll('.map__image a');

//Polyfill du foreach
if (NodeList.prototype.forEach === undefined) {
    NodeList.prototype.forEach = function (callback) {
        [].forEach.call(this, callback)
    }
}

var activeArea = function (element) {

    map.querySelectorAll('.is-active').forEach(function (item) {
        item.classList.remove('is-active');
    });
    if (element !== undefined) {
        if (element.id.length > 3) {
            element.classList.add('is-active');
            for (let o = 0; o < document.querySelectorAll('.' + element.id.replace('region-', '')).length; o++) {
                document.querySelectorAll('.' + element.id.replace('region-', ''))[o].children[1].classList.add('is-active');
                
            }
            
        } else {
            element.classList.add('is-active');
            document.querySelector('#region-' + element.classList[1]).classList.add('is-active');
        }

    }
}

var OPSNRegion = function ($region) {
    // var list = document.querySelectorAll(".map__list div");
    // $actif = 0;
    // if ($region.classList[0] == 'click-is-active' || $region.classList[1] == 'click-is-active') {
    //     $actif = 1;
    // }

    // list.forEach((item) => {
    //     item.classList.remove('hide');
    // });
    // if ($actif == 0) {
    //     list.forEach((item) => {
    //         if (item.classList[1] != "is-active" && item.classList[0] != "map__logo__list__item__text") {
    //             item.classList.add('hide');
    //         }
    //     });
    // }
    $('.pagination')[0].hidden = true;
    $('.pagination2')[0].hidden = false;

    let page = $('.pagination__number2');
    let pagination = 1;

    let chevronLeft = $('.pagination__left2');
    let chevronRight = $('.pagination__right2');

    let tableau2 = [];
    let tableau3 = [];

    chevronLeft.click(function () {
        if (pagination > 1) {
            $('#main').empty();
            pagination--;
            paginationAffi();
            page.html(pagination);
            OPSNAffichage2();
        }
    });

    chevronRight.click(function () {
        let paginationMax = tableau2.length / 9;
        if (pagination < Math.ceil(paginationMax)) {
            $('#main').empty();
            pagination++;
            paginationAffi();
            page.html(pagination);
            OPSNAffichage2();
        }
    });

    function paginationAffi() {
        tableau2 = [];
        tableau3 = [];

        let top = pagination * 9;
        let content = top - 9;

        for (let i = 0; i < $OPSN.length; i++) {
            if ($CodeRegion == $OPSN[i].departements[0].region.name) {
                tableau2.push($OPSN[i]);
            }
        }

        for (let i = 0; i < tableau2.length; i++) {
            if (i >= content && tableau3.length < top) {
                tableau3.push(tableau2[i]);
            }
        }
    };

    $CodeRegion = $region.attributes[1].nodeValue;

    paginationAffi();

    page.html(pagination);

    document.getElementById("main").textContent = "";

    if ($region.classList[0] == 'click-is-active' || $region.classList[1] == 'click-is-active') {
        getOPSN();
    } else {
        OPSNAffichage2();
    }

    function OPSNAffichage2() {
        tableau3.forEach(element => {
            if ($CodeRegion == element.departements[0].region.name) {

                let a = document.createElement('a');
                a.setAttribute('class', 'map__logo__list__item');

                let img = document.createElement('img');
                img.setAttribute('class', 'map__logo__list__item__img');
                img.setAttribute('src', "/img/LogoOPSN/" + element.logo);

                let divTexte = document.createElement('div');
                divTexte.setAttribute('class', "map__logo__list__item__text");
                divTexte.textContent = element.name + " - " + element.departement;

                a.appendChild(img);
                a.appendChild(divTexte);

                a.setAttribute("href", "#");
                if (element.active == true) {
                    a.setAttribute("onClick", "confirmationModal('" + element.id + "', '" + element.name + "')");
                } else {
                    img.setAttribute('style', 'filter: grayscale(1);');
                    a.setAttribute('style', 'cursor: unset;');
                }

                if (element.departements[0].region.code == 11) {
                    a.setAttribute("class", "IDF");
                    a.setAttribute('class', 'map__list__bloc IDF');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 24) {
                    a.setAttribute("class", "CVL");
                    a.setAttribute('class', 'map__list__bloc CVL');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 27) {
                    a.setAttribute("class", "BFC");
                    a.setAttribute('class', 'map__list__bloc BFC');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 28) {
                    a.setAttribute("class", "NOR");
                    a.setAttribute('class', 'map__list__bloc NOR');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 32) {
                    a.setAttribute("class", "HDF");
                    a.setAttribute('class', 'map__list__bloc HDF');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 44) {
                    a.setAttribute("class", "GES");
                    a.setAttribute('class', 'map__list__bloc GES');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 52) {
                    a.setAttribute("class", "PDL");
                    a.setAttribute('class', 'map__list__bloc PDL');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 53) {
                    a.setAttribute("class", "BRE");
                    a.setAttribute('class', 'map__list__bloc BRE');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 75) {
                    a.setAttribute("class", "NAQ");
                    a.setAttribute('class', 'map__list__bloc NAQ');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 76) {
                    a.setAttribute("class", "OCC");
                    a.setAttribute('class', 'map__list__bloc OCC');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 84) {
                    a.setAttribute("class", "ARA");
                    a.setAttribute('class', 'map__list__bloc ARA');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 93) {
                    a.setAttribute("class", "PAC");
                    a.setAttribute('class', 'map__list__bloc PAC');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 94) {
                    a.setAttribute("class", "COR");
                    a.setAttribute('class', 'map__list__bloc COR');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 1) {
                    a.setAttribute("class", "GUA");
                    a.setAttribute('class', 'map__list__bloc GUA');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 2) {
                    a.setAttribute("class", "MAR");
                    a.setAttribute('class', 'map__list__bloc MAR');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 3) {
                    a.setAttribute("class", "GUY");
                    a.setAttribute('class', 'map__list__bloc GUY');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 4) {
                    a.setAttribute("class", "LRE");
                    a.setAttribute('class', 'map__list__bloc LRE');
                    document.getElementById('main').append(a);
                } else if (element.departements[0].region.code == 6) {
                    a.setAttribute("class", "MAY");
                    a.setAttribute('class', 'map__list__bloc MAY');
                    document.getElementById('main').append(a);
                }
            }
        });
    }
};


paths.forEach(function (path) {

    path.addEventListener('mouseenter', function (e) {
        activeArea(this);
    });

    path.addEventListener('click', function (e) {
        OPSNRegion(this);
    });
    path.addEventListener('click', function (e) {
        clickCouleur(this)
    });
})

map.addEventListener('mouseover', function () {
    activeArea();
})

$OPSN = "";
getOPSN();
function getOPSN() {

    $('.pagination')[0].hidden = false;
    $('.pagination2')[0].hidden = true;

    $.ajax({
        url: '/api/opsns',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function (OPSN) {
            
            // for (let i = 0; i < OPSN.length; i++) {
            //     if (OPSN[i].active == false) {
            //         OPSN.splice(i,1);
            //         i=i-1;
            //     }
            // }

            $OPSN = OPSN;

            let page = $('.pagination__number');
            let pagination = 1;

            let chevronLeft = $('.pagination__left');
            let chevronRight = $('.pagination__right');

            let tableau = [];

            chevronLeft.click(function () {
                if (pagination > 1) {
                    $('#main').empty();
                    pagination--;
                    paginationAffi();
                    page.html(pagination);
                    OPSNAffichage();
                }
            });

            chevronRight.click(function () {
                let paginationMax = OPSN.length / 9;
                if (pagination < Math.ceil(paginationMax)) {
                    $('#main').empty();
                    pagination++;
                    paginationAffi();
                    page.html(pagination);
                    OPSNAffichage();
                }
            });

            function paginationAffi() {
                tableau = [];
                let top = pagination * 9;
                let content = top - 9;

                for (let i = 0; i < OPSN.length; i++) {
                    if (i >= content && i < top) {
                        tableau.push(OPSN[i]);
                    }
                }
            };
            paginationAffi();

            page.html(pagination);

            function OPSNAffichage() {
                tableau.forEach(element => {
                    let a = document.createElement('a');
                    a.setAttribute('class', 'map__logo__list__item');
                    
                    let img = document.createElement('img');
                    img.setAttribute('class', 'map__logo__list__item__img');
                    img.setAttribute('src', "/img/LogoOPSN/" + element.logo);
                    
                    let divTexte = document.createElement('div');
                    divTexte.setAttribute('class', "map__logo__list__item__text");
                    divTexte.textContent = element.name + " - " + element.departement;
                    
                    a.appendChild(img);
                    a.appendChild(divTexte);
                    
                    a.setAttribute("href", "#");
                    if (element.active == true) {
                        a.setAttribute("onClick", "confirmationModal('" + element.id + "', '" + element.name + "')");
                    } else {
                        img.setAttribute('style', 'filter: grayscale(1);');
                        a.setAttribute('style', 'cursor: unset;');
                    }
                    
                    CodeRegion = null;
                    // get the code region with jQuery on /api/regions 
                    $.ajax({
                        url: '/api/regions/' + element.departement,
                        type: 'get',
                        async: false,
                        dataType: 'json',
                        success: function (region) {
                            CodeRegion = region;
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            console.error('Une erreur est survenue');
                        }
                    });
                    
                    if (CodeRegion == 11) {
                        a.setAttribute("class", "IDF");
                        a.setAttribute('class', 'map__list__bloc IDF');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 24) {
                        a.setAttribute("class", "CVL");
                        a.setAttribute('class', 'map__list__bloc CVL');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 27) {
                        a.setAttribute("class", "BFC");
                        a.setAttribute('class', 'map__list__bloc BFC');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 28) {
                        a.setAttribute("class", "NOR");
                        a.setAttribute('class', 'map__list__bloc NOR');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 32) {
                        a.setAttribute("class", "HDF");
                        a.setAttribute('class', 'map__list__bloc HDF');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 44) {
                        a.setAttribute("class", "GES");
                        a.setAttribute('class', 'map__list__bloc GES');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 52) {
                        a.setAttribute("class", "PDL");
                        a.setAttribute('class', 'map__list__bloc PDL');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 53) {
                        a.setAttribute("class", "BRE");
                        a.setAttribute('class', 'map__list__bloc BRE');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 75) {
                        a.setAttribute("class", "NAQ");
                        a.setAttribute('class', 'map__list__bloc NAQ');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 76) {
                        a.setAttribute("class", "OCC");
                        a.setAttribute('class', 'map__list__bloc OCC');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 84) {
                        a.setAttribute("class", "ARA");
                        a.setAttribute('class', 'map__list__bloc ARA');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 93) {
                        a.setAttribute("class", "PAC");
                        a.setAttribute('class', 'map__list__bloc PAC');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 94) {
                        a.setAttribute("class", "COR");
                        a.setAttribute('class', 'map__list__bloc COR');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 1) {
                        a.setAttribute("class", "GUA");
                        a.setAttribute('class', 'map__list__bloc GUA');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 2) {
                        a.setAttribute("class", "MAR");
                        a.setAttribute('class', 'map__list__bloc MAR');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 3) {
                        a.setAttribute("class", "GUY");
                        a.setAttribute('class', 'map__list__bloc GUY');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 4) {
                        a.setAttribute("class", "LRE");
                        a.setAttribute('class', 'map__list__bloc LRE');
                        document.getElementById('main').append(a);
                    } else if (CodeRegion == 6) {
                        a.setAttribute("class", "MAY");
                        a.setAttribute('class', 'map__list__bloc MAY');
                        document.getElementById('main').append(a);
                    }
                });
            }
            OPSNAffichage();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
}

var links = map.querySelectorAll('.map__list a');
links.forEach(function (link) {
    link.addEventListener('mouseenter', function () {
        activeArea(this);
    });
})

function confirmationModal(opsnId, nom) {
    $('#modalConfirmtion').modal('show');
    $('.OPSNName')[0].innerHTML = nom;
    $('.OPSNName')[1].innerHTML = nom;
    $selectOPSNId = opsnId;
}

function closeModal() {
    $('#modalConfirmtion').modal('hide');
    $('#modalPasRattacher').modal('hide');
    $('#OPSN')[0].checked = false;
}

function rattachement() {
    // envoyer mail à l'opsn pour rattacher la collectivite
    $.ajax({
        url: '/api/collectivite/rattachement/' + $selectOPSNId,
        type: 'POST',
        success: function () {
            window.location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })
    closeModal();
}

function ModalNonRattachement() {
    if ($('#OPSN')[0].checked == true) {
        $('#modalPasRattacher').modal('show');
    }
}

function ConfirmNonRattachement() {
    closeModal();
    window.location.href = '/';
}


// Mettre/Retirer la couleur lors du click
function clickCouleur(element) {

    $count = 0;
    for (let $i = 0; $i < element.classList.length; $i++) {
        if (element.classList[$i] == "click-is-active") {
            element.classList.remove('click-is-active');
            $count = 1;
        }
    }
    if ($count == 0) {
        map.querySelectorAll('.click-is-active').forEach(function (item) {
            item.classList.remove('click-is-active');
        })
        element.classList.add("click-is-active");
    }

}

// Test pour zoom etc...

// let xMousePos = 0;
// let yMousePos = 0;
// const carte = document.querySelector('.map__image');
// carte.onmousemove = function (e) {
//     xMousePos = e.clientX;
//     yMousePos = e.clientY;
//     console.log("C'est la position x =", xMousePos, "C'est la position y =", yMousePos);
// }

// const cursor = document.querySelector('.cursor');

// document.addEventListener('mousemove', e => {
//     cursor.setAttribute('style', 'top:' + (e.clientY - 15) + "px; left:" + (e.clientX - 15) + "px;")
// })