<script>

    function load_all_products() {
        $.ajax({
            url: "<?= base_url('/api/product') ?>",
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
                        let totalPrice = ``;
                        let truncatedDescription = ``;

                        $.each(resp.data, function (index, product) {
                            console.log('productall', product);
                            truncatedDescription=truncateText(product.description,50)
                            discountedPrice= product.base_price - (product.base_discount*product.base_price/100)
                            totalPrice= discountedPrice+(product.tax*discountedPrice/100);
                            let finalPrice = parseFloat(totalPrice.toFixed(2));
                            html+=`<div class="col-lg-4 col-md-6">
                            <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
                            <div class="perfect-fleet-item fleets-collection-item">
                                    <div class="image-box"><a href="<?=base_url()?>single-car?product_uid=${product.product_id}"><img fetchpriority="high" width="410" height="234" src="<?=base_url()?>public/uploads/product_images/${product.src}" class="attachment-novaride-thumb size-novaride-thumb wp-post-image" alt="" decoding="async"></a></div>    
                                    <div class="perfect-fleet-content">
                                        <div class="perfect-fleet-title">
                                            <h3>${product.manufacturer_name}</h3>
                                            <h2>${product.name}</h2>                                        
                                        </div>
                                         <div class="perfect-fleet-title">
                                            <p>
                                                ${truncatedDescription}
                                            </p>
                                        
                                        </div>
                                        <div class="perfect-fleet-body">
                                            <ul><li><label><img src="<?=base_url()?>public/uploads/product_images/Doors.png"> <span class="feature-label">Doors</span></label><span class="feature-value"> ${product.doors}</span></li></ul>                                        </div>

                                        <div class="perfect-fleet-footer">
                                            <div class="perfect-fleet-pricing">
                                                <h2>₹ ${finalPrice}</h2>                                            </div>
                                            <div class="perfect-fleet-btn">
                                                <a href="<?=base_url()?>single-car?product_uid=${product.product_id}" class="section-icon-btn"><img src="<?=base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/images/arrow-white.svg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </a>
                            </div>
                        `

                        

                            // Add cards data if it exists
                        
                        });

                        // Append the rows to the table
                        $('#cars').html(html);

                        // Reinitialize DataTable if needed
                    
                    } else {
                        $('#cars').html(`
                            <P>
                                No Data Found
                            </p>
                        `);
                    }
                } else {
                    $('#cars').html(`
                        <p>
                            ${resp.message}
                        </p>
                    `);
                }
            },
            error: function (err) {
                console.log(err);
                $('#products_home').html(`
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
    function get_parent_categories() {
        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            type: "GET",
            success: function (resp) {

                let html = ''
                if (resp.status) {
                    if (resp.data.length > 0) {
                        $.each(resp.data, (index, category) => {
                            console.log('categories',category)
                            html += `<li class="cat-item cat-item-12"><label><input type='checkbox'  name='ofcar-types[]' onchange="get_product_by_category()" value='${category.uid}'> ${category.name}</label></li>`
                        })

                    }

                }
                
                $('#categories_list').html(html)


            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function getSubCategory(category_id, parent_element_id) {
        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            data: { parent_id: category_id },
            type: "GET",
            beforeSend: function () {
                // Add a loading spinner to indicate the subcategories are being fetched
                $(`#${parent_element_id}`).append(`<center><div class="spinner-border text-primary" role="status"></div></center>`);
            },
            success: function (resp) {
                console.log(resp);
                let html = '';

                if (resp.status && resp.data.length > 0) {
                    html += `<ul style="padding-left: 20px;">`; // Add indentation for subcategories
                    $.each(resp.data, (index, category) => {
                        html += `
                            <li class="subcategory-item">
                                <label>
                                    <input type='checkbox' name='ofcar-types[]' value='${category.uid}'>
                                    ${category.name}
                                </label>
                                <ul id="subcategories_${category.id}" style="padding-left: 20px;"></ul>
                            </li>`;
                    });
                    html += `</ul>`;
                }

                // Remove the loading spinner and append the generated HTML
                $(`#${parent_element_id}`).find('.spinner-border').remove();
                $(`#${parent_element_id}`).append(html);

                // Recursively fetch subcategories for each category with subcategories
                if (resp.data.length > 0) {
                    $.each(resp.data, (index, category) => {
                        if (category.has_subcategories && category.has_subcategories > 0) {
                            getSubCategory(category.id, `subcategories_${category.id}`);
                        }
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    function get_product_by_category() {
    // Get all selected category IDs
    const categoryIds = $('input[name="ofcar-types[]"]:checked')
        .map(function () {
            return $(this).val();
        })
        .get(); // Convert selected values into an array

    // Prepare API parameters
    const data = categoryIds.length > 0 ? { c_ids: categoryIds } : null;

    // Send the request to the API
    $.ajax({
        url: '<?= base_url() ?>api/product',
        type: "GET",
        data: data, // Pass the selected category IDs as data
        beforeSend: function () {
            console.log(
                categoryIds.length > 0
                    ? `Fetching products for categories: ${categoryIds.join(', ')}`
                    : "Fetching all products (no categories selected)."
            );
            $('#cars').html(`<center><div class="spinner-border text-primary" role="status"></div></center>`);
        },
        success: function (resp) {
            console.log('=>>>>>',resp);
            let html = '';

            if (resp.status && resp.data.length > 0) {
                // Generate product list HTML for each product
                $.each(resp.data, (index, product) => {
                    const truncatedDescription = truncateText(product.description, 50);
                    const totalPrice = product.base_price - 
                        (product.base_discount * product.base_price / 100) - 
                        (product.tax * product.base_price / 100);

                    html += `
                        <div class="col-lg-4 col-md-6">
                            <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
                                <div class="perfect-fleet-item fleets-collection-item">
                                    <div class="image-box">
                                        <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
                                            <img fetchpriority="high" width="410" height="234" 
                                                src="<?=base_url()?>public/uploads/product_images/${product.src}" 
                                                class="attachment-novaride-thumb size-novaride-thumb wp-post-image" 
                                                alt="" decoding="async">
                                        </a>
                                    </div>    
                                    <div class="perfect-fleet-content">
                                        <div class="perfect-fleet-title">
                                            <h3>${product.manufacturer_name}</h3>
                                            <h2>${product.name}</h2>
                                        </div>
                                        <div class="perfect-fleet-title">
                                            <p>${truncatedDescription}</p>
                                        </div>
                                        <div class="perfect-fleet-body">
                                            <ul>
                                                <li>
                                                    <label>
                                                        <img src="../wp-content/uploads/2024/09/icon-door.svg"> 
                                                        <span class="feature-label">Doors</span>
                                                    </label>
                                                    <span class="feature-value">${product.doors}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="perfect-fleet-footer">
                                            <div class="perfect-fleet-pricing">
                                                <h2>₹${totalPrice}</h2>
                                            </div>
                                            <div class="perfect-fleet-btn">
                                                <a href="<?=base_url()?>single-car?product_uid=${product.product_id}" 
                                                class="section-icon-btn">
                                                    <img src="<?=base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/images/arrow-white.svg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`;
                });
            } else {
                html = `<p>No products found for the selected categories.</p>`;
            }

            // Update the products container
            $('#cars').html(html);
        },
        error: function (err) {
            console.error('Error fetching products:', err);
            $('#cars').html(`<p>Error fetching products. Please try again later.</p>`);
        }
    });
}

    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        } else {
            return text;
        }
    }

        
load_all_products();
get_parent_categories();

</script>