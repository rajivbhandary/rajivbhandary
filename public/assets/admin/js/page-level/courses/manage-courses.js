var TableDataTables = function(){
    var handleCourseTable = function(){
        var manageCourseTable = $("#courses_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageCourseTable.dataTable({
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
                    "page": "manage_courses"
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
                'targets' : [0, 1, 6, -1]
            }],
        });
    }
    return {
        init : function(){
            handleCourseTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($courseID) {
    var url = '/control-panel/courses/trash/' + $courseID;
    $("#deleteForm").attr('action', url);
}

function displayVisibilityModalForm($blogID) {
    var url = '/control-panel/courses/visible/' + $blogID;
    $("#visibleForm").attr('action', url);
}

function displayInvisibilityModalForm($blogID) {
    var url = '/control-panel/courses/invisible/' + $blogID;
    $("#invisibleForm").attr('action', url);
}


