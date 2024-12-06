<script>
		 function get_social_link(){
        $.ajax({
            url: "<?= base_url('api/get/social') ?>",
            type: "GET",
            data: {},
            success: function (resp) {
                // resp = JSON.parse(resp)
                // console.log(resp.user_data.number)
                if (resp.status) {
                    console.log('proc',resp);
                    
                    
					html=`<div class="elementor-social-icons-wrapper elementor-grid">
											<span class="elementor-grid-item">
												<a href="${resp.user_data.facebook}" class="elementor-icon elementor-social-icon elementor-social-icon-facebook-f elementor-repeater-item-7249e57"
													target="_blank">
													<span class="elementor-screen-only">Facebook-f</span>
													<i class="fab fa-facebook-f"></i> </a>
											</span>
											<span class="elementor-grid-item">
												<a href="${resp.user_data.twitter}" class="elementor-icon elementor-social-icon elementor-social-icon-x-twitter elementor-repeater-item-515a018"
													target="_blank">
													<span class="elementor-screen-only">X-twitter</span>
													<i class="fab fa-x-twitter"></i> </a>
											</span>
											<span class="elementor-grid-item">
												<a href="${resp.user_data.youtube}" class="elementor-icon elementor-social-icon elementor-social-icon-linkedin-in elementor-repeater-item-e288018"
													target="_blank">
													<span class="elementor-screen-only">Youtube</span>
													<i class="fab fa-youtube"></i> </a>
											</span>
											<span class="elementor-grid-item">
												<a href="${resp.user_data.instagram}" class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-repeater-item-d26b048"
													target="_blank">
													<span class="elementor-screen-only">Instagram</span>
													<i class="fab fa-instagram"></i> </a>
											</span>
										</div>`
                    
                    $('#contact_us_social').html(html);
                } else {
                    console.log(resp)
                }
            },
            error: function (err) {
                console.log(err)
            }
        })
    }
	get_social_link()
	</script>