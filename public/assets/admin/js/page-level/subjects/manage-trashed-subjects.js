var TableDataTables = function(){
    var handleSubjectTable = function(){
        var manageSubjectTable = $("#trashed_subjects_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageSubjectTable.dataTable({
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
                    "page": "manage_trashed_subjects"
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
            handleSubjectTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($subjectID) {
    var url = '/control-panel/subjects/' + $subjectID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/subjects/restore/' + id;
    $("#restoreForm").attr('action', url);
}
