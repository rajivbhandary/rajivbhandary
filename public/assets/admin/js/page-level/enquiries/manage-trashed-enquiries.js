var TableDataTables = function(){
    var handleEnquiryTable = function(){
        var manageEnquiryTable = $("#trashed_enquiries_datatable");
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
                    "page": "manage_trashed_enquiries"
                }
            },
            "lengthMenu" : [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "order" : [
                [2, "ASC"]
            ],
            "columnDefs":[{
                'orderable' : false,
                'targets' : [0, -1]
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


function displayDeleteModalForm($enquiryID) {
    var url = '/control-panel/enquiries/' + $enquiryID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/enquiries/restore/' + id;
    $("#restoreForm").attr('action', url);
}
