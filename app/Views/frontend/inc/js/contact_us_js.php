<script>

$(document).ready(function () {
    // Attach the click event handler to the "Send Message" button
    $('#msgSubmit').on('click', function () {
        upload_form_data();  // Call the function to submit the form data via AJAX
    });
});
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
	function upload_form_data() {
    // Collect form data using FormData
		var formData = new FormData();

		// Append form fields to formData
		formData.append('first_name', $('#first_name').val());
		formData.append('last_name', $('#last_name').val());
		formData.append('email', $('#email').val());
		formData.append('phone', $('#phone').val());
		formData.append('message', $('#msg').val());

		// Send the form data via AJAX
		$.ajax({
			url: "<?= base_url() ?>submit/message",  // URL to send the form data to
			type: "POST",
			data: formData,
			contentType: false,  // Don't set content type as it's handled by FormData
			processData: false,  // Don't process data as query string
			beforeSend: function () {
				// You can show a loader here if you want
				$('#msgSubmit').prop('disabled', true);  // Disable submit button while submitting
				$('#msgSubmit').val('Sending...');
			},
			success: function (response) {
				// Handle response from server
				if (response.status) {
					// If submission is successful, show success message
					alert('Message sent successfully!');
					// Optionally reset form fields
					$('form')[0].reset();
				} else {
					// Show error message
					alert('Error: ' + response.message);
				}
			},
			error: function (err) {
				// Handle any errors in the AJAX request
				console.log(err);
				alert('Error sending message. Please try again.');
			},
			complete: function () {
				// Re-enable the submit button
				$('#msgSubmit').prop('disabled', false);
				$('#msgSubmit').val('Send Message');
			}
		});
	}


	get_social_link()
	</script>