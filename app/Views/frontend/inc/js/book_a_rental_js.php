<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const serviceDropdown = document.getElementById('service');
    const cabOptions = document.getElementById('cab-options');

    serviceDropdown.addEventListener('change', function() {
        // Show Cab Options if "Only Cab" is selected, else hide it
        if (this.value === 'only-cab') {
            cabOptions.style.display = 'block';  // Show the cab options dropdown
        } else {
            cabOptions.style.display = 'none';   // Hide the cab options dropdown
        }
    });
});

</script> -->
<script>
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
    const pickupLocation = document.getElementById('pickuplocation').value;
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
        pickup_location: pickupLocation,
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
                position: "right", // Align to right
                backgroundColor: "green", // Success notification color
                close: true
            }).showToast();
            console.log('Booking successful:', response);
        },
        error: function (xhr, status, error) {
            // Error Toastify Notification
            Toastify({
                text: "There was an error submitting your booking. Please try again later.",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "red", // Error notification color
                close: true
            }).showToast();
            console.error('Error during booking:', error);
        }
    });
});

});

</script>