<script>

    $(document).ready(function () {
        $('#blog_update_btn').on('click', function () {
        var formData = new FormData();

        formData.append('blog_title', $('#blog_title').val());
        formData.append('blog_description', $('#blog_description').val());
        formData.append('blog_uid', $('#blog_uid').val());

        $.each($('#file-input-blog')[0].files, function (index, file) {
            formData.append('images[]', file);
        });

        $.ajax({
            url: "<?= base_url('/api/update/blog') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#blog_update_btn').html(`<div class="spinner-border" role="status"></div>`);
                $('#blog_update_btn').attr('disabled', true);
            },
            success: function (resp) {
                let html = '';

                if (resp.status) {
                    html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                } else {
                    html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                }

                $('#alert').html(html);
            },
            error: function (err) {
                console.log(err);
            },
            complete: function () {
                $('#blog_update_btn').html('Submit');
                $('#blog_update_btn').attr('disabled', false);
            }
        });
    });

    $('#blog_add_btn').on('click', function () {
        var formData = new FormData();

        formData.append('blog_title', $('#blog_title').val());
        formData.append('blog_description', $('#blog_description').val());

        $.each($('#file-input-blog')[0].files, function (index, file) {
            formData.append('images[]', file);
        });

        $.ajax({
            url: "<?= base_url('/api/add/blog') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#blog_update_btn').html(`<div class="spinner-border" role="status"></div>`);
                $('#blog_update_btn').attr('disabled', true);
            },
            success: function (resp) {
                let html = '';

                if (resp.status) {
                    html += `<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-checkbox-circle-fill label-icon"></i>${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                } else {
                    html += `<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                            <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - ${resp.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                }

                $('#alert').html(html);
            },
            error: function (err) {
                console.log(err);
            },
            complete: function () {
                $('#blog_update_btn').html('Submit');
                $('#blog_update_btn').attr('disabled', false);
            }
        });
    });
    $(document).on('click', '#edit_blog', function () {
        var blogRow = $(this).closest('tr');
        var bloguid = blogRow.find('#blog_id').val();
        var blogTitle = blogRow.find('td:eq(1)').text();
        var blogDescription = blogRow.find('td:eq(2)').text();
        var blogImagePath = blogRow.find('#blog_image').val();
        var path=`<?= base_url()?>public/uploads/blog_images/${blogImagePath}`
        
        $('#blog_title').val(blogTitle);
        $('#blog_description').val(blogDescription);
        $('#blog_uid').val(bloguid);

        // Display the image preview if it exists
        if (blogImagePath) {
            $('#images').html('<img src="' + path + '" alt="Blog Image" style="max-width: 200px; max-height: 200px;" />');
        } else {
            $('#images').html('No image available');
        }

        // Clear file input so the user can select a new image if needed
        $('#file-input-blog').val(null);
    });

$(document).on('click', '#delete_blog', function () {
    // Get the blog row (tr) and extract the blog UID
    var blogRow = $(this).closest('tr');
    var blogUid = blogRow.find('#blog_id').val(); // Get the blog UID

    // Confirm the deletion with the user
    if (confirm("Are you sure you want to delete this blog?")) {
        // Perform the AJAX request to delete the blog
        $.ajax({
            url: "<?= base_url('/api/delete/blog') ?>",  // The endpoint for deletion
            type: "POST",
            data: { blog_uid: blogUid },  // Send the UID of the blog to be deleted
            success: function (resp) {
                if (resp.status) {
                    // Successfully deleted, remove the row from the table
                    blogRow.remove();

                    // Optionally, show a success message
                    alert('Blog deleted successfully.');
                } else {
                    // Show error message if something goes wrong
                    alert('Error: ' + resp.message);
                }
            },
            error: function (err) {
                console.log(err);
                alert('Error deleting the blog. Please try again.');
            }
        });
    }
});
$('#file-input-blog').on('change', function (event) {
    var files = event.target.files; // Get the selected files
    var fileCount = files.length;
    
    // Show the number of selected files
    $('#num-of-files').text(fileCount + " file(s) selected.");
    
    // Display the selected image preview
    if (fileCount > 0) {
        var file = files[0]; // Use the first file
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#images').html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 200px; max-height: 200px;" />');
        };
        
        reader.readAsDataURL(file);
    }
});


    load_all_blog();
});

// function load_all_blog() {
//     $.ajax({
//         url: "<?= base_url('/api/all/blog') ?>",
//         type: "GET",
//         beforeSend: function () {
//             $('#table-banner-list-all-body').html(`<tr >
//                     <td colspan="3"  style="text-align:center;">
//                         <div class="spinner-border" role="status"></div>
//                     </td>
//                 </tr>`)
//         },
//         success: function (resp) {
//             if (resp.status) {
//                 if (resp.data.length > 0) {
//                     let html = ``;
                    
//                     $.each(resp.data, function (index, blog) {
//                         console.log('blog',blog)
//                         html += `<tr>
//                                     <td>${index + 1}</td>
//                                     <td>${blog.blog_title}</td>
//                                     <td>${blog.blog_description}
//                                         <input type="hidden" id='blog_id' value="${blog.uid}"></td>
//                                     <td><i class="fa fa-close" id="delete_blog"></i> <i class="fa fa-edit" id="edit_blog"></i> </td>
//                                 </tr>`;
//                     });
//                     $('#table-banner-list-all-body').html(html);
                    
//                     // Reinitialize DataTable
//                     if ($.fn.DataTable.isDataTable('#table-banner-list-all')) {
//                         $('#table-banner-list-all').DataTable().clear().destroy();
//                     }
//                     $('#table-banner-list-all').DataTable();
//                 } else {
//                     $('#table-banner-list-all-body').html(`<tr >
//                         <td colspan="3" style="text-align:center;">
//                             No Data Found
//                         </td>
//                     </tr>`);
//                 }
//             } else {
//                 $('#table-banner-list-all-body').html(`<tr >
//                     <td colspan="3" style="text-align:center;">
//                         ${resp.message}
//                     </td>
//                 </tr>`);
//             }
//         },
//         error: function (err) {
//             console.log(err);
//             $('#table-banner-list-all-body').html(`<tr >
//                 <td colspan="3" style="text-align:center;">
//                     Error loading data.
//                 </td>
//             </tr>`);
//         },
//         complete: function () {
//             // Optional: Any additional steps after the request is complete.
//         }
//     });
// }
function load_all_blog() {
    $.ajax({
        url: "<?= base_url('/api/all/blog') ?>",
        type: "GET",
        beforeSend: function () {
            $('#table-banner-list-all-body').html(`<tr >
                    <td colspan="3"  style="text-align:center;">
                        <div class="spinner-border" role="status"></div>
                    </td>
                </tr>`)
        },
        success: function (resp) {
            if (resp.status) {
                if (resp.data.length > 0) {
                    let html = ``;

                    $.each(resp.data, function (index, blog) {
                        console.log('blog', blog);
                        html += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${blog.blog_title}</td>
                                    <td>${blog.blog_description}
                                        <input type="hidden" id='blog_id' value="${blog.uid}">
                                        <input type="hidden" id='blog_image' value="${blog.blog_image}"> <!-- Assuming image_path is the field with image URL -->
                                    </td>
                                    <td><i class="fa fa-close" id="delete_blog"></i> <i class="fa fa-edit" id="edit_blog"></i> </td>
                                </tr>`;
                    });
                    $('#table-banner-list-all-body').html(html);

                    // Reinitialize DataTable
                    if ($.fn.DataTable.isDataTable('#table-banner-list-all')) {
                        $('#table-banner-list-all').DataTable().clear().destroy();
                    }
                    $('#table-banner-list-all').DataTable();
                } else {
                    $('#table-banner-list-all-body').html(`<tr >
                        <td colspan="3" style="text-align:center;">
                            No Data Found
                        </td>
                    </tr>`);
                }
            } else {
                $('#table-banner-list-all-body').html(`<tr >
                    <td colspan="3" style="text-align:center;">
                        ${resp.message}
                    </td>
                </tr>`);
            }
        },
        error: function (err) {
            console.log(err);
            $('#table-banner-list-all-body').html(`<tr >
                <td colspan="3" style="text-align:center;">
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