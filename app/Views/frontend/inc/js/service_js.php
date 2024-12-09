<script>
    const whatsapp_number=''
   $(document).ready(function () {
    load_all_tags();
    load_all_cards();
    load_all_service_pages();
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service_uid');
    $.ajax({
        url: "<?= base_url('api/get/service_post') ?>",
        type: "GET",
        data: {serviceId:serviceId},
        success: function (resp) {
            console.log('servicem', resp)
            // console.log('uid', serviceId)
            // resp = JSON.parse(resp)
            // console.log(resp.user_data.number)
            if (resp.status) {
                html1=`<img fetchpriority="high" decoding="async" width="1200" height="800"
                                src="<?=base_url()?>public/uploads/service_images/${resp.data.service_img}"
                                class="attachment-full size-full wp-image-3063" alt="">`

                html2=`${resp.data.service_title}`

                html3=`${resp.data.service_description}`
                html4=`${resp.data.service_contact}`
                

                

                $("#service_image").html(html1)
                $("#service_title").html(html2)
                $("#service_description").html(html3)
                $("#service_contact2").html(html4)
                
                whatsapp_number=resp.data.service_contact
            } else {
                console.log(resp)
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
        
});
function load_all_tags() {
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service_uid'); // Get the service_uid from the URL

    // Check if serviceId exists
    if (!serviceId) {
        console.error("Service ID not found in the URL.");
        $('#service_tags_list').html(`<p>No Service ID provided.</p>`);
        return;
    }

    $.ajax({
        url: "<?= base_url('/get/all/tags') ?>",
        type: "GET",
        data: { serviceId: serviceId },
        beforeSend: function () {
            $('#service_tags_list').html(`<div class="spinner-border" role="status"></div>`);
        },
        success: function (resp) {
            if (resp.status && resp.data.length > 0) {
                let htmltags = ''; // Initialize the variable here

                // Iterate over the response data
                $.each(resp.data, function (index, serviceTags) {
                    htmltags += `
                        <li class="elementor-icon-list-item">
                            <span class="elementor-icon-list-icon">
                                <i aria-hidden="true" class="${serviceTags.service_tag_icon}"></i>
                            </span>
                            <span class="elementor-icon-list-text">${serviceTags.tag_name}</span>
                        </li>`;
                });

                // Append the tags to the list
                $("#service_tags_list").html(htmltags);
            } else {
                // Handle case when no data is returned
                $('#service_tags_list').html(`<p>No Tags Found</p>`);
            }
        },
        error: function (err) {
            console.error('Error loading tags:', err);
            $('#service_tags_list').html(`<p>Error loading tags.</p>`);
        },
        complete: function () {
            // Optional: Any additional steps after the request is complete.
        }
    });
}

function load_all_cards() {
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service_uid'); // Get the service_uid from the URL

    // Check if serviceId exists
    if (!serviceId) {
        console.error("Service ID not found in the URL.");
        $('#service_cards_list').html(`<p>No Service ID provided.</p>`);
        return;
    }

    $.ajax({
        url: "<?= base_url('/get/all/cards') ?>",  // Ensure this URL is correct
        type: "GET",
        data: { serviceId: serviceId },
        beforeSend: function () {
            $('#service_cards_list').html(`<div class="spinner-border" role="status"></div>`);
        },
        success: function (resp) {
            console.log('Response:', resp); // Log the response to check its structure

            if (resp && resp.status && resp.data && resp.data.length > 0) {
                let htmlcards = ''; // Initialize the variable here

                // Iterate over the response data
                $.each(resp.data, function (index, serviceCard) {
                    console.log('Card:', serviceCard);

                    // Ensure that the required data exists in the response
                    const title = serviceCard.service_card_title || 'Service Title';  // Fallback to default title
                    const description = serviceCard.service_card_description || 'Service Description'; // Fallback description
                    const image = serviceCard.service_card_image; // Fallback description
                    // const link = serviceCard.link || '#'; // Fallback link

                    htmlcards += `
                       <div class="elementor-element elementor-element-921e616 e-con-full service-item e-flex e-con e-child" data-id="921e616" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
									<div class="elementor-element elementor-element-e2a720b ekit-equal-height-disable elementor-widget elementor-widget-elementskit-icon-box" data-id="e2a720b" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="elementskit-icon-box.default">
										<div class="elementor-widget-container">
											<div class="ekit-wid-con"> <!-- link opening -->
												<!-- end link opening -->
												<div class="elementskit-infobox text-left text-left icon-top-align elementor-animation-">
													<div class="elementskit-box-header elementor-animation-">
														<div class="">
															<img style="width:20%" src="<?=base_url()?>public/uploads/service_images/${image}">
														</div>
													</div>
													<div class="elementskit-box-body">
														<div class="elementskit-box-title">
															<h4 class="elementskit-title">${title}</h4>
														</div>
														<div class="elementskit-box-text">
															<p>${description}.</p>
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</div> 
								</div>`;
                    // htmlcards += `<p>${index}</p>`
                });

                // Append the tags to the list
                $("#service_cards_list").html(htmlcards);
            } else {
                // Handle case when no data is returned
                $('#service_cards_list').html(`<p>No Tags Found</p>`);
            }
        },
        error: function (err) {
            console.error('Error loading tags:', err);
            $('#service_cards_list').html(`<p>Error loading tags.</p>`);
        }
    });
}
function load_all_service_pages() {
    $.ajax({
        url: "<?= base_url('/api/all/service') ?>",
        type: "GET",
        beforeSend: function () {
            $('#table-banner-list-all-body').html(`
                <tr>
                    <td colspan="8" style="text-align:center;">
                        <div class="spinner-border" role="status"></div>
                    </td>
                </tr>
            `);
        },
        success: function (resp) {
            // Check if response status is true
            if (resp.status) {
                // Clear previous list items first
                let html = '';
                $.each(resp.data, function (index, service) {
                    
                    if (service) {
                        // Append each new list item instead of overwriting
                        // console.log('pages', service);
                        html += `
                            <li class="elementor-icon-list-item">
																<a href="<?= base_url()?>single-service?service_uid=${service.uid}">

																	<span class="elementor-icon-list-icon">
																		<svg xmlns="http://www.w3.org/2000/svg"
																			width="14" height="14" viewbox="0 0 14 14"
																			fill="none">
																			<path
																				d="M11.6654 3.97592L1.64141 13.9999L-0.00537109 12.3531L10.0174 2.32914H1.18372V-0.00012207H13.9946V12.8108H11.6654V3.97592Z"
																				fill="white"></path>
																		</svg> </span>
																	<span class="elementor-icon-list-text">${service.page_name}</span>
																</a>
															</li>`;
                    }
                });
                // After all items are appended, insert them into the DOM
                $('#service_pages_list').html(html);
            } else {
                $('#service_pages_list').html(`
                    <p>${resp.message}</p>
                `);
            }
        },
        error: function (err) {
            console.log(err);
            $('#service_pages_list').html(`
                <p>Error loading data.</p>
            `);
        },
        complete: function () {
            // Optional: Any additional steps after the request is complete.
        }
    });
}
    function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'block';
    }

    // Function to close a popup
    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }

    // Add event listeners
    document.getElementById('messageIcon').addEventListener('click', function() {
        openPopup('popup1');
    });

    document.getElementById('whatsappIcon').addEventListener('click', function() {
        window.open(`https://wa.me/${whatsapp_number}?text=Hello%20there!`, "_blank");
    });

    document.getElementById('enquiryButton').addEventListener('click', function() {
        openPopup('enquiryPopup');
    });
    document.getElementById('enquiryButton1').addEventListener('click', function() {
        openPopup('enquiryPopup');
    });
    function submit_enquiry() {
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('service_uid');
        let formData = new FormData();
        formData.append('enquiry_name', $('#enquiry_name').val());
        formData.append('enquiry_email', $('#enquiry_email').val());
        formData.append('enquiry_phone', $('#enquiry_phone').val());
        formData.append('enquiry_subject', $('#enquiry_subject').val());
        formData.append('enquiry_details', $('#enquiry_details').val());
        formData.append('service_id', serviceId);

        $.ajax({
            url: "<?= base_url('/api/add/enquiry') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#submit_enquiry').text("Submitting...").attr('disabled', true);
            },
            success: function (response) {
                console.log('enquiry', response);
                if (response.status) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        gravity: "top", // Position on top
                        position: "center", // Align to right
                        backgroundColor: "green", // Success notification color
                        close: true
                    }).showToast();

                    const modalElement = document.getElementById("exampleModal");
                    const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                    modalInstance.hide();
                } else {
                    Toastify({
                        text: `Error: ${response.message}`,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red", // Error notification color
                        close: true
                    }).showToast();
                }
            },
            error: function (err) {
                console.error("Error:", err);
                Toastify({
                    text: "An unexpected error occurred. Please try again later.",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "orange", // Error notification color
                    close: true
                }).showToast();
            },
            complete: function () {
                $('#submit_enquiry').text("Submit").attr('disabled', false);
            }
        });
    }


    
</script>