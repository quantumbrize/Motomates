<script>
   
     function get_parent_categories() {
        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            type: "GET",
            success: function (resp) {

                let html = ''
                let sidebar = ''
                if (resp.status) {
                    if (resp.data.length > 0) {
                        $.each(resp.data, (index, category) => {
                            console.log('categoriespage',category)
                            html += `<div class="col-lg-4 col-md-6">
                                        <div class="perfect-fleet-item fleets-collection-item">
                                                <div class="image-box"><a href="#"><img fetchpriority="high" width="410" height="234" src="<?=base_url()?>public/uploads/categpry_images/${category.img_path}" class="attachment-novaride-thumb size-novaride-thumb wp-post-image" alt="" decoding="async"></a></div>    
                                                    <div class="perfect-fleet-content">
                                                        <div class="perfect-fleet-title">
                                                            
                                                            <h2><a href="#">${category.name}</a></h2>                                       
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                    </div>`
                            sidebar+=`<li class="cat-item cat-item-12"><label><input type='checkbox'  onchange="get_category_by_category_id()" name='ofcar-types[]' value='${category.uid}'> ${category.name}</label></li>`
                        })

                    }

                }
                
                $('#categories_list_page').html(html)
                $('#categories_list').html(sidebar)


            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function getSubCategory(category_id, accordion_body_id) {

        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            data: {
                parent_id: category_id
            },
            type: "GET",
            beforeSend: function () {
                $(`#${accordion_body_id}`).html(`<center><div class="spinner-border text-primary" role="status"></div></center>`)
            },
            success: function (resp) {
                console.log(resp)
                let html = ''

                if (resp.status) {
                    if (resp.data.length > 0) {
                        $.each(resp.data, (index, category) => {
                            // Add the category as a list item
                            html += `
                                <li class="subcategory-item" style="padding-left: 20px;">
                                    <a href="<?= base_url()?>all-category?category_id=${category.id}">
                                        <span class="elementor-icon-list-text">${category.name}</span>
                                    </a>
                                </li>`;

                            // If the category has subcategories, recursively fetch them
                            if (category.has_subcategories && category.has_subcategories > 0) {
                                html += `
                                <ul>
                                    <li class="parent-subcategory">
                                        <ul>`;
                                getSubCategory(category.id, `subcategories_${category.id}`); // Call the function again for subcategories
                                html += `</ul>
                                </li>
                                </ul>`;
                            }
                        })
                    }
                }

                $(`#${accordion_body_id}`).html(html)
            },
            error: function (err) {
                console.log(err);
            }
        });
        }
        function get_category_by_category_id() {
    const categoryId = $('input[name="ofcar-types[]"]:checked').val();

    // If no category is selected, stop execution
    if (!categoryId) {
        console.log("No category selected.");
        return;
    }

    // Send the selected category ID to the API
    $.ajax({
        url: '<?= base_url('/api/category/by/id') ?>',
        type: "GET",
        data: { c_id: categoryId }, // Send the category UID
        beforeSend: function () {
            console.log("Fetching category details for category ID:", categoryId);
            $('#categories_list_page').html(`<center><div class="spinner-border text-primary" role="status"></div></center>`);
        },
        success: function (resp) {
            console.log("Category_Details", resp);
            let html = '';

            if (resp.status && resp.data) {
                const category = resp.data; // Directly access the category object

                // Generate category details HTML
                html = `
                    <div class="col-lg-4 col-md-6">
                        <div class="perfect-fleet-item fleets-collection-item">
                            <div class="image-box">
                                <a href="#">
                                    <img fetchpriority="high" width="410" height="234" src="<?=base_url()?>public/uploads/categpry_images/${category.img_path}" class="attachment-novaride-thumb size-novaride-thumb wp-post-image" alt="${category.name}" decoding="async">
                                </a>
                            </div>    
                            <div class="perfect-fleet-content">
                                <div class="perfect-fleet-title">
                                    <h2><a href="#">${category.name}</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>`;
            } else {
                html = `<p>No details found for the selected category.</p>`;
            }

            // Display category details in the designated container
            $('#categories_list_page').html(html);
        },
        error: function (err) {
            console.log("Error fetching category details:", err);
            $('#categories_list_page').html(`<p>Error fetching category details. Please try again later.</p>`);
        }
    });
}


        get_parent_categories();
        
</script>