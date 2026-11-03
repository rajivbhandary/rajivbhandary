var TableDataTables = function(){
    var handlePropertyTable = function(){
        var managePropertyTable = $("#properties_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = managePropertyTable.dataTable({
            "processing" : true,
            "serverSide" : true,
            "paging": true,
            "scrollX": false,
            "ajax" : {
                url : baseURL + filePath,
                method : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    "page": "manage_properties"
                }
            },
            "lengthMenu" : [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "order" : [
                [1, "ASC"]
            ],
            "columnDefs":[{
                'orderable' : false,
                'targets' : [0, 1, 2, 3, 6, -1]
            }],
        });
    }
    return {
        init : function(){
            handlePropertyTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($propertyID) {
    var url = '/control-panel/properties/trash/' + $propertyID;
    $("#deleteForm").attr('action', url);
}
