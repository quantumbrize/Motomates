<script>
    $(document).ready(function () {
        load_all_services();
    })

    function load_all_services() {
        $.ajax({
            url: "<?= base_url('/api/all/service') ?>",
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

                        $.each(resp.data, function (index, service) {
                            console.log('serviceall', service);
                            html+=`
                            <div class="elementor-element elementor-element-09ba840 e-con-full service-item e-flex e-con e-child"
                            data-id="09ba840" data-element_type="container"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                            <div class="elementor-element elementor-element-c2ae28f ekit-equal-height-disable elementor-widget elementor-widget-elementskit-icon-box"
                                data-id="c2ae28f" data-element_type="widget"
                                data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}"
                                data-widget_type="elementskit-icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="ekit-wid-con"> <!-- link opening -->
                                        <!-- end link opening -->

                                        <div
                                            class="elementskit-infobox text-left text-left icon-top-align elementor-animation-   ">
                                            <div class="elementskit-box-header elementor-animation-">
                                                <div class="">
                                                    <img style="width:30%" src="<?=base_url()?>public/uploads/service_images/${service.service_img}">
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <h3 class="elementskit-info-box-title">
                                                    ${service.service_title} </h3>
                                                <p>${service.service_description}</p>
                                                <div class="box-footer disable_hover_button">
                                                    <div class="btn-wraper">
                                                        <a href="<?= base_url()?>single-service?service_uid=${service.uid}" target="_self" rel=""
                                                            class="elementskit-btn whitespace--normal elementor-animation-">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewbox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M11.6654 3.97592L1.64141 13.9999L-0.00537109 12.3531L10.0174 2.32914H1.18372V-0.00012207H13.9946V12.8108H11.6654V3.97592Z"
                                                                    fill="white"></path>
                                                            </svg> </a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `

                        

                            // Add cards data if it exists
                        
                        });

                        // Append the rows to the table
                        $('#all_services').html(html);

                        // Reinitialize DataTable if needed
                    
                    } else {
                        $('#all_services').html(`
                            <P>
                                No Data Found
                            </p>
                        `);
                    }
                } else {
                    $('#all_services').html(`
                        <p>
                            ${resp.message}
                        </p>
                    `);
                }
            },
            error: function (err) {
                console.log(err);
                $('#all_services').html(`
                    <p>
                        Error loading data.
                    </p>
                `);
            },
            complete: function () {
                // Optional: Any additional steps after the request is complete.
            }
        });
    }

</script>