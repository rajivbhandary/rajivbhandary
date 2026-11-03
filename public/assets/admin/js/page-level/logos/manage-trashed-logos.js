var TableDataTables = function(){
    var handleLogoTable = function(){
        var manageLogoTable = $("#trashed_logos_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageLogoTable.dataTable({
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
                    "page": "manage_trashed_logos"
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
                'targets' : [0, 1, -1]
            }],
        });

    }
    return {
        init : function(){
            handleLogoTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($logoID) {
    var url = '/control-panel/logos/' + $logoID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/logos/restore/' + id;
    $("#restoreForm").attr('action', url);
}
