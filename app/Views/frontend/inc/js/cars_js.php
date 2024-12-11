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

                        $.each(resp.data, function (index, product) {
                            console.log('productall', product);
                            html+=`<div class="col-lg-4 col-md-6">
                            <div class="perfect-fleet-item fleets-collection-item">
                                    <div class="image-box"><a href="<?=base_url()?>single-car?product_uid=${product.product_id}"><img fetchpriority="high" width="410" height="234" src="<?=base_url()?>public/uploads/product_images/${product.src}" class="attachment-novaride-thumb size-novaride-thumb wp-post-image" alt="" decoding="async"></a></div>    
                                    <div class="perfect-fleet-content">
                                        <div class="perfect-fleet-title">
                                                                                                <h3><a href="<?=base_url()?>single-car?product_uid=${product.product_id}>${product.manufacturer_name}r</a></h3>
                                                                                                <h2><a href="<?=base_url()?>single-car?product_uid=${product.product_id}">${product.name}</a></h2>                                        </div>
                                        
                                        <div class="perfect-fleet-body">
                                            <ul><li><label><img src="../wp-content/uploads/2024/09/icon-door.svg"> <span class="feature-label">Doors</span></label><span class="feature-value"> ${product.doors}</span></li><li><label><img src="../wp-content/uploads/2024/09/icon-passengers.svg"> <span class="feature-label">Passengers</span></label><span class="feature-value"> 2</span></li></ul>                                        </div>

                                        <div class="perfect-fleet-footer">
                                            <div class="perfect-fleet-pricing">
                                                <h2>${product.base_price}<span>/Per Day</span></h2>                                            </div>
                                            <div class="perfect-fleet-btn">
                                                <a href="<?=base_url()?>single-car?product_uid=${product.product_id}" class="section-icon-btn"><img src="<?=base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/images/arrow-white.svg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        `

                        

                            // Add cards data if it exists
                        
                        });

                        // Append the rows to the table
                        $('#cars').html(html);

                        // Reinitialize DataTable if needed
                    
                    } else {
                        $('#products_home').html(`
                            <P>
                                No Data Found
                            </p>
                        `);
                    }
                } else {
                    $('#products_home').html(`
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
                            html += `<li class="elementor-icon-list-item">
																<a href="<?= base_url()?>all-category">

																	<span class="elementor-icon-list-icon">
																		<svg xmlns="http://www.w3.org/2000/svg"
																			width="14" height="14" viewbox="0 0 14 14"
																			fill="none">
																			<path
																				d="M11.6654 3.97592L1.64141 13.9999L-0.00537109 12.3531L10.0174 2.32914H1.18372V-0.00012207H13.9946V12.8108H11.6654V3.97592Z"
																				fill="white"></path>
																		</svg> </span>
																	<span class="elementor-icon-list-text">${category.name}</span>
																</a>
															</li>`
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
        
load_all_products();
get_parent_categories();

</script>