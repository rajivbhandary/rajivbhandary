var TableDataTables = function(){
    var handleTestimonialTable = function(){
        var manageTestimonialTable = $("#trashed_testimonials_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageTestimonialTable.dataTable({
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
                    "page": "manage_trashed_testimonials"
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
                'targets' : [0, 1, -1]
            }],
        });

    }
    return {
        init : function(){
            handleTestimonialTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($testimonialID) {
    var url = '/control-panel/testimonials/' + $testimonialID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/testimonials/restore/' + id;
    $("#restoreForm").attr('action', url);
}
