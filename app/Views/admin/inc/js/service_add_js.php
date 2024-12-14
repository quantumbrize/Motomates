<script>
    $(document).ready(function () {
    let tagsArray = [];
    let serviceCardsArray = [];
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
        // formData.append(`tags[${index}][icon]`, item.icon);
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
    })
    ClassicEditor
        .create(document.querySelector('#service_description'))
        .catch(error => {
            console.error(error);
        });
</script>