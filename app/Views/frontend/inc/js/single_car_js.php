<script>
     $(document).ready(function () {
        loadProductCarousel();
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_uid');
    $.ajax({
        url: "<?= base_url('api/product') ?>",
        type: "GET",
        data: {p_id:productId},
        success: function (resp) {
            console.log('product', resp)
            let htmlTitle=``;
            let htmlPrice=``;
            let htmlDesc=``;
            let htmlDoors=``;
            // console.log('uid', serviceId)
            // resp = JSON.parse(resp)
            // console.log(resp.user_data.number)
            if (resp.status) {
               htmlTitle=`${resp.data.name}`
               htmlPrice=`${resp.data.base_price}`
               htmlDesc=`${resp.data.description}`
               htmlDoors=`${resp.data.doors}`
                
                // whatsapp_number=resp.data.service_contact
                $('#product_title').html(htmlTitle)
                $('#product_price').html(htmlPrice)
                $('#product_description').html(htmlDesc)
                $('#product_doors').html(htmlDoors)
                $('#product_title_2').html(htmlTitle)
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


</script>