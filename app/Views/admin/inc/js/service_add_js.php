<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        let tagsArray = [];
        let serviceCardsArray = [];
        let editorInstance; // Declare the editor instance here
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

    // $iconInput.change(function () {
    //     $iconContainer.html("");
    //     $numOfIcons.text(`${$iconInput[0].files.length} Files Selected`);
    //     $.each($iconInput[0].files, function (index, file) {
    //         let reader = new FileReader();
    //         let $figure = $("<figure>");
    //         let $figCap = $("<figcaption>").text(file.name);
    //         $figure.append($figCap);
    //         reader.onload = function () {
    //             let $img = $("<img>")
    //                 .attr("src", reader.result)
    //                 .addClass("preview-image"); // Apply the CSS class for size control
    //             $figure.prepend($img);
    //         };
    //         $iconContainer.append($figure);
    //         reader.readAsDataURL(file);
    //     });
    // });
        ClassicEditor
            .create(document.querySelector('#service_description'))
            .then(editor => {
                editorInstance = editor; // Store the CKEditor instance
            })
            .catch(error => {
                console.error("Error initializing CKEditor:", error);
            });

        // Handle adding service tags
        // $('#add-service-tag').click(function () {
        //     let tagInput = $('#service_tags_input').val().trim();

        //     if (tagInput !== "") {
        //         tagsArray.push({ tag: tagInput });
        //         $('#selected-service-tags').append(`
        //             <span class="tag-item badge bg-primary me-2">
        //                 ${tagInput}
        //                 <button type="button" class="btn-close btn-sm remove-tag" data-tag="${tagInput}"></button>
        //             </span>
        //         `);
        //         $('#service_tags_input').val('');
        //     } else {
        //         alert("Please enter a tag.");
        //     }
        // });

        // Remove Tag
        // $('#selected-service-tags').on('click', '.remove-tag', function () {
        //     let tag = $(this).data('tag');
        //     tagsArray = tagsArray.filter(item => item.tag !== tag);
        //     $(this).parent().remove();
        // });

        // Handle adding service cards
        // $('#add-service-card').click(function () {
        //     let card_title = $('#service_card_title').val().trim();
        //     let card_description = $('#service_card_description').val().trim();
        //     let imageInput = $('#service_card_image')[0].files[0];

        //     if (card_title !== "" && card_description !== "" && imageInput !== "") {
        //         let imageURL = URL.createObjectURL(imageInput);
        //         serviceCardsArray.push({ card_title: card_title, card_description: card_description, image: imageInput });

        //         $('#selected-service-cards').append(`
        //             <div class="card-item d-flex align-items-center mb-2">
        //                 <img src="${imageURL}" alt="${card_title}" class="card-image me-2" style="width: 50px; height: 50px; object-fit: cover;">
        //                 <span class="card-title me-2">${card_title}</span>
        //                 <span class="icon-text me-2">${card_description}</span>
        //                 <button type="button" class="btn-close btn-sm remove-tag" data-tag="${card_title}"></button>
        //             </div>
        //         `);

        //         $('#service_card_title').val('');
        //         $('#service_card_description').val('');
        //         $('#service_card_image').val('');
        //     } else {
        //         alert("Please enter both a title, description, and an image.");
        //     }
        // });

        // Remove card
        // $('#selected-service-cards').on('click', '.remove-tag', function () {
        //     let tag = $(this).data('tag');
        //     serviceCardsArray = serviceCardsArray.filter(card => card.card_title !== tag);
        //     $(this).closest('.card-item').remove();
        // });

        // Submit Service with Tags
        $('#service_add_btn').click(function (e) {
            e.preventDefault();
            let formData = new FormData();

            // Retrieve value from CKEditor
            const serviceDescription = editorInstance ? editorInstance.getData() : '';

            if (!serviceDescription) {
                alert('Please enter the service description.');
                return;
            }

            // formData.append('page_name', $('#page_name').val());
            formData.append('service_title', $('#service_title').val());
            formData.append('service_description', serviceDescription); // Use CKEditor content
            // formData.append('service_owner_contact', $('#service_owner_contact').val());

            // Append tags
            // tagsArray.forEach((item, index) => {
            //     formData.append(`tags[${index}][tag]`, item.tag);
            // });

            // Append service cards
            // serviceCardsArray.forEach((item, index) => {
            //     formData.append(`service_cards[${index}][title]`, item.card_title);
            //     formData.append(`service_cards[${index}][description]`, item.card_description);
            //     formData.append(`service_cards[${index}][service_card_image]`, item.image);
            // });

            // Append service images
            $.each($('#file-input-service')[0].files, function (index, file) {
                formData.append('images[]', file);
            });

            // $.each($('#file-input-service-icon')[0].files, function (index, file) {
            //     formData.append('icons[]', file);
            // });

            // Log FormData for debugging
            // for (let pair of formData.entries()) {
            //     console.log(pair[0] + ':', pair[1]);
            // }

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
                    console.log('Response:', response);
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
    });


</script>
