var TableDataTables = function(){
    var handleEnquiryTable = function(){
        var manageEnquiryTable = $("#enquiries_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageEnquiryTable.dataTable({
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
                    "page": "manage_enquiries"
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
                'targets' : [0, 4, -1]
            }],
        });
    }
    return {
        init : function(){
            handleEnquiryTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($achieverID) {
    var url = '/control-panel/enquiries/trash/' + $achieverID;
    $("#deleteForm").attr('action', url);
}


