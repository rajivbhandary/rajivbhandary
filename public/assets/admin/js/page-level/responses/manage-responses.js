var TableDataTables = function(){
    var handleResponseTable = function(){
        var manageResponseTable = $("#responses_datatable");
        manageResponseTable.dataTable({
            responsive: true,
            columnDefs: [
                {
                    targets:  -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `<div class="d-flex align-items-center justify-content-center">
                        <a href="/control-panel/forms/responses/${full[1]}" class='btn btn-label btn-label-brand btn-sm btn-bold m-1'>
                            <i class='kt-menu__link-icon la la-eye'></i> View
                        </a>
                        </div>`;
                    },
                },
            ],
        });
    }
    return {
        init : function(){
            handleResponseTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})
