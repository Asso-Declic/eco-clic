var OPSN;
$(function() {

    $.ajax({
        url: '../AjaxLoader/GetOPSN.php',
        type: 'GET',
        async: false,
        data: {
            Id: getUrlParam("Id")
        },
        dataType: 'JSON',
        success: function(reponse) {
            OPSN = reponse;
            OPSN.DepDeTravail = GetMasterDetails(OPSN.Id);
            i = 0;
            OPSN.CodeDepDeTravail = []
            OPSN.DepDeTravail.forEach(e => {
                OPSN.CodeDepDeTravail[i] = e.DepartementCode
                i++
            });
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });

    var makeAsyncDataSourceDPTM = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Code",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetDepartements.php`);
            }
        });
    }

    var form = $("#form-modif").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
                dataField: "Siret",
                label: {
                    text: "Siret "
                },
                editorOptions: {
                    value: OPSN.Siret,
                    //valueChangeEvent: "keyup",
                    buttons: [{
                        name: 'trash',
                        location: 'after',
                        options: {
                            stylingMode: 'text',
                            type: "default",
                            icon: '../img/info.svg',
                            onClick() {
                                $.ajax({
                                    url: 'https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/' + $('[name=Siret]').val().replace(/\s/g, ''),
                                    type: 'GET',
                                    async: true,
                                    dataType: 'JSON',
                                    success: function(reponse) {
                                        $('[name=Nom]').val(reponse.etablissement.unite_legale.denomination)
                                        $('[name=Adresse]').val(reponse.etablissement.geo_adresse)
                                        $('[name=Latitude]').val(reponse.etablissement.latitude)
                                        $('[name=Longitude]').val(reponse.etablissement.longitude)
                                        $('[name=Departement]').val(reponse.etablissement.code_postal.slice(0, 2))
                                        DevExpress.ui.notify("", "success");
                                    },
                                    error: function(jqXhr, textStatus, errorThrown) {
                                        alert('Le siret est incorrect');
                                    }
                                });
                            },
                            elementAttr: {
                                class: 'bg-Ecoclic',
                            },
                        },
                    }],
                    onValueChanged(data) {
                        ($('[name=Siret]').val().replace(/\s/g, '') == '') ? DisableForm(true, data.value): DisableForm(false, data.value)
                        $('[name=Siret]').val($('[name=Siret]').val().replace(/\s/g, ''))
                    },
                },
                validationRules: [{
                    type: "custom",
                    message: "Siret ne peut pas être vide.",
                    validationCallback: function(e) {
                        if ($('[name=Siret]').val().replace(/\s/g, '') == '') {
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
                        dataField: "Nom",
                        label: {
                            text: "Nom "
                        },
                        editorOptions: {
                            value: OPSN.Nom,
                        },
                        validationRules: [{
                            type: "required",
                            message: "Nom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Departement",
                        label: {
                            text: "Departement "
                        },
                        editorType: "dxSelectBox",
                        editorOptions: {
                            dataSource: makeAsyncDataSourceDPTM(),
                            displayExpr: "Nom",
                            valueExpr: "Code",
                            value: OPSN.DepartementCode,
                            itemTemplate: function(data) {
                                return "<div>" + data.Code + " - " + data.Nom + "</div>";
                            }
                        },
                        validationRules: [{
                            type: "required",
                            message: "Departement ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Telephone",
                        label: {
                            text: "Téléphone "
                        },
                        editorType: "dxNumberBox",
                        editorOptions: {
                            value: OPSN.Telephone,
                        }
                    },
                    {
                        dataField: "Mail",
                        label: {
                            text: "Mail "
                        },
                        editorOptions: {
                            value: OPSN.Mail,
                        },
                        validationRules: [{
                            type: "email",
                            message: "Mail est invalide"
                        }]
                    },
                    {
                        dataField: "Adresse",
                        label: {
                            text: "Adresse "
                        },
                        editorOptions: {
                            value: OPSN.Adresse,
                        }
                    },
                    {
                        dataField: "Site_internet",
                        label: {
                            text: "Site internet "
                        },
                        editorOptions: {
                            value: OPSN.Site_internet,
                        }
                    },
                ]
            },
            {
                dataField: "Departement_de_travail",
                label: {
                    text: "Departement de travail "
                },
                editorType: "dxDropDownBox",
                editorOptions: {
                    valueExpr: "Code",
                    placeholder: "Département(s)...",
                    displayExpr: "Nom",
                    showClearButton: true,
                    value: OPSN.CodeDepDeTravail,
                    dataSource: makeAsyncDataSourceDPTM(),
                    contentTemplate: function(e) {
                        var value = e.component.option("value"),
                            $dataGrid = $("<div>").dxDataGrid({
                                dataSource: e.component.getDataSource(),
                                columns: ["Nom", "Code"],
                                hoverStateEnabled: true,
                                paging: { enabled: true, pageSize: 10 },
                                filterRow: { visible: true },
                                scrolling: { mode: "virtual" },
                                height: 345,
                                selection: { showCheckBoxesMode: "always", mode: "multiple" },
                                selectedRowKeys: value,
                                onSelectionChanged: function(selectedItems) {
                                    var keys = selectedItems.selectedRowKeys;
                                    e.component.option("value", keys);
                                }
                            });
                        dataGrid = $dataGrid.dxDataGrid("instance");
                        e.component.on("valueChanged", function(args) {
                            var value = args.value;
                            dataGrid.selectRows(value, false);
                        });
                        return $dataGrid;
                    }
                }
            },
            {
                dataField: "Logo",
                label: {
                    text: "Logo "
                },
                template: function(data, itemElement) {
                    var name;
                    var type;
                    if (OPSN.Logo != null) {
                        itemElement.append(`<img id='Logo' src='../img/logos/${OPSN.Logo}' style='width: 100px;max-height: 100px;'>`)
                    }
                    itemElement.append($("<div>").attr("id", "dfilefu1").dxFileUploader({
                        multiple: false,
                        accept: "image/",
                        name: 'Logo',
                        //disabled: modifiable ? false : true,
                        uploadMode: "instantly",
                        uploadUrl: "../AjaxLoader/UploadTempFileOPSN.php",
                        invalidFileExtensionMessage: "Le type de fichier est invalide",
                        labelText: "",
                        selectButtonText: "Sélectionner un fichier",
                        onValueChanged: function(e) {
                            //type = e.value[0].type.replace("image/", "");
                            if (e.value != null && e.value != "" && e.value != undefined) {
                                var files = e.value;
                                if (files.length > 0) {
                                    $.each(files, function(i, file) {
                                        name = file.name //.replace("." + type, "")
                                        $("[name=Type]").val(type)
                                    });
                                }
                            }
                        },
                        onFilesUploaded: function(e) {
                            if (name != null && name != "") {
                                $("#Logo").attr("src", `../temp/output.png`)
                            }
                        }
                    }));
                },
                name: "Logo",
                label: {
                    text: "Logo "
                },
                validationRules: [{
                    type: "custom",
                    message: "Type de fichier invalide.",
                    validationCallback: function(e) {
                        if ($("[name=Type]").val() == '' || $("[name=Type]").val() == null || $("[name=Type]").val() == undefined) {
                            return true
                        }
                        if (e.value[0].type.includes("image/")) {
                            return true
                        }
                        return false
                    }
                }]
            },
            {
                dataField: "Actif",
                label: {
                    text: "Actif "
                },
                template: function(data, $itemElement) {
                    $(`<div class="custom-control custom-switch">
                    <input type="checkbox" name="Actif" class="custom-control-input" id="customSwitch_modif">
                    <label class="custom-control-label" for="customSwitch_modif"></label>
                    </div>`).appendTo($itemElement);
                    $(`#customSwitch_modif`).attr("checked", (OPSN.Actif == 1) ? true : false);
                }
            }, {
                dataField: "Id",
                cssClass: "d-none",
                editorOptions: {
                    value: OPSN.Id,
                },
                validationRules: [{
                    type: "required",
                    message: "Nom ne peut pas être vide."
                }]
            },
            {
                dataField: "Latitude",
                cssClass: "d-none",
                editorOptions: {
                    value: OPSN.Latitude,
                }
            },
            {
                dataField: "Longitude",
                cssClass: "d-none",
                editorOptions: {
                    value: OPSN.Longitude,
                }
            },
            {
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "center",
                buttonOptions: {
                    text: "Valider",
                    type: "default",
                    useSubmitBehavior: true
                }
            }
        ],
        minColWidth: 300,

    }).dxForm("instance");

    if ($('[name=Siret]').val().replace(/\s/g, '') == '') {
        DisableForm(true)
    }
})

function GetMasterDetails(id) {
    MasterData = [];
    $.ajax({
        url: '../AjaxLoader/GetMasterDetails.php',
        type: 'GET',
        async: false,
        data: {
            Id: id
        },
        dataType: 'JSON',
        success: function(reponse) {
            MasterData = reponse
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    return MasterData;
}

function DisableForm(bool, Siret) {
    var champs = ["Nom", "Departement", "Telephone", "Mail", "Adresse", "Site_internet", "Departement_de_travail"];
    for (let i = 0; i < champs.length; i++) {
        itemOptions = $("#form-modif").dxForm('instance').itemOption(champs[i]);
        itemOptions.editorOptions.disabled = bool;
        $("#form-modif").dxForm('instance').itemOption(champs[i], "editorOptions", itemOptions.editorOptions);
    }
    $("#form-modif").dxForm('instance').itemOption("Logo", "disabled", bool);
    $('[name=Siret]').val(Siret)
}