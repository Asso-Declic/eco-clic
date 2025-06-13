// $(function() {

//     var modifiable = false;
//     $.ajax({
//         url: '../AjaxLoader/checkModifiable.php',
//         type: 'get',
//         async: false,
//         dataType: 'json',
//         success: function(response) {
//             (response == 1) ? modifiable = true: modifiable = false;
//         },
//         error: function(jqXhr, textStatus, errorThrown) {
//             console.error('Une erreur est survenue');
//         }
//     })

//     var makeAsyncDataSource = function() {
//         return new DevExpress.data.CustomStore({
//             loadMode: "raw",
//             key: "ThemeId",
//             load: function() {
//                 return $.getJSON(`../AjaxLoader/GetCategoriesByThemeId.php?id=${getUrlParam("id")}`);
//             }
//         });
//     }

//     $("#gridContainer").dxDataGrid({
//         dataSource: makeAsyncDataSource(),
//         keyExpr: "Id",
//         columnHidingEnabled: true,
//         showBorders: true,
//         rowAlternationEnabled: true,
//         loadPanel: {
//             text: "Chargement"
//         },
//         columns: [{
//             caption: "Nom",
//             dataField: "Nom",
//         }, {
//             caption: "Description",
//             dataField: "Description",
//             width: 650
//         }, {
//             caption: "Temps de réponse",
//             dataField: "TempsDeReponse",
//             width: 200
//         }, {
//             cellTemplate: function(container, options) {
//                 if (modifiable) {
//                     $("<div>")
//                         .append($(`<a href='./questions.php?id=${options.data.Id}' class='fas fa-pen vertNumeriscore'></a>`))
//                         .appendTo(container);
//                 } else {
//                     $("<div>")
//                         .append($(`<a href='./questions.php?id=${options.data.Id}' class='fas fa-eye vertNumeriscore'></a>`))
//                         .appendTo(container);
//                 }
//             },
//             width: 40,
//             cssClass: "align-middle"

//         }, {
//             cellTemplate: function(container, options) {
//                 if (modifiable == true) {
//                     var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
//                     $("<div>")
//                         .append($("<a href='#' onclick='modaleDelete(\`" + str + "\`)' class='fas fa-trash-alt vertNumeriscore'></a>"))
//                         .appendTo(container);
//                 }
//             },
//             width: 40,
//             cssClass: "align-middle"
//         }]
//     });

//     (!modifiable) ? $("#add").prop("disabled", true): $("#add").prop("disabled", false);


//     var form = $("#formulaire").dxForm({
//         formData: formulaire(getUrlParam('id')),
//         readOnly: false,
//         showColonAfterLabel: true,
//         labelLocation: "top",
//         items: [{
//             dataField: "Id",
//             disabled: true,
//             cssClass: "d-none"
//         }, {
//             colCount: 2,
//             itemType: "group",
//             items: [{
//                 dataField: "Nom",
//                 label: {
//                     text: "Nom "
//                 },
//                 validationRules: [{
//                     type: "required",
//                     message: "Nom ne peut pas être vide."
//                 }]
//             }, {
//                 dataField: "Couleur",
//                 label: {
//                     text: "Couleur "
//                 },
//                 editorType: "dxColorBox",
//                 disabled: modifiable ? false : true,
//                 validationRules: [{
//                     type: "required",
//                     message: "Couleur ne peut pas être vide."
//                 }]
//             }, {
//                 colCount: 1,
//                 itemType: "group",
//                 items: [{
//                     dataField: "Icone",
//                     template: function(data, itemElement) {
//                         var name;
//                         itemElement.append(`<img id='IconeCat' src='../img/icons/iconesNoir/${data.editorOptions.value}.svg' style='width: 20px;max-height: 20px;'>`)
//                         itemElement.append($("<div>").attr("id", "dfilefu1").dxFileUploader({
//                             multiple: false,
//                             accept: "image/svg+xml",
//                             name: 'Icone',
//                             disabled: modifiable ? false : true,
//                             uploadMode: "instantly",
//                             uploadUrl: "../AjaxLoader/uploadTempFile.php",
//                             invalidFileExtensionMessage: "Le type de fichier est invalide",
//                             labelText: "",
//                             selectButtonText: "Sélectionner un fichier",
//                             onValueChanged: function(e) {
//                                 var files = e.value;
//                                 if (files.length > 0) {
//                                     $.each(files, function(i, file) {
//                                         name = file.name.replace(".svg", "")
//                                     });
//                                 }
//                             },
//                             onFilesUploaded: function(e) {
//                                 if (name != null && name != "") {
//                                     $("#IconeCat").attr("src", `../temp/${name}.svg`)
//                                 }
//                             }
//                         }));
//                     },
//                     name: "Icone",
//                     label: {
//                         text: "Icône "
//                     },
//                     validationRules: [{
//                         type: "custom",
//                         message: "Type de fichier invalide.",
//                         validationCallback: function(e) {
//                             if (e.value[0].type === "image/svg+xml") {
//                                 return true
//                             }
//                             return false
//                         }
//                     }]
//                 }]
//             }],
//         }, {
//             itemType: "button",
//             cssClass: "mt-4",
//             horizontalAlignment: "center",
//             buttonOptions: {
//                 text: "Valider",
//                 type: "default",
//                 useSubmitBehavior: true
//             }
//         }],
//         minColWidth: 300,

//     }).dxForm("instance");

//     $("#form-container").on("submit", function(e) {
//         $("[disabled]").prop("disabled", false)
//     });

//     $("#add").on("click", function() {
//         $('#modale').modal('show')
//     })

//     var formModale = $("#form-modale").dxForm({
//         formData: { Id: "", Nom: "", Description: "", ThemeId: getUrlParam('id') },
//         readOnly: false,
//         showColonAfterLabel: true,
//         labelLocation: "top",
//         items: [{
//             colCount: 2,
//             itemType: "group",
//             items: [{
//                 dataField: "Nom",
//                 label: {
//                     text: "Nom "
//                 },
//                 validationRules: [{
//                     type: "required",
//                     message: "Nom ne peut pas être vide."
//                 }]
//             }, {
//                 dataField: "Description",
//                 label: {
//                     text: "Description "
//                 },
//             }, {
//                 dataField: "TempsDeReponse",
//                 label: {
//                     text: "Temps de réponse "
//                 },
//                 validationRules: [{
//                     type: "pattern",
//                     pattern: /^(?=.*[0-9])/,
//                     message: "Merci d'insérer uniquement des nombres"
//                 }]
//             }, {
//                 dataField: "ThemeId",
//                 cssClass: "d-none"
//             }],
//         }, {
//             dataField: "Visibilite",
//             label: {
//                 text: "Visibilité "
//             },
//             template: function(data, itemElement) {
//                 itemElement.dxTreeList({
//                     dataSource: "../AjaxLoader/GetRefTypeCol.php",
//                     keyExpr: 'Id',
//                     columnAutoWidth: true,
//                     wordWrapEnabled: true,
//                     showBorders: true,
//                     selection: {
//                         mode: 'multiple',
//                     },
//                     columns: [{
//                         dataField: 'Nom',
//                     }],
//                     onSelectionChanged() {
//                         const selectedData = this.getSelectedRowsData("all");
//                         var data
//                         data = JSON.stringify(selectedData)
//                         $("[name=Visibilite]").val(data)
//                     },
//                 })
//                 itemElement.append("<input name='Visibilite' hidden>")
//             }
//         }, {
//             itemType: "button",
//             cssClass: "mt-4",
//             horizontalAlignment: "center",
//             buttonOptions: {
//                 text: "Valider",
//                 type: "default",
//                 useSubmitBehavior: true
//             }
//         }],
//         minColWidth: 300,

//     }).dxForm("instance");
// });

// function formulaire(themeId) {
//     var theme;
//     $.ajax({
//         url: `../AjaxLoader/GetThemesById.php`,
//         type: 'get',
//         async: false,
//         dataType: 'json',
//         data: { id: themeId },
//         success: function(data) {
//             theme = data;
//         },
//         error: function(jqXhr, textStatus, errorThrown) {
//             console.error('Une erreur est survenue');
//         }
//     });
//     return theme;
// }

// function modaleDelete(data) {
//     data = JSON.parse(data.replaceAll('@|%', "'"));
//     const popup = $("#confirm").dxPopup({
//         contentTemplate: `<p>Voulez vraiment supprimer <b>${data.Nom}</b> ainsi que tout les éléments qui y sont liés ?</p>`,
//         width: 300,
//         height: 170,
//         showTitle: false,
//         visible: false,
//         dragEnabled: false,
//         shading: false,
//         closeOnOutsideClick: true,
//         showCloseButton: false,
//         toolbarItems: [{
//             widget: "dxButton",
//             toolbar: "bottom",
//             location: "before",
//             options: {
//                 text: "Annuler",
//                 onClick: function(e) {
//                     popup.hide();
//                 },
//             }
//         }, {
//             widget: "dxButton",
//             toolbar: "bottom",
//             location: "after",
//             options: {
//                 text: "Valider",
//                 type: "default",
//                 onClick: function(e) {
//                     $.ajax({
//                         url: '../AjaxLoader/suppressionAdmin.php',
//                         type: 'get',
//                         async: true,
//                         dataType: 'html',
//                         data: {
//                             CategorieId: data.Id,
//                             type: "Categorie"
//                         },
//                         success: function(response) {
//                             if (response == 1) {
//                                 DevExpress.ui.notify(`${data.Nom} à été supprimé`, "success", 2000);
//                             } else {
//                                 DevExpress.ui.notify(`Une erreur est survenue`, "error", 2000);
//                             }
//                             $("#gridContainer").dxDataGrid('refresh')
//                         },
//                         error: function(jqXhr, textStatus, errorThrown) {
//                             console.error('Une erreur est survenue');
//                         }
//                     })
//                     popup.hide();
//                 }
//             }
//         }]
//     }).dxPopup("instance");
//     popup.show();
// }