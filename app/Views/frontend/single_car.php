<style>
	#categories_list {
		list-style: none;
		/* Remove bullets for the entire list */
		padding: 0;
		/* Optional: Remove padding */
		margin: 0;
		/* Optional: Remove margin */
	}

	#categories_list .cat-item {
		margin: 0;
		/* Optional: Adjust spacing between list items */
		padding: 0;
		/* Optional: Adjust padding for list items */
	}
	.popup {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        margin: 10% auto;
        width: 80%;
        max-width: 400px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .popup-content h3 {
        margin-top: 0;
        color: #ff3600;
    }

    .popup-content label {
        display: block;
        margin: 10px 0 5px;
    }

    .popup-content input,
    .popup-content textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        color: #333;
        font-size: 20px;
        cursor: pointer;
    }
	.price-details {
    background-color: #FF3600;
    padding: 20px;
    color: white;
    font-size: 25px;
    box-shadow: 10px 10px 10px grey;
    border-radius: 50px;
}

.price-summary {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
}

.price-summary span {
    text-align: center;
}

.total-price {
    margin-top: 10px;
    /* font-size: 15px; */
    text-align: left; /* Align the text to the left */
}

@media (max-width: 750px) {
    .price-summary span small,
    .price-summary span b,
    .total-price small,
    .total-price b {
        display: block;
    }
}
#price_label{
	font-size: 15px;
}
</style>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<main id="content" class="site-main post-8009 cars type-cars status-publish has-post-thumbnail hentry car-types-convertible-car car-types-coupe-car">
	<div class="page-header background-section" style="background-image: url('../../wp-content/uploads/2024/08/page-header-bg.jpg')">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-box">
						<h1 id="product_title" class="at-animation-heading-style-3"></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="page-fleets-single">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="car-single-sidebar">
						<div class="fleets-single-sidebar">
							<!-- <div class="fleets-single-sidebar-box">
								<div class="fleets-single-sidebar-pricing">
									<h3>Categories</h3>
									<div class="elementor-widget-container">
										<div id="categories_list"></div>
									</div>
								</div>

							</div> -->
							<div class="accordion" id="accordionExample">
								<div class="accordion-item">
									<h2 class="accordion-header" id="headingOne">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Categories
									</button>
									</h2>
									<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<div id="categories_list"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="sidebar-widget">
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="fleets-single-content">
						<div data-elementor-type="wp-post" data-elementor-id="8009" class="elementor elementor-8009">
							<div class="elementor-element elementor-element-3b6d0a9 e-flex e-con-boxed e-con e-parent" data-id="3b6d0a9" data-element_type="container">
								<div class="e-con-inner">
									<div class="elementor-element elementor-element-3a955a2 e-con-full e-flex e-con e-child" data-id="3a955a2" data-element_type="container">
										<div class="elementor-element elementor-element-4e5d329 elementor-pagination-position-inside fleets-slider elementor-widget elementor-widget-image-carousel" data-id="4e5d329" data-element_type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;1&quot;,&quot;navigation&quot;:&quot;dots&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;effect&quot;:&quot;slide&quot;,&quot;speed&quot;:500,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="image-carousel.default">
											<div class="elementor-widget-container">
												<div class="elementor-image-carousel-wrapper swiper" dir="ltr">
													<div class="elementor-image-carousel">
														<!-- The slides will be dynamically generated here -->
													</div>

												</div>
											</div>
										</div>
										<div class="elementor-element elementor-element-5f560c5 e-con-full e-flex elementor-invisible e-con e-child" data-id="5f560c5" data-element_type="container" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
											<div class="elementor-element elementor-element-9a011d1 elementor-position-left elementor-widget__width-initial fleets-benefits-item elementor-mobile-position-left elementor-widget-mobile__width-inherit elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="9a011d1" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-box.default">
												<div class="elementor-widget-container">
													<div class="elementor-icon-box-wrapper">



														<div class="elementor-icon-box-wrapper" style="display: flex; align-items: center;">
															<!-- Image icon for Car Make -->
															<img id="make_icon" style="width: 10%; margin-right: 10px;" src="<?= base_url() ?>public/uploads/icon_images/make.png" alt="Car Make Icon">

															<!-- Car Make Text -->
															<div class="elementor-icon-box-content">
																<h3 class="elementor-icon-box-title">
																	<span>Car Make</span>
																</h3>
																<p id="car_make" class="elementor-icon-box-description"></p>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="elementor-element elementor-element-9b8156b elementor-position-left elementor-widget__width-initial fleets-benefits-item elementor-mobile-position-left elementor-widget-mobile__width-inherit elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="9b8156b" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-box.default">
												<div class="elementor-widget-container">
													<div class="elementor-icon-box-wrapper">



														<div class="elementor-icon-box-wrapper" style="display: flex; align-items: center;">
															<!-- Image icon for Car Model -->
															<img id="model_icon" style="width: 10%; margin-right: 10px;" src="<?= base_url() ?>public/uploads/icon_images/model.png" alt="Car Model Icon">

															<!-- Car Model Text -->
															<div class="elementor-icon-box-content">
																<h3 class="elementor-icon-box-title">
																	<span>Car Model</span>
																</h3>
																<p id="car_model" class="elementor-icon-box-description"></p>
															</div>
														</div>


													</div>
												</div>
											</div>
										</div>

										<div class="elementor-element elementor-element-e301591 e-con-full e-flex e-con e-child" data-id="e301591" data-element_type="container">
											<div class="elementor-element elementor-element-f38a25d section-title at-heading-animation at-animation-heading-none elementor-invisible elementor-widget elementor-widget-heading" data-id="f38a25d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
												<div class="elementor-widget-container">
												</div>
											</div>
											<div class="elementor-element elementor-element-89954d3 at-heading-animation at-animation-heading-style-2 elementor-widget elementor-widget-heading" data-id="89954d3" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="heading.default">
												<div class="elementor-widget-container">
													<h2 class="elementor-heading-title elementor-size-default" id="product_title_big"></h2>
												</div>
											</div>
											<div class="elementor-element elementor-element-9639cef elementor-invisible elementor-widget elementor-widget-text-editor" data-id="9639cef" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
												<div class="elementor-widget-container">
													<p id="product_description"></p>
												</div>
											</div>
											<div class="elementor-element elementor-element-d5b5c55 fleets-amenities-list  elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-invisible elementor-widget elementor-widget-icon-list" data-id="d5b5c55" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100,&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="icon-list.default">
												<div class="elementor-widget-container">
													<ul class="elementor-icon-list-items">
														<li class="elementor-icon-list-item">
															

																<span id="year_span" class="elementor-icon-list-icon">
																	<!-- <i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Music System</span> -->
																</span>
															
														</li>
														<li class="elementor-icon-list-item">
															

																<span id="mileage_span" class="elementor-icon-list-icon">
																	<!-- <i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Toolkit</span> -->
															
														</li>
														<li class="elementor-icon-list-item">
															

																<span id="location_span" class="elementor-icon-list-icon">
																	<!-- <i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Abs System</span> -->
															
														</li>
														<li class="elementor-icon-list-item">
															

																<span id="badge_span" class="elementor-icon-list-icon">
																	<!-- <i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Bluetooth</span> -->
															
														</li>
														<li class="elementor-icon-list-item">
															

																<span id="doors_span" class="elementor-icon-list-icon">
																	<!-- <i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Bluetooth</span> -->
															
														</li>
														<!-- <li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Full Boot Space</span>
											</a>
									</li> -->
														<!-- <li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Usb Charger</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Aux Input</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Spare Tyre</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Power Steering</span>
											</a>
									</li>
								<li class="elementor-icon-list-item">
											<a href="#">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-check-circle"></i>						</span>
										<span class="elementor-icon-list-text">Power Windows</span>
											</a>
									</li> -->
													</ul>
												</div>
											</div>
										</div>
										<div class="elementor-element elementor-element-ac7be5e e-con-full e-flex e-con e-child" data-id="ac7be5e" data-element_type="container">

											<div id="product_price"></div>
											<div class="fleets-single-sidebar-btn">
												<div data-elementor-type="section" data-elementor-id="8438" class="elementor elementor-8438">
													<div class="elementor-element elementor-element-6983617 e-flex e-con-boxed e-con e-parent" data-id="6983617" data-element_type="container">
														<div class="e-con-inner">
															<div class="elementor-element elementor-element-bc3de4e booking-form elementor-widget elementor-widget-elementskit-popup-modal" data-id="bc3de4e" data-element_type="widget" data-settings="{&quot;ekit_we_effect_on&quot;:&quot;none&quot;}" data-widget_type="elementskit-popup-modal.default">
																<div class="elementor-widget-container">
																	<div class="ekit-wid-con"> <!-- Start Markup -->
																		<div class='ekit-popup-modal__toggler-wrapper'>
																			<!-- Button trigger modal -->
																			<button style="background-color:#ff3600;border-radius:50px;" type="button" class="elementskit-btn ekit-popup-btn ekit-popup-btn__filled ekit-popup__toggler ekit-popup-modal-toggler whitespace--normal"
																				data-bs-toggle="modal"
																				data-bs-target="#exampleModal">
																				<a style="color:white" href="#">Send Enquriy</a> </button>
																		</div>

																		<!-- Modal -->

																		<!-- End Markup -->
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<span>OR</span>
												<a  id="whatsappIcon"   rel="noopener noreferrer" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>

											</div>
											<!-- <div class="row" id="cars"></div> -->
										</div><!-- .elementskit-card END -->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	</div>
	</div>
	</div>
</main>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Send Enquiry</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div id="enquiryForm">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="enquiry_name" name="enquiry_name" required>

					<label for="email">Email:</label>
					<input type="email" class="form-control" id="enquiry_email" name="enquiry_email" required>

					<label for="phone">Phone Number:</label>
					<input type="text" class="form-control" id="enquiry_phone" name="enquiry_phone" required>

					<label for="subject">Subject:</label>
					<input type="text" class="form-control" id="enquiry_subject" name="enquiry_subject" required>

					<label for="enquiry">Enquiry:</label>
					<textarea id="enquiry_details" class="form-control" name="enquiry_details" rows="4" required></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" onclick="submit_enquiry()" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>


<div id="popup1" class="popup">
							<div class="popup-content">
								<span class="close" onclick="closePopup('popup1')">&times;</span>
								<p>Owner Contact: <span id="service_contact1"></span></p>
								
							</div>
						</div>