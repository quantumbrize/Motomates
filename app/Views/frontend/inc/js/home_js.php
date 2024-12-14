<script>
    $(document).ready(function () {
        get_promotion_card();
        load_all_blog();
        loadBannerImage();
        load_all_services();
        load_all_products();
        
    })
    function get_promotion_card(){
        $.ajax({
            url: "<?= base_url('/api/promotion-card/update') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status) {
                    console.log('promo',resp)
                
                $('#promotion_img_1').html(`<img loading="lazy" decoding="async" width="467" height="646"
											src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}"
											class="attachment-full size-full wp-image-896" alt="">`)
                $('#promotion_img_2').html(`<img loading="lazy" decoding="async" width="467" height="645"
											src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}"
											class="attachment-full size-full wp-image-897" alt="">`)
                $('#promotion_img_3').html(`<img loading="lazy" decoding="async" width="467" height="647"
											src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img3}"
											class="attachment-full size-full wp-image-898" alt="">`)
                $('#promotion_img_4').html(`<img loading="lazy" decoding="async" width="467" height="647"
											src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img4}"
											class="attachment-full size-full wp-image-899" alt="">`)
                // $('#imgLink1').val(resp.data.link1)
                // $('#images2').html(`<img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" alt="" style="max-width: 500px; max-height: 500px;">`)
                // $('#imgLink2').val(resp.data.link2)
                // $('#card_id').val(resp.data.uid)
                
                }else{
                    console.log(resp)
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }
    // function load_all_blog() {
    //     $.ajax({
    //         url: "<?= base_url('/api/all/blog') ?>",
    //         type: "GET",
    //         success: function (resp) {
    //             console.log('resp', resp)
    //             if (resp.status) {
    //                 if (resp.data.length > 0) {
    //                     let html = ``;

    //                     $.each(resp.data, function (index, blog) {
    //                         console.log('blogs', blog)

    //                         // Truncate the description to the first 15 words
    //                         let truncatedDescription = truncateText(blog.blog_description, 15);
    //                         console.log('tdesc',truncatedDescription)

    //                         html += `<div class="col-lg-12 col-md-12">

    //                                     <div class="elementskit-post-image-card">
    //                                         <div class="elementskit-entry-header">
    //                                             <a href="#"
    //                                                 class="elementskit-entry-thumb">
    //                                                 <img decoding="async"
    //                                                     src="<?= base_url()?>public/uploads/blog_images/${blog.blog_image}"
    //                                                     alt="Exploring your rental car options: sedan, suv, or convertible?">
    //                                             </a>
    //                                         </div>

    //                                         <div class="elementskit-post-body ">

    //                                             <div class="post-meta-list">
    //                                                 <span class="meta-date">

    //                                                     <i aria-hidden="true" class="fas fa-calendar-alt"></i>
    //                                                     <span class="meta-date-text">
    //                                                         ${blog.created_at} </span>
    //                                                 </span>
    //                                             </div>

    //                                             <h2 class="entry-title">
    //                                                 <a
    //                                                     href="#">
    //                                                     ${blog.blog_title} </a>
    //                                             </h2>
    //                                             <p style="color:black" class="entry-description">
                                                    
    //                                                 ${truncatedDescription}
    //                                             </p>
    //                                             <div class="btn-wraper">
    //                                                 <a href="#">
    //                                                     read story <svg xmlns="http://www.w3.org/2000/svg"
    //                                                         width="25" height="25" viewbox="0 0 25 25" fill="none">
    //                                                         <rect x="0.0129395" y="0.436523" width="24" height="24"
    //                                                             rx="12" fill="#FF3600"></rect>
    //                                                         <path
    //                                                             d="M14.3483 10.9245L9.33633 15.9365L8.51294 15.1131L13.5243 10.1012H9.10748V8.93652H15.5129V15.342H14.3483V10.9245Z"
    //                                                             fill="white"></path>
    //                                                     </svg> </a>

    //                                             </div>
    //                                         </div>
    //                                     </div>

    //                                 </div>`;
    //                     });
    //                     $('#blog_posts').html(html);

    //                 } else {
    //                     $('#blog_posts').html(`
    //                         <p style="text-align:center;">
    //                             No Blog Posts
    //                         </p>`);
    //                 }
    //             } else {
    //                 $('#blog_posts').html(`
    //                     <p style="text-align:center;">
    //                         ${resp.message}
    //                     </p>
    //                 `);
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
            success: function (resp) {
                console.log('resp', resp)
                if (resp.status) {
                    if (resp.data.length > 0) {
                        let html = ``;
                        let htmlb = ``;

                        // Take the first blog post for the big blog post section
                        let firstBlog = resp.data[0];
                        // Truncate the description of the first blog post
                        let truncatedDescriptionb = truncateText(firstBlog.blog_description, 15);

                        htmlb = `<div class="col-lg-12 col-md-12">
                                    <div class="elementskit-post-image-card" onClick="window.location.href='<?= base_url('single-blog?blog_id=')?>${firstBlog.uid}'">
                                        <div  class="elementskit-entry-header">
                                            
                                                <img decoding="async"
                                                    src="<?= base_url()?>public/uploads/blog_images/${firstBlog.blog_image}"
                                                    alt="Top tips for booking your car rental: what you need to know" 
                                                    style="object-fit:contain;">
                                            
                                        </div>
                                        <div class="elementskit-post-body">
                                            <div class="post-meta-list">
                                                <span class="meta-date">
                                                    <i aria-hidden="true" class="fas fa-calendar-alt"></i>
                                                    <span class="meta-date-text">
                                                        ${firstBlog.created_at}
                                                    </span>
                                                </span>
                                            </div>
                                            <h2 class="entry-title">
                                                <a href="<?= base_url('single-blog?blog_id=')?>${firstBlog.uid}">
                                                    ${firstBlog.blog_title}
                                                </a>
                                            </h2>
                                            <p class="entry-description">
                                                ${truncatedDescriptionb}
                                                
                                            </p>
                                            <div class="btn-wraper">
                                                <a href="<?= base_url('single-blog?blog_id=')?>${firstBlog.uid}'"
                                                class="elementskit-btn whitespace--normal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewbox="0 0 14 14" fill="none">
                                                        <path
                                                            d="M11.6654 3.97592L1.64141 13.9999L-0.00537109 12.3531L10.0174 2.32914H1.18372V-0.00012207H13.9946V12.8108H11.6654V3.97592Z"
                                                            fill="white"></path>
                                                    </svg> 
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;

                        // Loop through the rest of the blog posts for the smaller list
                        $.each(resp.data.slice(1), function (index, blog) {
                            console.log('blogs', blog)

                            // Truncate the description to the first 15 words
                            let truncatedDescription = truncateText(blog.blog_description, 15);
                            console.log('tdesc', truncatedDescription)

                            html += `<div class="col-lg-12 col-md-12">
                                        <div class="elementskit-post-image-card">
                                            <div class="elementskit-entry-header" onClick="window.location.href='<?= base_url('single-blog?blog_id=')?>${blog.uid}'">
                                                
                                                    <img decoding="async"
                                                        src="<?= base_url()?>public/uploads/blog_images/${blog.blog_image}"
                                                        alt="Exploring your rental car options: sedan, suv, or convertible?"
                                                        style="object-fit:contain;">
                                                
                                            </div>
                                            <div class="elementskit-post-body">
                                                <div class="post-meta-list">
                                                    <span class="meta-date">
                                                        <i aria-hidden="true" class="fas fa-calendar-alt"></i>
                                                        <span class="meta-date-text">
                                                            ${blog.created_at}
                                                        </span>
                                                    </span>
                                                </div>
                                                <h2 class="entry-title">
                                                    <a href="<?= base_url('single-blog?blog_id=')?>${blog.uid}">
                                                        ${blog.blog_title}
                                                    </a>
                                                </h2>
                                                <p style="color:black" class="entry-description">
                                                    ${truncatedDescription}
                                                    
                                                </p>
                                                <div class="btn-wraper">
                                                    <a href='<?= base_url('single-blog?blog_id=')?>${blog.uid}'>
                                                        read story <svg xmlns="http://www.w3.org/2000/svg"
                                                                    width="25" height="25" viewbox="0 0 25 25" fill="none">
                                                            <rect x="0.0129395" y="0.436523" width="24" height="24"
                                                                rx="12" fill="#FF3600"></rect>
                                                            <path
                                                                d="M14.3483 10.9245L9.33633 15.9365L8.51294 15.1131L13.5243 10.1012H9.10748V8.93652H15.5129V15.342H14.3483V10.9245Z"
                                                                fill="white"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        });

                        // Populate the blog posts and the big blog post in their respective sections
                        $('#blog_posts').html(html);
                        $('#big_blog_post').html(htmlb);

                    } else {
                        $('#blog_posts').html(`
                            <p style="text-align:center;">
                                No Blog Posts
                            </p>`);
                    }
                } else {
                    $('#blog_posts').html(`
                        <p style="text-align:center;">
                            ${resp.message}
                        </p>
                    `);
                }
            },
            error: function (err) {
                console.log(err);
                $('#blog_posts').html(`<tr >
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

    // Function to truncate the description to the first N words
    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        } else {
            return text;
        }
    }

    function loadBannerImage() {
        $.ajax({
            url: "<?= base_url() ?>get/single/banner", // URL to fetch the banner image
            type: "GET",
            success: function (response) {
                console.log('banner',response)
                imageUrl= `<?= base_url()?>public/uploads/banner_images/${response.data.img}`
                if (response.status && imageUrl) {
                    // Assuming response.imageUrl contains the URL of the banner image
                    $('.elementor-9 .elementor-element.elementor-element-5983312')
                        .css('background-image', `url('${imageUrl}')`);
                } else {
                    console.error('Failed to retrieve banner image:', response.message);
                }
                htmlt=`${response.data.title}`
                htmld=`${response.data.description}`
                htmll=`${response.data.link}`

                $("#banner_heading").html(htmlt);
                $("#banner_description").html(htmld);
                $("#banner_description").html(htmld);
                $("#banner_link").attr('href', htmll);
            },
            error: function (error) {
                console.error('Error fetching banner image:', error);
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
    const serviceDropdown = document.getElementById('service');
    const cabOptions = document.getElementById('cab-options');
    const rentalSubmitButton = document.getElementById('rental-submit');
    const form = document.querySelector('form');

    // Show or hide Cab options based on Service type selection
    serviceDropdown.addEventListener('change', function() {
        if (this.value === 'only-cab') {
            cabOptions.style.display = 'block';  // Show the cab options dropdown
        } else {
            cabOptions.style.display = 'none';   // Hide the cab options dropdown
        }
    });

    // Handle form submission on rental-submit button click
    $('#rental_submit').click(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Gather all form values
        const fullName = document.getElementById('fname').value;
        const phone = document.getElementById('phone').value;
        const society = document.getElementById('society').value;
        const pickupTime = document.getElementById('departuretime').value;
        const pickupDate = document.getElementById('date').value;
        const returnTime = document.getElementById('returntime').value;
        const returnDate = document.getElementById('returndate').value;
        const serviceType = document.getElementById('service').value;
        const cabType = document.getElementById('cab-type') ? document.getElementById('cab-type').value : ''; // Only if visible

        // Prepare the data to send
        const formData = {
            fname: fullName,
            phone: phone,
            society: society,
            pickup_time: pickupTime,
            pickup_date: pickupDate,
            return_time: returnTime,
            return_date: returnDate,
            service_type: serviceType,
            cab_type: cabType
        };

        // Send the data using AJAX
        $.ajax({
            url: '<?=base_url()?>send-booking', // The URL to send the data to
            type: 'POST', // POST method
            data: formData, // The data to send
            success: function (response) {
                // Success Toastify Notification
                Toastify({
                    text: "Your booking has been successfully submitted!",
                    duration: 3000,
                    gravity: "top", // Display at the top
                    position: "center", // Align to right
                    backgroundColor: "green", // Success notification color
                    close: true
                }).showToast();
                console.log('Booking successful:', response);
                $("#fname").val('');
                $("#society").val('');
                $("#departuretime").val('');
                $("#date").val('');
                $("#returntime").val('');
                $("#returndate").val('');
                $("#service").val('');
                $("#cab-type").val('');
            },
            error: function (xhr, status, error) {
                // Error Toastify Notification
                Toastify({
                    text: "There was an error submitting your booking. Please try again later.",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red", // Error notification color
                    close: true
                }).showToast();
                console.error('Error during booking:', error);
            }
        });
    }); 
})


    function load_all_services() {
        $.ajax({
            url: "<?= base_url('/api/all/service') ?>",
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

                        $.each(resp.data, function (index, service) {
                            console.log('serviceall', service);
                            truncatedDescription=truncateText(service.service_description,50)
                            html+=`
                            <div class="elementor-element elementor-element-921e616 e-con-full service-item e-flex  e-con e-child"
							data-id="921e616" data-element_type="container"
							data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
							<div class="elementor-element elementor-element-e2a720b ekit-equal-height-disable elementor-widget elementor-widget-elementskit-icon-box"
								data-id="e2a720b" data-element_type="widget"
								data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}"
								data-widget_type="elementskit-icon-box.default">
								<div class="elementor-widget-container">
									<div class="ekit-wid-con"> <!-- link opening -->
										<!-- end link opening -->

										<div
											class="elementskit-infobox text-left text-left icon-top-align elementor-animation-   ">
											<div class="elementskit-box-header elementor-animation-">
												<div class="">
													<img style="width:30%" src="<?=base_url()?>public/uploads/service_images/${service.service_icon}">
												</div>
											</div>
											<div class="box-body">
												<h3 class="elementskit-info-box-title">
                                                    ${service.service_title} </h3>
												<p> ${truncatedDescription}</p>
												<div class="box-footer disable_hover_button">
													<div class="btn-wraper">
														<a href="<?= base_url()?>single-service?service_uid=${service.uid}"
															target="_self" rel=""
															class="elementskit-btn whitespace--normal elementor-animation-">
															<svg xmlns="http://www.w3.org/2000/svg" width="14"
																height="14" viewbox="0 0 14 14" fill="none">
																<path
																	d="M11.6654 3.97592L1.64141 13.9999L-0.00537109 12.3531L10.0174 2.32914H1.18372V-0.00012207H13.9946V12.8108H11.6654V3.97592Z"
																	fill="white"></path>
															</svg> </a>
													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>
                        `

                        

                            // Add cards data if it exists
                        
                        });

                        // Append the rows to the table
                        $('#all_services').html(html);

                        // Reinitialize DataTable if needed
                    
                    } else {
                        $('#all_services').html(`
                            <P>
                                No Data Found
                            </p>
                        `);
                    }
                } else {
                    $('#all_services').html(`
                        <p>
                            ${resp.message}
                        </p>
                    `);
                }
            },
            error: function (err) {
                console.log(err);
                $('#all_services').html(`
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
                            truncatedDescription=truncateText(product.description,50)
                            totalPrice= product.base_price - (product.base_discount*product.base_price/100)-(product.tax*product.base_price/100);
                            html+=`<div class="swiper-slide">
                            <a href="<?=base_url()?>single-car?product_uid=${product.product_id}">
											<div class="perfect-fleet-item">
												<div class="image-box"><a href="<?=base_url()?>single-car?product_uid=${product.product_id}"><img
															decoding="async" width="410" height="234"
															src="<?= base_url()?>public/uploads/product_images/${product.src}"
															class="attachment-novaride-thumb size-novaride-thumb wp-post-image"
															alt=""></a></div>
												<div class="perfect-fleet-content">
													<div class="perfect-fleet-title">
														<h3>${product.manufacturer_name}
														</h3>
														<h2>${product.name}
														</h2>
													</div>
                                                    <div class="perfect-fleet-title">
                                                        <p>
                                                           
                                                                ${truncatedDescription}
                                                            
                                                        </p>
                                                    
                                                    </div>

													<div class="perfect-fleet-body">
														<ul>
															<li><label><img decoding="async"
																		src="<?= base_url()?>public/assets/motomates/wp-content/uploads/2024/09/icon-door.svg">
																	<span
																		class="feature-label">Doors</span></label><span
																	class="feature-value"> ${product.doors}</span></li>
															
														</ul>
													</div>

													<div class="perfect-fleet-footer">
														<div class="perfect-fleet-pricing">
															<h2>₹ ${totalPrice}</h2>
														</div>
														<div class="perfect-fleet-btn">
															<a href="<?=base_url()?>single-car?product_uid=${product.product_id}"
																class="section-icon-btn"><img decoding="async"
																	src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/images/arrow-white.svg"
																	alt=""></a>
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
                        $('#products_home').html(html);

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
    const today = new Date().toISOString().split('T')[0];

// Set the min attribute for the date inputs
document.getElementById('date').setAttribute('min', today);
document.getElementById('returndate').setAttribute('min', today);
</script>