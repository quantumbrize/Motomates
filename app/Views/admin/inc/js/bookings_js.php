<script>
    $(document).ready(function () {
        load_all_bookings();
    })
    function load_all_bookings() {
    $.ajax({
        url: "<?= base_url('/api/all/booking') ?>",
        type: "GET",
        beforeSend: function () {
            $('#table-banner-list-all-body').html(`<tr>
                    <td colspan="8" style="text-align:center;">
                        <div class="spinner-border" role="status"></div>
                    </td>
                </tr>`);
        },
        success: function (resp) {
            if (resp.status) {
                if (resp.data.length > 0) {
                    let html = ``;

                    $.each(resp.data, function (index, booking) {
                        console.log('bookings', booking);

                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${booking.fname}</td>
                                    <td>${booking.phone}</td>
                                    <td>${booking.society}</td>
                                    <td>${booking.pickup_date}</td>
                                    <td>${booking.return_date}</td>
                                    <td>${booking.pickup_time}</td>
                                    <td>${booking.return_time}</td>
                                    <td>${booking.service_type}</td>
                                    <td>${booking.cab_type}</td>
                                    `;
                        
                    });

                    // Append the rows to the table
                    $('#bookings_data_table_body').html(html);

                    // Reinitialize DataTable if needed
                    
                } else {
                    $('#bookings_data_table').html(`<tr>
                        <td colspan="8" style="text-align:center;">
                            No Data Found
                        </td>
                    </tr>`);
                }
            } else {
                $('#bookings_data_table').html(`<tr>
                    <td colspan="8" style="text-align:center;">
                        ${resp.message}
                    </td>
                </tr>`);
            }
        },
        error: function (err) {
            console.log(err);
            $('#table-banner-list-all-body').html(`<tr>
                <td colspan="8" style="text-align:center;">
                    Error loading data.
                </td>
            </tr>`);
        },
        complete: function () {
            // Optional: Any additional steps after the request is complete.
        }
    });
}
</script>