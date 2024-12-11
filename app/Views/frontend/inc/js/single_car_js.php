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
               htmlDoors=`${resp.data.doors}`
               htmlmake=`${resp.data.make}`
               htmlmodel=`${resp.data.model}`
               htmlyear=`<img src="${yearIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.year}</span>`
               htmlmileage=`<img src="${mileageIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.mileage}</span>`
               htmllocation=`<img src="${locationIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.location}</span>`
              
               htmlbadge=`<img src="${badgeIconsrc}" width="30"> &nbsp; <span class="elementor-icon-list-text">${resp.data.badges}</span>`
                if((resp.data.base_price)!=null && (resp.data.base_discount)!=null && (resp.data.tax)!=null){
                    totalPrice= resp.data.base_price - resp.data.base_discount-(resp.data.tax*resp.data.base_price/100);
                    htmlPrice=`<div style="background-color:#FF3600;padding:20px;color:white;font-size:25px">
                                    <div style="display: flex; justify-content: flex-start; gap: 10px;">
                                        <span>Base Price:<b> ${resp.data.base_price}</b></span>
                                        <span>Discount: <b>${resp.data.base_discount}</b></span>
                                        <span>Tax: <b>${resp.data.tax}</b></span>
                                    </div>
                                    <div style="margin-top: 10px;">Total Price: <b>${totalPrice}</b></div>
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


</script>