'use strict';

// Class definition
var KTDualListbox = function () {

    // Private functions
    var initDualListbox = function () {
        // Dual Listbox
        var listBoxes = $('.kt-dual-listbox');

        listBoxes.each(function () {
            var $this = $(this);
            // get titles
            var availableTitle = ($this.attr('data-available-title') != null) ? $this.attr('data-available-title') : 'Available options';
            var selectedTitle = ($this.attr('data-selected-title') != null) ? $this.attr('data-selected-title') : 'Selected options';

            // get button labels
            var addLabel = ($this.attr('data-add') != null) ? $this.attr('data-add') : 'Add';
            var removeLabel = ($this.attr('data-remove') != null) ? $this.attr('data-remove') : 'Remove';
            var addAllLabel = ($this.attr('data-add-all') != null) ? $this.attr('data-add-all') : 'Add All';
            var removeAllLabel = ($this.attr('data-remove-all') != null) ? $this.attr('data-remove-all') : 'Remove All';

            // get options
            var options = [];
            console.log($this.children('option'));
            $this.children('option').each(function () {
                var value = $(this).val();
                var label = $(this).text();
                var selected = !!($(this).is(':selected'));
                options.push({text: label, value: value, selected: selected});
            });


            // get search option
            var search = ($this.attr('data-search') != null) ? $this.attr('data-search') : '';

            // clear duplicates
            $this.empty();

            // init dual listbox
            var dualListBox = new DualListbox($this.get(0), {
                addEvent: function (value) {
                    $this.append(`<option value="${value}" selected>${value}</option>`);
                },
                removeEvent: function (value) {
                    $this.find(`[value=${value}]`).remove();
                },
                availableTitle: availableTitle,
                selectedTitle: selectedTitle,
                addButtonText: addLabel,
                removeButtonText: removeLabel,
                addAllButtonText: addAllLabel,
                removeAllButtonText: removeAllLabel,
                options: options,
            });

            for(var i = 0; i < options.length; i++){
                if(options[i].selected){
                    $this.append(`<option value="${options[i].value}" selected>${options[i].value}</option>`);
                }
            }

            if (search == 'false') {
                dualListBox.search.classList.add('dual-listbox__search--hidden');
            }
        });
    };

    return {
        // public functions
        init: function () {
            initDualListbox();
        },
    };
}();

KTUtil.ready(function () {
    KTDualListbox.init();
});
