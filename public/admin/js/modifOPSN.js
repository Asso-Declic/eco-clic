// var OPSN;
$(function () {
    // $.ajax({
    //     url: '/api/opsns/' + opsnId,
    //     type: 'GET',
    //     async: false,
    //     dataType: 'JSON',
    //     success: function (reponse) {
    //         console.log(reponse);
    //         OPSN = reponse;
    //         OPSN.DepDeTravail = GetMasterDetails(OPSN.Id);
    //         i = 0;
    //         OPSN.CodeDepDeTravail = []
    //         OPSN.DepDeTravail.forEach(e => {
    //             OPSN.CodeDepDeTravail[i] = e.DepartementCode
    //             i++
    //         });
    //     },
    //     error: function (jqXhr, textStatus, errorThrown) {
    //         console.error('Une erreur est survenue');
    //     }
    // });

    var makeAsyncDataSourceDPTM = function () {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "code",
            load: function () {
                return $.getJSON(`/api/departments`);
            }
        });
    }

    var form = $("#form-modif").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
                dataField: "opsn[siret]",
                label: {
                    text: "Siret "
                },
                editorOptions: {
                    value: OPSN.siret,
                    //valueChangeEvent: "keyup",
                    buttons: [{
                        name: 'trash',
                        location: 'after',
                        options: {
                            stylingMode: 'text',
                            type: "default",
                            icon: '/img/info.svg',
                            onClick() {
                                $.ajax({
                                    url: "/api/insee/siret/" + $('[name=opsn\\[siret\\]]').val().replace(/\s/g, ''),
                                    method: "GET",
                                    async: false,
                                    timeout: 0,
                                })
                                .done(function (response) {
                                    $('[name=opsn\\[name\\]]').val(response.uniteLegale.denominationUniteLegale);

                                    $('[name=opsn\\[postalAddress\\]]').val(((response.adresseEtablissement.numeroVoieEtablissement!=null)?response.adresseEtablissement.numeroVoieEtablissement+" ":"")+ ((response.adresseEtablissement.typeVoieEtablissement!=null)?response.adresseEtablissement.typeVoieEtablissement+" ":"") +((response.adresseEtablissement.libelleVoieEtablissement!=null)?response.adresseEtablissement.libelleVoieEtablissement:""));
                                    
                                    $('[name=opsn\\[latitude\\]]').val("");
                                    $('[name=opsn\\[longitude\\]]').val("");
                                    if (response.adresseEtablissement.codeCommuneEtablissement.substr(0, 2) == 97) {
                                        $("[name=opsn\\[departement\\]]").val(response.adresseEtablissement.codeCommuneEtablissement.substr(0, 3))
                                    } else {
                                        $("[name=opsn\\[departement\\]]").val(response.adresseEtablissement.codeCommuneEtablissement.substr(0, 2))
                                    }
                                })
                                .fail(function (jqXHR, textStatus, errorThrown) {
                                    test = false
                                    console.error("le siret est inconnu");
                                });
                            },
                            elementAttr: {
                                class: 'bg-Ecoclic',
                            },
                        },
                    }],
                    onValueChanged(data) {
                        ($('[name=opsn\\[siret\\]]').val().replace(/\s/g, '') == '') ? DisableForm(true, data.value): DisableForm(false, data.value)
                        $('[name=opsn\\[siret\\]]').val($('[name=opsn\\[siret\\]]').val().replace(/\s/g, ''))
                    },
                },
                validationRules: [{
                    type: "custom",
                    message: "Siret ne peut pas être vide.",
                    validationCallback: function (e) {
                        if ($('[name=opsn\\[siret\\]]').val().replace(/\s/g, '') == '') {
                            return false
                        }
                        return true
                    }
                }]
            },
            {
                colCount: 2,
                itemType: "group",
                items: [{
                        dataField: "opsn[name]",
                        label: {
                            text: "Nom "
                        },
                        editorOptions: {
                            value: OPSN.name,
                        },
                        validationRules: [{
                            type: "required",
                            message: "Nom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "opsn[departement]",
                        label: {
                            text: "Departement "
                        },
                        editorType: "dxSelectBox",
                        editorOptions: {
                            dataSource: makeAsyncDataSourceDPTM(),
                            displayExpr: "name",
                            valueExpr: "code",
                            value: OPSN.departement,
                            itemTemplate: function (data) {
                                return "<div>" + data.code + " - " + data.name + "</div>";
                            }
                        },
                        validationRules: [{
                            type: "required",
                            message: "Departement ne peut pas être vide."
                        }]
                    }, {
                        dataField: "opsn[phoneNumber]",
                        label: {
                            text: "Téléphone "
                        },
                        editorOptions: {
                            value: OPSN.phoneNumber,
                        }
                    },
                    {
                        dataField: "opsn[email]",
                        label: {
                            text: "Mail "
                        },
                        editorOptions: {
                            value: OPSN.email,
                        },
                        validationRules: [{
                            type: "email",
                            message: "Mail est invalide"
                        }]
                    },
                    {
                        dataField: "opsn[postalAddress]",
                        label: {
                            text: "Adresse "
                        },
                        editorOptions: {
                            value: OPSN.postalAddress,
                        }
                    },
                    {
                        dataField: "opsn[website]",
                        label: {
                            text: "Site internet "
                        },
                        editorOptions: {
                            value: OPSN.website,
                        }
                    },
                ]
            },
            {
                dataField: "opsn[departements]",
                label: {
                    text: "Departement de travail "
                },
                editorType: "dxDropDownBox",
                editorOptions: {
                    valueExpr: "code",
                    placeholder: "Département(s)...",
                    displayExpr: "Nom",
                    showClearButton: true,
                    value: OPSN.departements,
                    dataSource: makeAsyncDataSourceDPTM(),
                    contentTemplate: function (e) {
                        var value = e.component.option("value"),
                            $dataGrid = $("<div>").dxDataGrid({
                                dataSource: e.component.getDataSource(),
                                columns: [
                                    { dataField: "name", caption: "Nom"},
                                    { dataField: "code", caption: "Code"},
                                ],
                                hoverStateEnabled: true,
                                paging: { enabled: true, pageSize: 10 },
                                filterRow: { visible: true },
                                scrolling: { mode: "virtual" },
                                height: 345,
                                selection: { showCheckBoxesMode: "always", mode: "multiple" },
                                selectedRowKeys: value,
                                onSelectionChanged: function (selectedItems) {
                                    var keys = selectedItems.selectedRowKeys;
                                    e.component.option("value", keys);
                                }
                            });
                        dataGrid = $dataGrid.dxDataGrid("instance");
                        e.component.on("valueChanged", function (args) {
                            var value = args.value;
                            dataGrid.selectRows(value, false);
                        });
                        return $dataGrid;
                    }
                }
            },
            // {
            //     dataField: "Logo",
            //     label: {
            //         text: "Logo "
            //     },
            //     template: function (data, itemElement) {
            //         var name;
            //         var type;
            //         if (OPSN.Logo != null) {
            //             itemElement.append(`<img id='Logo' src='../img/logos/${OPSN.Logo}' style='width: 100px;max-height: 100px;'>`)
            //         }
            //         itemElement.append($("<div>").attr("id", "dfilefu1").dxFileUploader({
            //             multiple: false,
            //             accept: "image/",
            //             name: 'Logo',
            //             //disabled: modifiable ? false : true,
            //             uploadMode: "instantly",
            //             uploadUrl: "../AjaxLoader/UploadTempFileOPSN.php",
            //             invalidFileExtensionMessage: "Le type de fichier est invalide",
            //             labelText: "",
            //             selectButtonText: "Sélectionner un fichier",
            //             onValueChanged: function (e) {
            //                 //type = e.value[0].type.replace("image/", "");
            //                 if (e.value != null && e.value != "" && e.value != undefined) {
            //                     var files = e.value;
            //                     if (files.length > 0) {
            //                         $.each(files, function (i, file) {
            //                             name = file.name //.replace("." + type, "")
            //                             $("[name=Type]").val(type)
            //                         });
            //                     }
            //                 }
            //             },
            //             onFilesUploaded: function (e) {
            //                 if (name != null && name != "") {
            //                     $("#Logo").attr("src", `../temp/output.png`)
            //                 }
            //             }
            //         }));
            //     },
            //     name: "Logo",
            //     label: {
            //         text: "Logo "
            //     },
            //     validationRules: [{
            //         type: "custom",
            //         message: "Type de fichier invalide.",
            //         validationCallback: function (e) {
            //             if ($("[name=Type]").val() == '' || $("[name=Type]").val() == null || $("[name=Type]").val() == undefined) {
            //                 return true
            //             }
            //             if (e.value[0].type.includes("image/")) {
            //                 return true
            //             }
            //             return false
            //         }
            //     }]
            // },
            {
                dataField: "opsn[active]",
                label: {
                    text: "Actif "
                },
                template: function (data, $itemElement) {
                    $(`<div class="custom-control custom-switch">
                    <input type="checkbox" name="opsn[active]" class="custom-control-input" id="customSwitch_modif">
                    <label class="custom-control-label" for="customSwitch_modif"></label>
                    </div>`).appendTo($itemElement);
                    $(`#customSwitch_modif`).attr("checked", OPSN.active);
                }
            },
            {
                dataField: "latitude",
                cssClass: "d-none",
                editorOptions: {
                    value: OPSN.latitude,
                }
            },
            {
                dataField: "longitude",
                cssClass: "d-none",
                editorOptions: {
                    value: OPSN.longitude,
                }
            },
            {
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "center",
                buttonOptions: {
                    text: "Valider",
                    type: "default",
                    useSubmitBehavior: true,
                    onClick: function (e) {
                        $('form').submit();
                    }
                }
            }
        ],
        minColWidth: 300,

    }).dxForm("instance");

    if ($('[name=opsn\\[siret\\]]').val().replace(/\s/g, '') == '') {
        DisableForm(true)
    }
})

// function GetMasterDetails(id) {
//     MasterData = [];
//     $.ajax({
//         url: '../AjaxLoader/GetMasterDetails.php',
//         type: 'GET',
//         async: false,
//         data: {
//             Id: id
//         },
//         dataType: 'JSON',
//         success: function (reponse) {
//             MasterData = reponse
//         },
//         error: function (jqXhr, textStatus, errorThrown) {
//             console.error('Une erreur est survenue');
//         }
//     });
//     return MasterData;
// }

function DisableForm(bool, Siret) {
    var champs = ["name", "departement", "phoneNumber", "email", "postalAddress", "website", "departements"];
    for (let i = 0; i < champs.length; i++) {
        itemOptions = $("#form-modif").dxForm('instance').itemOption(champs[i]);
        itemOptions.editorOptions.disabled = bool;
        $("#form-modif").dxForm('instance').itemOption(champs[i], "editorOptions", itemOptions.editorOptions);
    }
    $("#form-modif").dxForm('instance').itemOption("Logo", "disabled", bool);
    $('[name=opsn\\[siret\\]]').val(Siret)
}