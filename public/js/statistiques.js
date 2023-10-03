$(function() {
    var dxChartData;
    $.ajax({
        url: "/api/scores/list",
        method: "GET",
        async: false,
        dataType: "json",
    })
    .done(function(response) {
        dxChartData = response;
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        //alert("erreur");
    });

    var chart = $("#chart").dxChart({
        palette: "Harmony Light",
        dataSource: dxChartData,
        tooltip: {
            enabled: true
        },
        commonSeriesSettings: {
            argumentField: "Date",
            valueField: "Score"
        },
        seriesTemplate: {
            nameField: "Theme",
            customizeSeries: function(valueFromNameField) {
                var Color;
                for (let i = 0; i < dxChartData.length; i++) {
                    if (dxChartData[i].Theme == valueFromNameField) {
                        Color = dxChartData[i].Color;
                        break;
                    }
                }
                return valueFromNameField == valueFromNameField ? { color: Color, visible: false } : {};
            }
        },
        margin: {
            bottom: 20
        },
        argumentAxis: {
            valueMarginsEnabled: false
        },
        "export": {
            enabled: false
        },
        legend: {
            verticalAlignment: "bottom",
            horizontalAlignment: "center"
        }
    }).dxChart("instance");


    var treeViewCount = 0;
    var treeView = $("#treeview").dxTreeView({
        dataSource: "",
        dataStructure: "plain",
        width: 340,
        height: 320,
        showCheckBoxesMode: "selectAll",
        keyExpr: "Id",
        selectionMode: "multiple",
        displayExpr: "Nom",
        selectAllText: 'Toutes les thématiques',
        selectByClick: true,
        onSelectionChanged: function(e) {
            var series = $("#chart").dxChart('getAllSeries');
            for (let i = 0; i < series.length; i++) {
                var s = series[i]
                s.hide();
            }
            const selectedNodes = e.component.getSelectedNodes();
            for (let i = 0; i < selectedNodes.length; i++) {
                var serie = chart.getSeriesByName(selectedNodes[i].text)
                serie != null ? serie.show() : {};
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