$(function() {
    var cache = {};

    $(document).on('click', '.carfax_highlights', function() {
        var $modal = $('#vehicle_report_modal'),
            $loader = $modal.find('.loader'),
            $modalContent = $modal
                .find('.modal-body')
                .find('.content'),
            $this = $(this),
            vehicleId = $this.data('id');

        // set modal title
        $modal.find('.modal-title').text($this.closest('.vehicle-wrapper').find('.vehicle-title').text());
        $modalContent.empty();
        $modal.modal('show');

        if (typeof cache[vehicleId] !== 'undefined') {
            $modalContent.html(cache[vehicleId]);
        } else {
            $loader.show();
            
            $.ajax({
                url: '/ajax/plain',
                dataType: 'html',
                type: 'get',
                data: {
                    oper: 'load_vehicle_carfax_report',
                    report_template: 'responsive',
                    vehicle_id: vehicleId
                },
                success: function (data) {
                    cache[vehicleId] = data;
                    $loader.hide();
                    $modalContent.html(data);
                }
            });
        }

        return false;
    });
});