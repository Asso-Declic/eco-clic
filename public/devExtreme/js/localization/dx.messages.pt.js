/*!
* DevExtreme (dx.messages.pt.js)
* Version: 19.2.3
* Build date: Tue Oct 22 2019
*
* Copyright (c) 2012 - 2019 Developer Express Inc. ALL RIGHTS RESERVED
* Read about DevExtreme licensing here: https://js.devexpress.com/Licensing/
*/
"use strict";

! function (root, factory) {
    if ("function" === typeof define && define.amd) {
        define(function (require) {
            factory(require("devextreme/localization"))
        })
    } else {
        if ("object" === typeof module && module.exports) {
            factory(require("devextreme/localization"))
        } else {
            factory(DevExpress.localization)
        }
    }
}(this, function (localization) {
    localization.loadMessages({
        pt: {
            Yes: "Sim",
            No: "N\xe3o",
            Cancel: "Cancelar",
            Clear: "Limpar",
            Done: "Conclu\xeddo",
            Loading: "Carregando ...",
            Select: "Selecione ...",
            Search: "Pesquisar ...",
            Back: "Voltar",
            OK: "OK",
            "dxCollectionWidget-noDataText": "Sem dados",
            "dxDropDownEditor-selectLabel": "Selecione",
            "validation-required": "Preenchimento obrigat\xf3rio",
            "validation-required-formatted": "{0} \xe9 de preenchimento obrigat\xf3rio",
            "validation-numeric": "Valor deve ser um n\xfamero",
            "validation-numeric-formatted": "{0} deve ser um n\xfamero",
            "validation-range": "Valor est\xe1 fora do intervalo",
            "validation-range-formatted": "{0} est\xe1 fora do intervalo",
            "validation-stringLength": "O comprimento do valor n\xe3o est\xe1 correto",
            "validation-stringLength-formatted": "O comprimento de {0} n\xe3o est\xe1 correto",
            "validation-custom": "Valor inv\xe1lido",
            "validation-custom-formatted": "{0} \xe9 inv\xe1lido",
            "validation-async": "Valor inv\xe1lido",
            "validation-async-formatted": "{0} \xe9 inv\xe1lido",
            "validation-compare": "Valores n\xe3o coincidem",
            "validation-compare-formatted": "{0} n\xe3o coincidem",
            "validation-pattern": "Valor n\xe3o corresponde ao padr\xe3o",
            "validation-pattern-formatted": "{0} n\xe3o corresponde ao padr\xe3o",
            "validation-email": "Email inv\xe1lido",
            "validation-email-formatted": "{0} \xe9 inv\xe1lido",
            "validation-mask": "Valor inv\xe1lido",
            "dxLookup-searchPlaceholder": "N\xfamero m\xednimo de caracteres: {0}",
            "dxList-pullingDownText": "Puxar para baixo para recarregar...",
            "dxList-pulledDownText": "Soltar para recarregar...",
            "dxList-refreshingText": "Recarregando ...",
            "dxList-pageLoadingText": "A carregar ...",
            "dxList-nextButtonText": "Mais",
            "dxList-selectAll": "Selecionar todos",
            "dxListEditDecorator-delete": "Eliminar",
            "dxListEditDecorator-more": "Mais",
            "dxScrollView-pullingDownText": "Puxar para baixo para recarregar...",
            "dxScrollView-pulledDownText": "Soltar para recarregar...",
            "dxScrollView-refreshingText": "Recarregando ...",
            "dxScrollView-reachBottomText": "A carregar ...",
            "dxDateBox-simulatedDataPickerTitleTime": "Selecionar hora",
            "dxDateBox-simulatedDataPickerTitleDate": "Selecionar data",
            "dxDateBox-simulatedDataPickerTitleDateTime": "Selecionar data e hora",
            "dxDateBox-validation-datetime": "Valor deve ser uma data ou hora",
            "dxFileUploader-selectFile": "Selecionar arquivo",
            "dxFileUploader-dropFile": "ou Soltar arquivo aqui",
            "dxFileUploader-bytes": "bytes",
            "dxFileUploader-kb": "kb",
            "dxFileUploader-Mb": "Mb",
            "dxFileUploader-Gb": "Gb",
            "dxFileUploader-upload": "Upload",
            "dxFileUploader-uploaded": "Upload conclu\xeddo",
            "dxFileUploader-readyToUpload": "Pronto para upload",
            "dxFileUploader-uploadFailedMessage": "Upload falhou",
            "dxFileUploader-invalidFileExtension": "Tipo de arquivo n\xe3o \xe9 permitido",
            "dxFileUploader-invalidMaxFileSize": "O arquivo \xe9 muito grande",
            "dxFileUploader-invalidMinFileSize": "O arquivo \xe9 muito pequeno",
            "dxRangeSlider-ariaFrom": "De {0}",
            "dxRangeSlider-ariaTill": "At\xe9 {0}",
            "dxSwitch-switchedOnText": "LIGADO",
            "dxSwitch-switchedOffText": "DESLIGADO",
            "dxForm-optionalMark": "opcional",
            "dxForm-requiredMessage": "{0} \xe9 de preenchimento obrigat\xf3rio",
            "dxNumberBox-invalidValueMessage": "Valor deve ser um n\xfamero",
            "dxDataGrid-columnChooserTitle": "Seletor de Colunas",
            "dxDataGrid-columnChooserEmptyText": "Arraste uma coluna para at\xe9 aqui para escond\xea-la",
            "dxDataGrid-groupContinuesMessage": "Continua na p\xe1gina seguinte",
            "dxDataGrid-groupContinuedMessage": "Continua\xe7\xe3o da p\xe1gina anterior",
            "dxDataGrid-groupHeaderText": "Agrupar pela coluna",
            "dxDataGrid-ungroupHeaderText": "Remover grupo",
            "dxDataGrid-ungroupAllText": "Remover todos os grupos",
            "dxDataGrid-editingEditRow": "Editar",
            "dxDataGrid-editingSaveRowChanges": "Salvar",
            "dxDataGrid-editingCancelRowChanges": "Cancelar",
            "dxDataGrid-editingDeleteRow": "Eliminar",
            "dxDataGrid-editingUndeleteRow": "Recuperar",
            "dxDataGrid-editingConfirmDeleteMessage": "Tem certeza que deseja eliminar este registro?",
            "dxDataGrid-validationCancelChanges": "Cancelar altera\xe7\xf5es",
            "dxDataGrid-groupPanelEmptyText": "Arrastar o cabe\xe7alho de uma coluna para aqui para agrupar por essa coluna",
            "dxDataGrid-noDataText": "Sem dados",
            "dxDataGrid-searchPanelPlaceholder": "Pesquisar ...",
            "dxDataGrid-filterRowShowAllText": "(Todos)",
            "dxDataGrid-filterRowResetOperationText": "Limpar",
            "dxDataGrid-filterRowOperationEquals": "Igual",
            "dxDataGrid-filterRowOperationNotEquals": "Diferente",
            "dxDataGrid-filterRowOperationLess": "Menor que",
            "dxDataGrid-filterRowOperationLessOrEquals": "Menor que ou igual a",
            "dxDataGrid-filterRowOperationGreater": "Maior que",
            "dxDataGrid-filterRowOperationGreaterOrEquals": "Maior que ou igual a",
            "dxDataGrid-filterRowOperationStartsWith": "Come\xe7a com",
            "dxDataGrid-filterRowOperationContains": "Cont\xe9m",
            "dxDataGrid-filterRowOperationNotContains": "N\xe3o cont\xe9m",
            "dxDataGrid-filterRowOperationEndsWith": "Termina com",
            "dxDataGrid-filterRowOperationBetween": "Entre",
            "dxDataGrid-filterRowOperationBetweenStartText": "In\xedcio",
            "dxDataGrid-filterRowOperationBetweenEndText": "Fim",
            "dxDataGrid-applyFilterText": "Aplicar filtro",
            "dxDataGrid-trueText": "verdadeiro",
            "dxDataGrid-falseText": "falso",
            "dxDataGrid-sortingAscendingText": "Ordenar ascendentemente",
            "dxDataGrid-sortingDescendingText": "Ordenar descendentemente",
            "dxDataGrid-sortingClearText": "Limpar ordena\xe7\xe3o",
            "dxDataGrid-editingSaveAllChanges": "Salvar todas as altera\xe7\xf5es",
            "dxDataGrid-editingCancelAllChanges": "Descartar altera\xe7\xf5es",
            "dxDataGrid-editingAddRow": "Adicionar uma linha",
            "dxDataGrid-summaryMin": "M\xedn: {0}",
            "dxDataGrid-summaryMinOtherColumn": "M\xedn de {1} \xe9 {0}",
            "dxDataGrid-summaryMax": "M\xe1x: {0}",
            "dxDataGrid-summaryMaxOtherColumn": "M\xe1x de {1} \xe9 {0}",
            "dxDataGrid-summaryAvg": "M\xe9d: {0}",
            "dxDataGrid-summaryAvgOtherColumn": "M\xe9dia de {1} \xe9 {0}",
            "dxDataGrid-summarySum": "Soma: {0}",
            "dxDataGrid-summarySumOtherColumn": "Soma de {1} \xe9 {0}",
            "dxDataGrid-summaryCount": "Contagem: {0}",
            "dxDataGrid-columnFixingFix": "Fixar",
            "dxDataGrid-columnFixingUnfix": "N\xe3o fixar",
            "dxDataGrid-columnFixingLeftPosition": "\xc0 esquerda",
            "dxDataGrid-columnFixingRightPosition": "\xc0 direita",
            "dxDataGrid-exportTo": "Exportar para",
            "dxDataGrid-exportToExcel": "Exportar para Excel",
            "dxDataGrid-excelFormat": "Planilha Excel",
            "dxDataGrid-exportAll": "Exportar todos os dados",
            "dxDataGrid-exportSelectedRows": "Exportar linhas selecionadas",
            "dxDataGrid-selectedRows": "Linhas selecionadas",
            "dxDataGrid-headerFilterEmptyValue": "(Vazio)",
            "dxDataGrid-headerFilterOK": "OK",
            "dxDataGrid-headerFilterCancel": "Cancelar",
            "dxDataGrid-ariaColumn": "Coluna",
            "dxDataGrid-ariaValue": "Valor",
            "dxDataGrid-ariaFilterCell": "Filtro de c\xe9lula",
            "dxDataGrid-ariaCollapse": "Contrair",
            "dxDataGrid-ariaExpand": "Expandir",
            "dxDataGrid-ariaDataGrid": "Grelha de dados",
            "dxDataGrid-ariaSearchInGrid": "Pesquisar na grade de dados",
            "dxDataGrid-ariaSelectAll": "Selecionar todos",
            "dxDataGrid-ariaSelectRow": "Selecionar linha",
            "dxDataGrid-filterBuilderPopupTitle": "Construtor de filtro",
            "dxDataGrid-filterPanelCreateFilter": "Criar filtro",
            "dxDataGrid-filterPanelClearFilter": "Limpar",
            "dxDataGrid-filterPanelFilterEnabledHint": "Habilitar o filtro",
            "dxTreeList-ariaTreeList": "Lista em \xe1rvore",
            "dxTreeList-editingAddRowToNode": "Adicionar",
            "dxPager-infoText": "P\xe1gina {0} de {1} ({2} itens)",
            "dxPager-pagesCountText": "de",
            "dxPivotGrid-grandTotal": "Grande Total",
            "dxPivotGrid-total": "{0} Total",
            "dxPivotGrid-fieldChooserTitle": "Seletor de Colunas",
            "dxPivotGrid-showFieldChooser": "Mostrar Seletor de Colunas",
            "dxPivotGrid-expandAll": "Expandir Tudo",
            "dxPivotGrid-collapseAll": "Contrair Tudo",
            "dxPivotGrid-sortColumnBySummary": 'Ordenar "{0}" por esta Coluna',
            "dxPivotGrid-sortRowBySummary": 'Ordenar "{0}" por esta Linha',
            "dxPivotGrid-removeAllSorting": "Remover Todas as Ordena\xe7\xf5es",
            "dxPivotGrid-dataNotAvailable": "N/A",
            "dxPivotGrid-rowFields": "Campos de Linha",
            "dxPivotGrid-columnFields": "Campos de Coluna",
            "dxPivotGrid-dataFields": "Campos de Dados",
            "dxPivotGrid-filterFields": "Campos de Filtro",
            "dxPivotGrid-allFields": "Todos os Campos",
            "dxPivotGrid-columnFieldArea": "Arraste os campos de coluna at\xe9 aqui",
            "dxPivotGrid-dataFieldArea": "Arraste os campos de dados at\xe9 aqui",
            "dxPivotGrid-rowFieldArea": "Arraste os campos de linha at\xe9 aqui",
            "dxPivotGrid-filterFieldArea": "Arraste os campos de filtro at\xe9 aqui",
            "dxScheduler-editorLabelTitle": "Assunto",
            "dxScheduler-editorLabelStartDate": "Data de In\xedcio",
            "dxScheduler-editorLabelEndDate": "Data Final",
            "dxScheduler-editorLabelDescription": "Descri\xe7\xe3o",
            "dxScheduler-editorLabelRecurrence": "Repetir",
            "dxScheduler-openAppointment": "Abrir compromisso",
            "dxScheduler-recurrenceNever": "Nunca",
            "dxScheduler-recurrenceDaily": "Diariamente",
            "dxScheduler-recurrenceWeekly": "Semanalmente",
            "dxScheduler-recurrenceMonthly": "Mensalmente",
            "dxScheduler-recurrenceYearly": "Anualmente",
            "dxScheduler-recurrenceRepeatEvery": "Todos",
            "dxScheduler-recurrenceRepeatOn": "Repeat On",
            "dxScheduler-recurrenceEnd": "Fim da repeti\xe7\xe3o",
            "dxScheduler-recurrenceAfter": "Depois de",
            "dxScheduler-recurrenceOn": "A",
            "dxScheduler-recurrenceRepeatDaily": "dia(s)",
            "dxScheduler-recurrenceRepeatWeekly": "semana(s)",
            "dxScheduler-recurrenceRepeatMonthly": "m\xeas(es)",
            "dxScheduler-recurrenceRepeatYearly": "ano(s)",
            "dxScheduler-switcherDay": "Dia",
            "dxScheduler-switcherWeek": "Semana",
            "dxScheduler-switcherWorkWeek": "Dias \xfateis",
            "dxScheduler-switcherMonth": "M\xeas",
            "dxScheduler-switcherTimelineDay": "Linha de tempo Dia",
            "dxScheduler-switcherTimelineWeek": "Linha de tempo Semana",
            "dxScheduler-switcherTimelineWorkWeek": "Linha de tempo Dias \xfateis",
            "dxScheduler-switcherTimelineMonth": "Linha de tempo M\xeas",
            "dxScheduler-switcherAgenda": "Agenda",
            "dxScheduler-recurrenceRepeatOnDate": "na data",
            "dxScheduler-recurrenceRepeatCount": "ocorr\xeancia(s)",
            "dxScheduler-allDay": "Todo o dia",
            "dxScheduler-confirmRecurrenceEditMessage": "Deseja editar s\xf3 este compromisso ou a s\xe9rie toda?",
            "dxScheduler-confirmRecurrenceDeleteMessage": "Deseja eliminar s\xf3 este compromisso ou a s\xe9rie toda?",
            "dxScheduler-confirmRecurrenceEditSeries": "Editar s\xe9rie",
            "dxScheduler-confirmRecurrenceDeleteSeries": "Eliminar s\xe9rie",
            "dxScheduler-confirmRecurrenceEditOccurrence": "Editar compromisso",
            "dxScheduler-confirmRecurrenceDeleteOccurrence": "Eliminar compromisso",
            "dxScheduler-noTimezoneTitle": "Sem fuso hor\xe1rio",
            "dxScheduler-moreAppointments": "{0} mais",
            "dxCalendar-todayButtonText": "Hoje",
            "dxCalendar-ariaWidgetName": "Calend\xe1rio",
            "dxColorView-ariaRed": "Vermelho",
            "dxColorView-ariaGreen": "Verde",
            "dxColorView-ariaBlue": "Azul",
            "dxColorView-ariaAlpha": "Transpar\xeancia",
            "dxColorView-ariaHex": "C\xf3digo de cor",
            "dxTagBox-selected": "{0} selecionados",
            "dxTagBox-allSelected": "Todos selecionados ({0})",
            "dxTagBox-moreSelected": "{0} mais",
            "vizExport-printingButtonText": "Imprimir",
            "vizExport-titleMenuText": "Exportar/Imprimir",
            "vizExport-exportButtonText": "{0}-Arquivo",
            "dxFilterBuilder-and": "E",
            "dxFilterBuilder-or": "OU",
            "dxFilterBuilder-notAnd": "N\xc3O E",
            "dxFilterBuilder-notOr": "N\xc3O OU",
            "dxFilterBuilder-addCondition": "Adicionar condi\xe7\xe3o",
            "dxFilterBuilder-addGroup": "Adicionar Grupo",
            "dxFilterBuilder-enterValueText": "<preencha com um valor>",
            "dxFilterBuilder-filterOperationEquals": "Igual",
            "dxFilterBuilder-filterOperationNotEquals": "Diferente",
            "dxFilterBuilder-filterOperationLess": "Menor que",
            "dxFilterBuilder-filterOperationLessOrEquals": "Menor ou igual que",
            "dxFilterBuilder-filterOperationGreater": "Maior que",
            "dxFilterBuilder-filterOperationGreaterOrEquals": "Maior ou igual que",
            "dxFilterBuilder-filterOperationStartsWith": "Come\xe7a com",
            "dxFilterBuilder-filterOperationContains": "Cont\xe9m",
            "dxFilterBuilder-filterOperationNotContains": "N\xe3o cont\xe9m",
            "dxFilterBuilder-filterOperationEndsWith": "Termina com",
            "dxFilterBuilder-filterOperationIsBlank": "\xc9 vazio",
            "dxFilterBuilder-filterOperationIsNotBlank": "N\xe3o \xe9 vazio",
            "dxFilterBuilder-filterOperationBetween": "Entre",
            "dxFilterBuilder-filterOperationAnyOf": "Algum de",
            "dxFilterBuilder-filterOperationNoneOf": "Nenhum de",
            "dxHtmlEditor-dialogColorCaption": "Alterar cor da fonte",
            "dxHtmlEditor-dialogBackgroundCaption": "Alterar cor de plano de fundo",
            "dxHtmlEditor-dialogLinkCaption": "Adicionar link",
            "dxHtmlEditor-dialogLinkUrlField": "URL",
            "dxHtmlEditor-dialogLinkTextField": "Texto",
            "dxHtmlEditor-dialogLinkTargetField": "Abrir link em nova janela",
            "dxHtmlEditor-dialogImageCaption": "Adicionar imagem",
            "dxHtmlEditor-dialogImageUrlField": "URL",
            "dxHtmlEditor-dialogImageAltField": "Texto alternativo",
            "dxHtmlEditor-dialogImageWidthField": "Largura (px)",
            "dxHtmlEditor-dialogImageHeightField": "Altura (px)",
            "dxHtmlEditor-heading": "Cabe\xe7alho",
            "dxHtmlEditor-normalText": "Texto normal",
            "dxFileManager-newFolderName": "TODO",
            "dxFileManager-rootFolderName": "TODO",
            "dxFileManager-errorNoAccess": "TODO",
            "dxFileManager-errorDirectoryExistsFormat": "TODO",
            "dxFileManager-errorFileExistsFormat": "TODO",
            "dxFileManager-errorFileNotFoundFormat": "TODO",
            "dxFileManager-errorDirectoryNotFoundFormat": "TODO",
            "dxFileManager-errorWrongFileExtension": "TODO",
            "dxFileManager-errorMaxFileSizeExceeded": "TODO",
            "dxFileManager-errorDefault": "TODO",
            "dxDiagram-categoryGeneral": "TODO",
            "dxDiagram-categoryFlowchart": "TODO",
            "dxDiagram-categoryOrgChart": "TODO",
            "dxDiagram-categoryContainers": "TODO",
            "dxDiagram-categoryCustom": "TODO",
            "dxDiagram-commandProperties": "TODO",
            "dxDiagram-commandExport": "TODO",
            "dxDiagram-commandExportToSvg": "TODO",
            "dxDiagram-commandExportToPng": "TODO",
            "dxDiagram-commandExportToJpg": "TODO",
            "dxDiagram-commandUndo": "TODO",
            "dxDiagram-commandRedo": "TODO",
            "dxDiagram-commandFontName": "TODO",
            "dxDiagram-commandFontSize": "TODO",
            "dxDiagram-commandBold": "TODO",
            "dxDiagram-commandItalic": "TODO",
            "dxDiagram-commandUnderline": "TODO",
            "dxDiagram-commandTextColor": "TODO",
            "dxDiagram-commandLineColor": "TODO",
            "dxDiagram-commandFillColor": "TODO",
            "dxDiagram-commandAlignLeft": "TODO",
            "dxDiagram-commandAlignCenter": "TODO",
            "dxDiagram-commandAlignRight": "TODO",
            "dxDiagram-commandConnectorLineType": "TODO",
            "dxDiagram-commandConnectorLineStraight": "TODO",
            "dxDiagram-commandConnectorLineOrthogonal": "TODO",
            "dxDiagram-commandConnectorLineStart": "TODO",
            "dxDiagram-commandConnectorLineEnd": "TODO",
            "dxDiagram-commandConnectorLineNone": "TODO",
            "dxDiagram-commandConnectorLineArrow": "TODO",
            "dxDiagram-commandAutoLayout": "TODO",
            "dxDiagram-commandAutoLayoutTree": "TODO",
            "dxDiagram-commandAutoLayoutLayered": "TODO",
            "dxDiagram-commandAutoLayoutHorizontal": "TODO",
            "dxDiagram-commandAutoLayoutVertical": "TODO",
            "dxDiagram-commandFullscreen": "TODO",
            "dxDiagram-commandUnits": "TODO",
            "dxDiagram-commandPageSize": "TODO",
            "dxDiagram-commandPageOrientation": "TODO",
            "dxDiagram-commandPageOrientationLandscape": "TODO",
            "dxDiagram-commandPageOrientationPortrait": "TODO",
            "dxDiagram-commandPageColor": "TODO",
            "dxDiagram-commandShowGrid": "TODO",
            "dxDiagram-commandSnapToGrid": "TODO",
            "dxDiagram-commandGridSize": "TODO",
            "dxDiagram-commandZoomLevel": "TODO",
            "dxDiagram-commandAutoZoom": "TODO",
            "dxDiagram-commandSimpleView": "TODO",
            "dxDiagram-commandCut": "TODO",
            "dxDiagram-commandCopy": "TODO",
            "dxDiagram-commandPaste": "TODO",
            "dxDiagram-commandSelectAll": "TODO",
            "dxDiagram-commandDelete": "TODO",
            "dxDiagram-commandBringToFront": "TODO",
            "dxDiagram-commandSendToBack": "TODO",
            "dxDiagram-commandLock": "TODO",
            "dxDiagram-commandUnlock": "TODO",
            "dxDiagram-commandInsertShapeImage": "TODO",
            "dxDiagram-commandEditShapeImage": "TODO",
            "dxDiagram-commandDeleteShapeImage": "TODO",
            "dxDiagram-unitIn": "TODO",
            "dxDiagram-unitCm": "TODO",
            "dxDiagram-unitPx": "TODO",
            "dxDiagram-dialogButtonOK": "TODO",
            "dxDiagram-dialogButtonCancel": "TODO",
            "dxDiagram-dialogInsertShapeImageTitle": "TODO",
            "dxDiagram-dialogEditShapeImageTitle": "TODO",
            "dxDiagram-dialogEditShapeImageSelectButton": "TODO",
            "dxDiagram-dialogEditShapeImageLabelText": "TODO"
        }
    })
});
