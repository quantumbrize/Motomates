<script>
   $(document).ready(function () {
    let tagsArray = [];
    let serviceCardsArray = [];


    // Image Preview
    let $fileInput = $("#file-input-service");
    let $imageContainer = $("#images");
    let $numOfFiles = $("#num-of-files");

    let $iconInput = $("#file-input-service-icon");
    let $iconContainer = $("#icons");
    let $numOfIcons = $("#num-of-icons");

    $fileInput.change(function () {
        $imageContainer.html("");
        $numOfFiles.text(`${$fileInput[0].files.length} Files Selected`);
        $.each($fileInput[0].files, function (index, file) {
            let reader = new FileReader();
            let $figure = $("<figure>");
            let $figCap = $("<figcaption>").text(file.name);
            $figure.append($figCap);
            reader.onload = function () {
                let $img = $("<img>").attr("src", reader.result);
                $figure.prepend($img);
            }
            $imageContainer.append($figure);
            reader.readAsDataURL(file);
        });
    });
    $iconInput.change(function () {
        $iconContainer.html("");
        $numOfIcons.text(`${$iconInput[0].files.length} Files Selected`);
        $.each($iconInput[0].files, function (index, file) {
            let reader = new FileReader();
            let $figure = $("<figure>");
            let $figCap = $("<figcaption>").text(file.name);
            $figure.append($figCap);
            reader.onload = function () {
                let $img = $("<img>").attr("src", reader.result);
                $figure.prepend($img);
            }
            $iconContainer.append($figure);
            reader.readAsDataURL(file);
        });
    });

    // Add Tag
    $('#add-service-tag').click(function () {
        let tagInput = $('#service_tags_input').val().trim();
        let iconInput = $('#service_tags_icon_input').val().trim();

        if (tagInput !== "" && iconInput !== "") {
            tagsArray.push({ tag: tagInput, icon: iconInput });
            $('#selected-service-tags').append(`
                <span class="tag-item badge bg-primary me-2">
                    ${tagInput} 
                    <span class="icon-text ms-2">${iconInput}</span>
                    <button type="button" class="btn-close btn-sm remove-tag" data-tag="${tagInput}"></button>
                </span>
            `);
            $('#service_tags_input').val('');
            $('#service_tags_icon_input').val('');
        } else {
            alert("Please enter both a tag and an icon.");
        }
    });

    // Remove Tag
    $('#selected-service-tags').on('click', '.remove-tag', function () {
        let tag = $(this).data('tag');
        tagsArray = tagsArray.filter(item => item.tag !== tag);
        $(this).parent().remove();
    });

    $('#add-service-card').click(function () {
    let card_title = $('#service_card_title').val().trim();
    let card_description = $('#service_card_description').val().trim();
    let imageInput = $('#service_card_image')[0].files[0];

    if (card_title !== "" && card_description !== "" && imageInput !== "") {
        // Create an image preview URL
        let imageURL = URL.createObjectURL(imageInput);

        // Add the card to the array
        serviceCardsArray.push({ 
            card_title: card_title, 
            card_description: card_description, 
            image: imageInput
        });

        // Add the card item to the selected-service-cards section with an image preview
        $('#selected-service-cards').append(`
            <div class="card-item d-flex align-items-center mb-2">
                <img src="${imageURL}" alt="${card_title}" class="card-image me-2" style="width: 50px; height: 50px; object-fit: cover;">
                <span class="card-title me-2">${card_title}</span>
                <span class="icon-text me-2">${card_description}</span>
                <button type="button" class="btn-close btn-sm remove-tag" data-tag="${card_title}"></button>
            </div>
        `);

        // Clear the input fields
        $('#service_card_title').val('');
        $('#service_card_description').val('');
        $('#service_card_image').val('');
    } else {
        alert("Please enter both a title, description, and an image.");
    }
});

// Remove the added card when the close button is clicked
$('#selected-service-cards').on('click', '.remove-tag', function () {
    let tag = $(this).data('tag'); // Get the title of the tag to remove

    // Remove the tag from the serviceCardsArray
    serviceCardsArray = serviceCardsArray.filter(card => card.card_title !== tag);

    // Remove the card from the UI
    $(this).closest('.card-item').remove();
});


    // Submit Service with Tags
   // Function to handle adding a new service
   $('#service_add_btn').click(function () {
    let formData = new FormData();
    formData.append('page_name', $('#page_name').val());
    formData.append('service_title', $('#service_title').val());
    formData.append('service_description', $('#service_description').val());
    formData.append('service_owner_contact', $('#service_owner_contact').val());

    // Append tags and icons
    tagsArray.forEach((item, index) => {
        formData.append(`tags[${index}][tag]`, item.tag);
        formData.append(`tags[${index}][icon]`, item.icon);
    });
    console.log('cardarray',serviceCardsArray);

    // Append service cards
    serviceCardsArray.forEach((item, index) => {
        formData.append(`service_cards[${index}][title]`, item.card_title);
        formData.append(`service_cards[${index}][description]`, item.card_description);
        
        // Handle image upload for each service card
        // if (item.image) {
        
            formData.append(`service_cards[${index}][service_card_image]`, item.image);
        // }
    });
    for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
    }
    // Append service images
    $.each($('#file-input-service')[0].files, function (index, file) {
        formData.append('images[]', file);
    });

    $.each($('#file-input-service-icon')[0].files, function (index, file) {
        formData.append('icons[]', file);
    });

    // Send AJAX request
    $.ajax({
        url: "<?= base_url('/api/add/service') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#service_add_btn').text("Submitting...").attr('disabled', true);
        },
        success: function (response) {
            console.log('services',response);
            if (response.status) {
                alert(response.message);
                location.reload();
            } else {
                alert(`Error: ${response.message}`);
            }
        },
        error: function (err) {
            console.error("Error:", err);
        },
        complete: function () {
            $('#service_add_btn').text("Submit").attr('disabled', false);
        }
    });
});

// Update function
$('#service_update_btn').click(function () {
    let formData = new FormData();

    // Append basic service details
    formData.append('page_name', $('#page_name').val());
    formData.append('service_title', $('#service_title').val());
    formData.append('service_description', $('#service_description').val());
    formData.append('service_owner_contact', $('#service_owner_contact').val());
    formData.append('service_uid', $('#service_uid').val()); // Ensure this is populated correctly

    // Append tags and icons
    tagsArray.forEach((item, index) => {
        formData.append(`tags[${index}][tag]`, item.tag);
        formData.append(`tags[${index}][icon]`, item.icon);
    });

    // Append service cards
    serviceCardsArray.forEach((item, index) => {
        formData.append(`service_cards[${index}][title]`, item.card_title);
        formData.append(`service_cards[${index}][description]`, item.card_description);
        
        // Handle image upload for each service card
        // if (item.image) {
        
            formData.append(`service_cards[${index}][service_card_image]`, item.image);
        // }
    });

    // Append service images
    $.each($('#file-input-service')[0].files, function (index, file) {
        formData.append('images[]', file);
    });

    // Send AJAX request
    $.ajax({
        url: "<?= base_url('/api/update/service') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#service_update_btn').text("Submitting...").attr('disabled', true);
        },
        success: function (response) {
            if (response.status) {
                alert(response.message);
                location.reload();
            } else {
                alert(`Error: ${response.message}`);
            }
        },
        error: function (err) {
            console.error("Error:", err);
        },
        complete: function () {
            $('#service_update_btn').text("Submit").attr('disabled', false);
        }
    });
});





    // Edit Service Data
    $('#table-banner-list-all-body').on('click', '.fa-edit', function () {
        let serviceRow = $(this).closest('tr');
        let pageName = serviceRow.find('td:eq(1)').text();
        let serviceTitle = serviceRow.find('td:eq(2)').text();
        let serviceDescription = serviceRow.find('td:eq(3)').text();
        let serviceTags = serviceRow.find('td:eq(4)').html(); // Use .html() to properly retrieve the inner HTML
        let serviceImage = serviceRow.find('td:eq(5) img').attr('src');
        let serviceContact = serviceRow.find('td:eq(6)').text();
        let serviceUid = serviceRow.find('td:eq(4)').find('input').val();

        // Set service details
        $('#page_name').val(pageName);
        $('#service_title').val(serviceTitle);
        $('#service_description').val(serviceDescription);
        $('#service_owner_contact').val(serviceContact);
        $('#service_uid').val(serviceUid);

        // Handle tags
        let tagsArray = [];
        $(serviceTags).find('.badge').each(function () {
            let tagText = $(this).text().trim(); // Extract the tag text
            let iconText = $(this).next('span').text().trim(); // Extract the icon text
            tagsArray.push({ tag: tagText, icon: iconText });
        });

        $('#selected-service-tags').html('');
        tagsArray.forEach(item => {
            $('#selected-service-tags').append(`
                <span class="tag-item badge bg-primary me-2">
                    ${item.tag} 
                    <span class="icon-text ms-2">${item.icon}</span>
                    <button type="button" class="btn-close btn-sm remove-tag" data-tag="${item.tag}"></button>
                </span>
            `);
        });

        // Handle service image
        if (serviceImage) {
            $('#images').html(`<img src="${serviceImage}" alt="Service Image" style="max-width: 200px; max-height: 200px;" />`);
        } else {
            $('#images').html('No image available');
        }

        // Handle cards data
        let cardsHtml = '';
        let cards = serviceRow.find('td:eq(6) .card-item'); // Update this to match the location of your cards
        if (cards.length > 0) {
            $.each(cards, function (index, card) {
                let cardTitle = $(card).find('.card-title').text();
                let cardDescription = $(card).find('.card-description').text();
                let cardImage = $(card).find('img').attr('src');

                // Append each card's information to the card section
                cardsHtml += `
                    <div class="card-item mb-2">
                        <img src="${cardImage}" alt="Card Image" style="width: 30px; height: auto; margin-right: 5px;">
                        <span class="card-title">${cardTitle}</span>
                        <span class="card-description ms-2">${cardDescription}</span>
                    </div>
                `;
            });
        } else {
            cardsHtml = 'No cards available';
        }

        $('#selected-service-cards').html(cardsHtml);

        // Reset file input
        $('#file-input-service').val(null);
    });




    $(document).on('click', '.fa-close', function () {
    // Get the service row (tr) and extract the service UID
        var serviceRow = $(this).closest('tr');
        var serviceUid = serviceRow.find('#service_uid').val(); // Get the service UID from the hidden input

        // Confirm the deletion with the user
        if (confirm("Are you sure you want to delete this service?")) {
            // Perform the AJAX request to delete the service
            $.ajax({
                url: "<?= base_url('/api/delete/service') ?>",  // The endpoint for deletion
                type: "POST",
                data: { service_uid: serviceUid },  // Send the UID of the service to be deleted
                success: function (resp) {
                    if (resp.status) {
                        // Successfully deleted, remove the row from the table
                        serviceRow.remove();

                        // Optionally, show a success message
                        alert('Service deleted successfully.');
                    } else {
                        // Show error message if something goes wrong
                        alert('Error: ' + resp.message);
                    }
                },
                error: function (err) {
                    console.log(err);
                    alert('Error deleting the service. Please try again.');
                }
            });
        }
    });
    // document.getElementById('add-service-card').addEventListener('click', function () {
    //     const cardImageInput = document.getElementById('service_card_image');
    //     const cardTitleInput = document.getElementById('service_card_title');
    //     const cardDescriptionInput = document.getElementById('service_card_description');
    //     const selectedServiceCards = document.getElementById('selected-service-cards');

    //     // Validate inputs
    //     if (!cardTitleInput.value.trim() || !cardDescriptionInput.value.trim() || !cardImageInput.files.length) {
    //         alert('Please fill out all fields and upload an image!');
    //         return;
    //     }

    //     // Create a new service card element
    //     const cardWrapper = document.createElement('div');
    //     cardWrapper.classList.add('service-card', 'border', 'p-2', 'mb-2', 'position-relative');
        
    //     // Read the uploaded image file
    //     const reader = new FileReader();
    //     reader.onload = function (e) {
    //         cardWrapper.innerHTML = `
    //             <div class="d-flex align-items-center">
    //                 <img src="${e.target.result}" alt="Service Card Image" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px;">
    //                 <div>
    //                     <h6 class="mb-1">${cardTitleInput.value}</h6>
    //                     <p class="mb-1 text-muted">${cardDescriptionInput.value}</p>
    //                 </div>
    //             </div>
    //             <button class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">Remove</button>
    //         `;

    //         // Add remove functionality
    //         cardWrapper.querySelector('button').addEventListener('click', function () {
    //             cardWrapper.remove();
    //         });

    //         // Append the card to the selected service cards section
    //         selectedServiceCards.appendChild(cardWrapper);

    //         // Clear input fields
    //         cardImageInput.value = '';
    //         cardTitleInput.value = '';
    //         cardDescriptionInput.value = '';
    //     };

    //     // Read the file as a data URL
    //     reader.readAsDataURL(cardImageInput.files[0]);
    // });



    load_all_services();
    load_all_service_enquiry();
});


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
                        console.log('serviceload', service);

                        // Display tags
                        let tagsHtml = '';
                        if (service.tags.length > 0) {
                            $.each(service.tags, function (tagIndex, tag) {
                                tagsHtml += `<div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-info">${tag.tag_name}</span>
                                                <span class="ms-2">${tag.service_tag_icon}<span>
                                            </div>`;
                            });
                        } else {
                            tagsHtml = `<div>No tags available</div>`;
                        }

                        // Construct image URL using the image name from the database
                        let imageUrl = `<?= base_url() ?>public/uploads/service_images/${service.service_img}`;

                        // Start the row for each service
                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${service.page_name}</td>
                                    <td>${service.service_title}</td>
                                    <td>${service.service_description}</td>
                                    <td>${tagsHtml}
                                        <input type='hidden' id="service_uid" value="${service.uid}"></td>
                                    <td>
                                        <img src="${imageUrl}" alt="Service Image" style="width: 50px; height: auto;">
                                    </td>
                                    <td>${service.service_contact}</td>`;

                        // Add cards data if it exists
                        if (service.cards.length > 0) {
                            let cardsHtml = `<div class="card-data-wrapper" style="max-height: 200px; overflow-y: auto;">`;
                            $.each(service.cards, function (cardIndex, card) {
                                // Construct the card image URL
                                let cardImageUrl = `<?= base_url('') ?>public/uploads/service_images/${card.service_card_image}`;

                                // Add each card's details
                                cardsHtml += `
                                    <div class="card-item mb-2" style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <img src="${cardImageUrl}" alt="Card Image" style="width: 30px; height: auto; margin-right: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="card-details">
                                            <span class="badge bg-secondary">${card.service_card_title}</span>
                                            <p class="card-description ms-2">${card.service_card_description || 'No description available'}</p>
                                        </div>
                                    </div>`;
                            });
                            cardsHtml += `</div>`; // Close the wrapper

                            html += `<td>${cardsHtml}</td>`;  // Add cards inline in a new table cell
                        } else {
                            html += `<td>No cards available</td>`; // Handle case where no cards are present
                        }

                        html += `<td>
                                    <i class="fa fa-close" id="delete_service"></i>
                                    <i class="fa fa-edit" id="edit_service"></i>
                                </td>
                            </tr>`;
                    });

                    // Append the rows to the table
                    $('#table-banner-list-all-body').html(html);

                    // Reinitialize DataTable if needed
                    if ($.fn.DataTable.isDataTable('#table-banner-list-all')) {
                        $('#table-banner-list-all').DataTable().clear().destroy();
                    }
                    $('#table-banner-list-all').DataTable();
                } else {
                    $('#table-banner-list-all-body').html(`<tr>
                        <td colspan="8" style="text-align:center;">
                            No Data Found
                        </td>
                    </tr>`);
                }
            } else {
                $('#table-banner-list-all-body').html(`<tr>
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
                                    <td>${enquiry.service_id}</td>
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