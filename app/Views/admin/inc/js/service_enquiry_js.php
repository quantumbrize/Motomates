<script>
    $(document).ready(function () {
        load_all_service_enquiry();
    })
    function load_all_service_enquiry() {
    $.ajax({
        url: "<?= base_url('/api/all/service_enquiry') ?>",
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

                    $.each(resp.data, function (index, enquiry) {
                        console.log('serviceenquiry', enquiry);

                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${enquiry.enquiry_name}</td>
                                    <td>${enquiry.enquiry_email}</td>
                                    <td>${enquiry.enquiry_subject}</td>
                                    <td>${enquiry.enquiry_phone}</td>
                                    <td>${enquiry.enquiry_details}</td>
                                    <td>${enquiry.service_title}</td>
                                    
                                    `;
                        
                    });

                    // Append the rows to the table
                    $('#service_enquiry_data_table_body').html(html);

                    // Reinitialize DataTable if needed
                    
                } else {
                    $('#service_enquiry_data_table').html(`<tr>
                        <td colspan="8" style="text-align:center;">
                            No Data Found
                        </td>
                    </tr>`);
                }
            } else {
                $('#service_enquiry_data_table').html(`<tr>
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