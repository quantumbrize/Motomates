<script>
     $(document).ready(function () {
        loadProductCarousel();
        get_parent_categories();
        
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_uid');
    $.ajax({
        url: "<?= base_url('api/product') ?>",
        type: "GET",
        data: {p_id:productId},
        success: function (resp) {
            console.log('product', resp)
            const makeIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.make_icon}`
            const modelIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.model_icon}`
            const yearIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.year_icon}`
            const mileageIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.mileage_icon}`
            const locationIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.location_icon}`
            const doorIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.doors_icon}`
            const badgeIconsrc=`<?=base_url()?>public/uploads/product_images/${resp.data.badge_icon}`
            let htmlTitle=``;
            let htmlPrice=``;
            let htmlDesc=``;
            let htmlDoors=``;
            // console.log('uid', serviceId)
            // resp = JSON.parse(resp)
            // console.log(resp.user_data.number)
            if (resp.status) {
               htmlTitle=`${resp.data.name}`
               
               htmlDesc=`${resp.data.description}`
            
               htmlmake=`${resp.data.make}`
               htmlmodel=`${resp.data.model}`
               htmlyear=`<img src="${yearIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.year}</span>`
               htmlmileage=`<img src="${mileageIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.mileage}</span>`
               htmllocation=`<img src="${locationIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.location}</span>`
               htmlDoors=`<img src="${doorIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.doors}</span>`
              
               htmlbadge=`<img src="${badgeIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.badges}</span>`
                if((resp.data.base_price)!=null && (resp.data.base_discount)!=null && (resp.data.tax)!=null){
                    totalPrice= resp.data.base_price - resp.data.base_discount-(resp.data.tax*resp.data.base_price/100);
                    htmlPrice=`<div style="background-color:#FF3600;padding:20px;color:white;font-size:25px">
                                    <div style="display: flex; justify-content: flex-start; gap: 10px;">
                                        <span>Base Price:<b>Rs ${resp.data.base_price}</b></span>
                                        <span>Discount: <b>${resp.data.base_discount}%</b></span>
                                        <span>Tax: <b>${resp.data.tax}%</b></span>
                                    </div>
                                    <div style="margin-top: 10px;">Total Price: <b>Rs ${totalPrice}</b></div>
                                </div>

                                `
                }
                // whatsapp_number=resp.data.service_contact
                $('#product_title').html(htmlTitle)
                
                $('#product_description').html(htmlDesc)
                $('#product_doors').html(htmlDoors)
                // $('#product_title_2').html(htmlTitle)
                $('#car_make').html(htmlmake)
                $('#car_model').html(htmlmodel)
                $('#year_span').html(htmlyear)
                $('#mileage_span').html(htmlmileage)
                $('#location_span').html(htmllocation)
                $('#badge_span').html(htmlbadge)
                $('#product_price').html(htmlPrice)
                $('#product_title_big').html(htmlTitle)
                $('#doors_span').html(htmlDoors)
            } else {
                console.log(resp)
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
        
});

// function loadProductCarousel() {
//     const urlParams = new URLSearchParams(window.location.search);
//     const productId = urlParams.get('product_uid');
//     $.ajax({
//         url: `<?= base_url('/api/product') ?>`, // Adjust if the endpoint needs query params or product ID
//         type: "GET",
//         data: { p_id: productId },
//         beforeSend: function () {
//             // Optional: Show a loading spinner while fetching data
//             $('.elementor-image-carousel').html(`
//                 <div class="loading-spinner">
//                     <div class="spinner-border" role="status">
//                         <span class="sr-only">Loading...</span>
//                     </div>
//                 </div>
//             `);
//         },
//         success: function (response) {
//             if (response.status && response.data) {
//                 const images = response.data.product_img;

//                 if (images && images.length > 0) {
//                     let carouselHtml = '';

//                     // Generate carousel slides for each image
//                     images.forEach((img, index) => {
//                         console.log('images', img.src);
//                         const imagesrc = `<?= base_url() ?>public/uploads/product_images/${img.src}`;
//                         carouselHtml += `
//                             <div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="${index + 1} of ${images.length}">
//                                 <figure class="swiper-slide-inner">
//                                     <img decoding="async" class="swiper-slide-image" src="${imagesrc}" alt="Product Image ${index + 1}">
//                                 </figure>
//                             </div>
//                         `;
//                     });

//                     // Update the carousel container with the slides
//                     $('.elementor-image-carousel').html(carouselHtml);

//                     // Ensure Swiper is properly initialized
//                     if (typeof Swiper !== 'undefined') {
//                         new Swiper('.elementor-image-carousel', {
//                             pagination: {
//                                 el: '.swiper-pagination',
//                                 clickable: true,
//                             },
//                             loop: true, // Ensure looping is enabled
//                             slidesPerView: 1, // Adjust as needed
//                             spaceBetween: 10, // Adjust space between slides
//                         });
//                     } else {
//                         console.error('Swiper is not defined. Make sure Swiper is included and loaded.');
//                     }
//                 } else {
//                     $('.elementor-image-carousel').html('<p>No images available for this product.</p>');
//                 }
//             } else {
//                 $('.elementor-image-carousel').html(`<p>${response.message || 'Failed to load product images.'}</p>`);
//             }
//         },
//         error: function (error) {
//             console.error('Error fetching product data:', error);
//             $('.elementor-image-carousel').html('<p>Error loading product images. Please try again later.</p>');
//         },
//     });
// }
    function loadProductCarousel() {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('product_uid');

        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            data: { p_id: productId },
            beforeSend: function () {
                $('.elementor-image-carousel').html(`
                    <div class="spinner-border" role="status" style="text-align:center;"></div>
                `);
            },
            success: function (resp) {
                if (resp.status && resp.data && resp.data.product_img) {
                    const images = resp.data.product_img;

                    if (images.length > 0) {
                        let carouselHtml = `
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                        `;

                        // Loop through the product images and create carousel slides
                        $.each(images, function (index, image) {
                            const imageSrc = `<?= base_url() ?>public/uploads/product_images/${image.src}`;
                            carouselHtml += `
                                <div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="${index + 1} of ${images.length}">
                                    <figure class="swiper-slide-inner">
                                        <img decoding="async" class="swiper-slide-image" src="${imageSrc}" alt="Product Image ${index + 1}">
                                    </figure>
                                </div>
                            `;
                        });

                        // Close the Swiper structure
                        carouselHtml += `
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        `;

                        // Update the carousel container with the slides
                        $('.elementor-image-carousel').html(carouselHtml);

                        // Initialize Swiper (Ensure Swiper is loaded)
                        if (typeof Swiper !== 'undefined') {
                            new Swiper('.swiper-container', {
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                loop: true,
                            });
                        }
                    } else {
                        $('.elementor-image-carousel').html('<p>No images available for this product.</p>');
                    }
                } else {
                    $('.elementor-image-carousel').html(`<p>${resp.message || 'No data found'}</p>`);
                }
            },
            error: function (err) {
                console.error('Error fetching product images:', err);
                $('.elementor-image-carousel').html('<p>Error loading product images. Please try again later.</p>');
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
                            html += `<li class="cat-item cat-item-12"><label><input type='checkbox'  onchange="get_product_by_category()" name='ofcar-types[]' value='${category.uid}'> ${category.name}</label></li>`
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
    // Get the selected checkbox value
        const categoryId = $('input[name="ofcar-types[]"]:checked').val();

        // Determine the API parameters based on whether a category is selected
        const data = categoryId ? { c_id: categoryId } : {}; // Send no data if no category is selected

        // Send the request to the API
        $.ajax({
            url: '<?= base_url() ?>api/product',
            type: "GET",
            data: data, // Send category_id if selected, otherwise send an empty object
            beforeSend: function () {
                console.log(
                    categoryId
                        ? `Fetching products for category: ${categoryId}`
                        : "Fetching all products (no category selected)."
                );
                $('#product_list').html(`<center><div class="spinner-border text-primary" role="status"></div></center>`);
            },
            success: function (resp) {
                console.log(resp);
                let html = '';

                if (resp.status && resp.data.length > 0) {
                    // Generate product list HTML
                    $.each(resp.data, (index, product) => {
                        html += `
                            <div class="col-lg-4 col-md-6">
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
                                            <h3>
                                                <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
                                                    ${product.manufacturer_name}
                                                </a>
                                            </h3>
                                            <h2>
                                                <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
                                                    ${product.name}
                                                </a>
                                            </h2>
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
                                                <li>
                                                    <label>
                                                        <img src="../wp-content/uploads/2024/09/icon-passengers.svg"> 
                                                        <span class="feature-label">Passengers</span>
                                                    </label>
                                                    <span class="feature-value">2</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="perfect-fleet-footer">
                                            <div class="perfect-fleet-pricing">
                                                <h2>${product.base_price}<span>/Per Day</span></h2>
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
                            </div>`;
                    });
                } else {
                    html = `<p>No products found.</p>`;
                }

                $('#cars').html(html); // Display products in the cars container
            },
            error: function (err) {
                console.log(err);
                $('#product_list').html(`<p>Error fetching products. Please try again later.</p>`);
            }
        });
    }


</script>