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
                let $img = $("<img>")
                    .attr("src", reader.result)
                    .addClass("preview-image"); // Apply the CSS class for size control
                $figure.prepend($img);
            };
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
                let $img = $("<img>")
                    .attr("src", reader.result)
                    .addClass("preview-image"); // Apply the CSS class for size control
                $figure.prepend($img);
            };
            $iconContainer.append($figure);
            reader.readAsDataURL(file);
        });
    });


    // Add Tag
    $('#add-service-tag').click(function () {
            let tagInput = $('#service_tags_input').val().trim();

            if (tagInput !== "") {
                tagsArray.push({ tag: tagInput });
                $('#selected-service-tags').append(`
                    <span class="tag-item badge bg-primary me-2">
                        ${tagInput}
                        <button type="button" class="btn-close btn-sm remove-tag" data-tag="${tagInput}"></button>
                    </span>
                `);
                $('#service_tags_input').val('');
            } else {
                alert("Please enter a tag.");
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



// Update function
$('#service_update_btn').click(function () {
    let formData = new FormData();

    // Get content from CKEditor and set it to the textarea
    if (window.editorInstance) {
        $('#service_description').val(window.editorInstance.getData());
    }

    // Append basic service details
    formData.append('page_name', $('#page_name').val());
    formData.append('service_title', $('#service_title').val());
    formData.append('service_description', $('#service_description').val()); // Use updated content from CKEditor
    formData.append('service_owner_contact', $('#service_owner_contact').val());
    formData.append('service_uid', $('#service_uid').val()); // Ensure this is populated correctly

    // Append tags and icons
    tagsArray.forEach((item, index) => {
        formData.append(`tags[${index}][tag]`, item.tag);
        // formData.append(`tags[${index}][icon]`, item.icon);
    });

    // Append service cards
    serviceCardsArray.forEach((item, index) => {
        formData.append(`service_cards[${index}][title]`, item.card_title);
        formData.append(`service_cards[${index}][description]`, item.card_description);
        
        // Handle image upload for each service card
        formData.append(`service_cards[${index}][service_card_image]`, item.image);
    });

    // Append service images
    $.each($('#file-input-service')[0].files, function (index, file) {
        formData.append('images[]', file);
    });

    $.each($('#file-input-service-icon')[0].files, function (index, file) {
        formData.append('icons[]', file);
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

    // Retrieve data from table cells
    let serviceUid = serviceRow.find('td:eq(4) input#service_uid').val(); // Hidden UID input
    let pageName = serviceRow.find('td:eq(1)').text().trim();
    let serviceTitle = serviceRow.find('td:eq(2)').text().trim();
    let serviceDescription = serviceRow.find('td:eq(3)').text().trim(); // Full description stored in `data-full-description`
    let serviceContact = serviceRow.find('td:eq(6)').text().trim();
    let serviceImage = serviceRow.find('td:eq(5) img').attr('src');
    let serviceIcon = serviceRow.find('td:eq(7) img').attr('src');

    // Handle service tags
    let serviceTagsHtml = serviceRow.find('td:eq(4)').html();
    let tagsArray = [];
    $(serviceTagsHtml).find('.badge').each(function () {
        let tagText = $(this).text().trim(); // Extract the tag text
        tagsArray.push({ tag: tagText });
    });

    // Populate form fields
    $('#page_name').val(pageName);
    $('#service_title').val(serviceTitle);
    $('#service_owner_contact').val(serviceContact);
    $('#service_uid').val(serviceUid);

    // Load service description into CKEditor
    if (window.editorInstance) {
        window.editorInstance.setData(serviceDescription); // Use CKEditor API to set the description
    } else {
        console.error("CKEditor instance not initialized");
    }

    // Populate tags in the tag section
    $('#selected-service-tags').html('');
    tagsArray.forEach(item => {
        $('#selected-service-tags').append(`
            <span class="tag-item badge bg-primary me-2">
                ${item.tag}
                <button type="button" class="btn-close btn-sm remove-tag" data-tag="${item.tag}"></button>
            </span>
        `);
    });

    // Populate service image and icon
    if (serviceImage) {
        $('#images').html(`<img src="${serviceImage}" alt="Service Image" style="max-width: 200px; max-height: 200px;" />`);
    } else {
        $('#images').html('No image available');
    }

    if (serviceIcon) {
        $('#icons').html(`<img src="${serviceIcon}" alt="Service Icon" style="max-width: 200px; max-height: 200px;" />`);
    } else {
        $('#icons').html('No icon available');
    }

    // Handle cards data
    let cardsHtml = serviceRow.find('td:eq(8) .card-item'); // Update index to match card data cell
    let cardsData = '';

    if (cardsHtml.length > 0) {
        cardsHtml.each(function () {
            let cardTitle = $(this).find('.badge').text().trim();
            let cardDescription = $(this).find('.card-description').text().trim();
            let cardImage = $(this).find('img').attr('src');

            cardsData += `
                <div class="card-item mb-2" style="display: flex; align-items: center; margin-bottom: 10px;">
                    <img src="${cardImage}" alt="Card Image" style="width: 30px; height: auto; margin-right: 5px;">
                    <span class="badge bg-secondary">${cardTitle}</span>
                    <p class="card-description ms-2">${cardDescription}</p>
                </div>
            `;
        });
    } else {
        cardsData = 'No cards available';
    }

    $('#selected-service-cards').html(cardsData);

    // Reset file input fields
    $('#file-input-service').val(null);
    $('#file-input-service-icon').val(null);
});






    $(document).on('click', '.fa-trash', function () {
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



    load_all_services();
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
                                tagsHtml += `
                                                <span class="badge bg-info">${tag.tag_name}</span>
                                            `;
                            });
                        } else {
                            tagsHtml = `<div>No tags available</div>`;
                        }
                        // Construct image URL using the image name from the database
                        let imageUrl = `<?= base_url() ?>public/uploads/service_images/${service.service_img}`;
                        let iconUrl = `<?= base_url() ?>public/uploads/service_images/${service.service_icon}`;
                        // Start the row for each service
                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${service.page_name}</td>
                                    <td>${service.service_title}</td>
                                    <td  class="truncate" data-full-description="${service.service_description}">${service.service_description}</td>
                                    <td class="truncate">
                                        ${tagsHtml}
                                    
                                    <td>
                                        <img src="${imageUrl}" alt="Service Image" style="width: 50px; height: auto;">
                                    </td>
                                    <td>${service.service_contact}</td>
                                    <td><img src="${iconUrl}" alt="Service Icon" style="width: 50px; height: auto;"></td>
                                    `;

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

                            html += `<td class="truncate">${cardsHtml}</td>`;  // Add cards inline in a new table cell
                        } else {
                            html += `<td>No cards available</td>`; // Handle case where no cards are present
                        }

                        html += `<td>
                                    <i class="fa fa-edit btn btn-info" id="edit_service" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                                    
                                    
                                </td>
                                <td>
                                    <i class="fa fa-trash btn btn-danger" id="delete_service"></i>
                                    
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
ClassicEditor
    .create(document.querySelector('#service_description'))
    .then(editor => {
        window.editorInstance = editor; // Save instance for reuse
    })
    .catch(error => {
        console.error("Error initializing CKEditor", error);
    });





</script>