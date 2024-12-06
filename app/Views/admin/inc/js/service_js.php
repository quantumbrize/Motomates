<script>
   $(document).ready(function () {
    let tagsArray = [];

    // Image Preview
    let $fileInput = $("#file-input-service");
    let $imageContainer = $("#images");
    let $numOfFiles = $("#num-of-files");

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

    // Add Tag
    $('#add-service-tag').click(function () {
        let tagInput = $('#service_tags_input').val().trim();
        if (tagInput !== "") {
            tagsArray.push(tagInput);
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
        tagsArray = tagsArray.filter(item => item !== tag);
        $(this).parent().remove();
    });

    // Submit Service with Tags
    $('#service_add_btn').click(function () {
        let formData = new FormData();
        formData.append('page_name', $('#page_name').val());
        formData.append('service_title', $('#service_title').val());
        formData.append('service_description', $('#service_description').val());
        tagsArray.forEach((tag, index) => formData.append(`tags[${index}]`, tag));

        $.each($('#file-input-service')[0].files, function (index, file) {
            formData.append('images[]', file);
        });

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

    $('#service_update_btn').click(function () {
        let formData = new FormData();
        
        // Ensure the form fields are getting the correct values
        formData.append('page_name', $('#page_name').val());
        formData.append('service_title', $('#service_title').val());
        formData.append('service_description', $('#service_description').val());

        // Correctly fetch the service UID from the form (after editing)
        formData.append('service_uid', $('#service_uid').val()); // Ensure this is populated correctly
        tagsArray.forEach((tag, index) => formData.append(`tags[${index}]`, tag));

        // Append image files to the formData if they exist
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
        let serviceRow = $(this).closest('tr'); // Get the row where the edit button is clicked
        let pageName = serviceRow.find('td:eq(1)').text(); // Get service page name
        let serviceTitle = serviceRow.find('td:eq(2)').text(); // Get service title
        let serviceDescription = serviceRow.find('td:eq(3)').text(); // Get service description
        let serviceTags = serviceRow.find('td:eq(4)').text(); // Get service tags (as string)
        let serviceImage = serviceRow.find('td:eq(5) img').attr('src'); // Get image URL from the image column
        let serviceUid = serviceRow.find('td:eq(4)').find('input').val(); // Extract the service UID from the hidden input field in the row

        // Populate form fields
        $('#page_name').val(pageName);
        $('#service_title').val(serviceTitle);
        $('#service_description').val(serviceDescription);

        // Set the service_uid in the hidden input field in the form
        $('#service_uid').val(serviceUid);  // This ensures you're updating the correct service

        // Populate tags (if any)
        tagsArray = serviceTags.split(', ').map(tag => tag.trim());
        $('#selected-service-tags').html('');
        tagsArray.forEach(tag => {
            $('#selected-service-tags').append(`
                <span class="tag-item badge bg-primary me-2">
                    ${tag} 
                    <button type="button" class="btn-close btn-sm remove-tag" data-tag="${tag}"></button>
                </span>
            `);
        });

        // Display image preview
        if (serviceImage) {
            $('#images').html(`<img src="${serviceImage}" alt="Service Image" style="max-width: 200px; max-height: 200px;" />`);
        } else {
            $('#images').html('No image available');
        }

        // Clear file input to allow a new image selection
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



    load_all_services();
});


    function load_all_services() {
    $.ajax({
        url: "<?= base_url('/api/all/service') ?>",
        type: "GET",
        beforeSend: function () {
            $('#table-banner-list-all-body').html(`<tr>
                    <td colspan="7" style="text-align:center;">
                        <div class="spinner-border" role="status"></div>
                    </td>
                </tr>`);
        },
        success: function (resp) {
            if (resp.status) {
                if (resp.data.length > 0) {
                    let html = ``;

                    $.each(resp.data, function (index, service) {
                        // Join tags with a comma for display
                        let tags = service.tags.join(', ');

                        // Construct image URL using the image name from the database
                        let imageUrl = `<?= base_url('') ?>public/uploads/service_images/${service.service_img}`;

                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${service.page_name}</td>
                                    <td>${service.service_title}</td>
                                    <td>${service.service_description}</td>
                                    <td>${tags}
                                    <input type='hidden' id="service_uid" value="${service.uid}"></td>
                                    <td>
                                        <img src="${imageUrl}" alt="Service Image" style="width: 50px; height: auto;">
                                    </td>
                                    <td>
                                        <i class="fa fa-close" id="delete_service"></i>
                                        <i class="fa fa-edit" id="edit_service"></i>
                                    </td>
                                </tr>`;
                    });
                    $('#table-banner-list-all-body').html(html);

                    // Reinitialize DataTable
                    if ($.fn.DataTable.isDataTable('#table-banner-list-all')) {
                        $('#table-banner-list-all').DataTable().clear().destroy();
                    }
                    $('#table-banner-list-all').DataTable();
                } else {
                    $('#table-banner-list-all-body').html(`<tr>
                        <td colspan="7" style="text-align:center;">
                            No Data Found
                        </td>
                    </tr>`);
                }
            } else {
                $('#table-banner-list-all-body').html(`<tr>
                    <td colspan="7" style="text-align:center;">
                        ${resp.message}
                    </td>
                </tr>`);
            }
        },
        error: function (err) {
            console.log(err);
            $('#table-banner-list-all-body').html(`<tr>
                <td colspan="7" style="text-align:center;">
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