var TableDataTables = function(){
    var handleAddressTable = function(){
        var manageAddressTable = $("#addresses_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageAddressTable.dataTable({
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
                    "page": "manage_addresses"
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
                'targets' : [0, -1]
            }],
        });
    }
    return {
        init : function(){
            handleAddressTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($addressID) {
    var url = '/control-panel/addresses/trash/' + $addressID;
    $("#deleteForm").attr('action', url);
}
