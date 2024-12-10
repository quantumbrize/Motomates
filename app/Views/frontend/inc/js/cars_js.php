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

    load_all_products();
</script>