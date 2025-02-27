<script>
    user_id = '<?= isset($_COOKIE['USER_user_id']) ? $_COOKIE['USER_user_id'] : '' ?>'
    // console.log(user_id)
    get_cart()
    let grand_total = ''
    function get_cart() {
        $.ajax({
            url: '<?= base_url('/api/user/cart') ?>',
            type: "GET",
            data: {
                user_id: user_id
            },
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    let subTotal = 0
                    $.each(resp.data, function(index, item) {
                        var original_price = item.product.base_discount ? (item.product.base_price - (item.product.base_price * item.product.base_discount / 100)) : item.product.base_price;
                        var base_price = item.product.base_discount ? item.product.base_discount : "";
                        subTotal += parseInt(original_price, 10) * parseInt(item.qty, 10)
                    })
                    $('.subtotal_amount').html(`₹`+subTotal)
                    grand_total = subTotal
                    $.ajax({
                        url: "<?= base_url('/api/taxes') ?>",
                        type: "GET",
                        success: function (response) {
                            if (response.status) {
                                console.log(response);
                                if (response.data.tax != '0' && response.data.tax != null && response.data.tax != "") {
                                    $('#tax_fee').html(`₹` + response.data.tax);
                                    grand_total +=  parseInt(response.data.tax, 10);
                                } else {
                                    $('#tax_fee').html(`<p style="color: green;">Free</p>`);
                                }

                                if (response.data.delivary_charge != '0' && response.data.delivary_charge != null && response.data.delivary_charge != "") {
                                    $('#delivary_charge').html(`₹` + response.data.delivary_charge);
                                    grand_total +=  parseInt(response.data.delivary_charge, 10);
                                } else {
                                    $('#delivary_charge').html(`<p style="color: green;">Free</p>`);
                                }
                                get_user_data()
                            } else {
                                console.log(response);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        },
                    });
                } else {
                }
            },
            error: function (err) {
                console.error(err)
            }
        })
    }



    let address_will = 'insert'
    function get_user_data() {
        $.ajax({
            url: "<?= base_url('api/user') ?>",
            type: "GET",
            success: function (resp) {
                console.log(resp)
                if (resp.status == true) {
                    
                    $('#full-name').val(resp.user_data.user_name)
                    $('#mobile-number').val(resp.user_data.number)
                    $('#email').val(resp.user_data.email)
                    if(resp.address != null && resp.address != ""){
                        $('#city').val(resp.address.city)
                        $('#country').val(resp.address.country)
                        $('#zip-code').val(resp.address.zipcode)
                        $('#district').val(resp.address.district)
                        $('#state').val(resp.address.state)
                        $('#locality').val(resp.address.locality)
                        address_will = 'update'
                        if(resp.user_data.user_name != "" && resp.user_data.number != "" && resp.user_data.email != "" && resp.address.city != "" && resp.address.country != "" && resp.address.zipcode != "" && resp.address.district != "" && resp.address.state != "" && resp.address.locality != "" && resp.user_data.user_name != null && resp.user_data.number != null && resp.user_data.email != null && resp.address.city != null && resp.address.country != null && resp.address.zipcode != null && resp.address.district != null && resp.address.state != null && resp.address.locality != null){
                            $('#payment_btn_mob').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout mobile-checkout-btn" type="button"  onclick="window.location.href='<?= base_url()?>payment'">Payment</button>`)
                            $('#payment_btn').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout desktop-checkout-btn" type="button"  onclick="window.location.href='<?= base_url()?>payment'">Payment</button>`)
                        } else {
                            $('#payment_btn_mob').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout mobile-checkout-btn btn_disabled" type="button" onclick="billing_icomplete()">Payment</button>`)
                            $('#payment_btn').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout desktop-checkout-btn btn_disabled" type="button" onclick="billing_icomplete()">Payment</button>`)
                        }
                    } else {
                        $('#payment_btn_mob').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout mobile-checkout-btn btn_disabled" type="button" onclick="billing_icomplete()">Payment</button>`)
                        $('#payment_btn').html(`<p class="total-price">₹ ${grand_total}</p><button class="checkout desktop-checkout-btn btn_disabled" type="button" onclick="billing_icomplete()">Payment</button>`)
                    }
                } else {
                    console.log(resp.message)
                }
            },
            error: function () {
            }
        })
    }

    function update_billing_address() {
        var name = $("#full-name").val()
        var number = $("#mobile-number").val()
        var email = $("#email").val()

        var city = $("#city").val()
        var country = $("#country").val()
        var zip = $("#zip-code").val()
        var district = $("#district").val()
        var state = $("#state").val()
        var locality = $("#locality").val()

        if (name == "") {
            $("#name_val").text("Please enter name!")
        } else {
            $("#name_val").text("")
        }
        if (number == "") {
            $("#number_val").text("Please enter number!")
        } else {
            $("#number_val").text("")
        }
        if (email == "") {
            $("#email_val").text("Please enter email!")
        } else {
            $("#email_val").text("")
        }

        if (city == "") {
            $("#city_val").text("Please enter city!")
        } else {
            $("#city_val").text("")
        }

        if (country == "") {
            $("#country_val").text("Please enter country!")
        } else {
            $("#country_val").text("")
        }

        if (zip == "") {
            $("#zip_val").text("Please enter zip-code!")
        } else {
            $("#zip_val").text("")
        }

        if (district == "") {
            $("#district_val").text("Please enter district!")
        } else {
            $("#district_val").text("")
        }
        if (state == "") {
            $("#state_val").text("Please enter state!")
        } else {
            $("#state_val").text("")
        }

        if (locality == "") {
            $("#locality_val").text("Please enter locality!")
        } else {
            $("#locality_val").text("")
        }

        if (name != "" && number != "" && email != "" && city != "" && country != "" && zip != "" && district != "" && state != "" && locality != "") {
            // alert("hello")
            var formData = new FormData();

            formData.append('name', name);
            formData.append('number', number);
            formData.append('email', email);
            formData.append('city', city);
            formData.append('country', country);
            formData.append('zip', zip);
            formData.append('district', district);
            formData.append('state', state);
            formData.append('locality', locality);
            formData.append('user_id', user_id);
            formData.append('address_will', address_will);
            console.log(formData.get('name'));

            $.ajax({
                url: "<?= base_url('/api/user/billing-address/update') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#update_profile').html(`<div class="spinner-border" role="status"></div>`)
                    $('#update_profile').attr('disabled', true)

                },
                success: function (resp) {
                    console.log(resp)

                    if (resp.status) {
                        Toastify({
                            text: resp.message.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: resp.status ? 'darkgreen' : 'darkred',
                            },

                        }).showToast();
                        get_user_data();
                    } else {
                        console.log(resp.status)
                        Toastify({
                            text: resp.message.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: resp.status ? 'darkgreen' : 'darkred',
                            },

                        }).showToast();
                    }


                    $('#alert').html(html)
                    console.log(resp)
                },
                error: function (err) {
                    console.log(err)
                },
                complete: function () {
                    $('#update_profile').html(`<i class="ri-edit-box-line align-middle me-2"></i> Update Profile`)
                    $('#update_profile').attr('disabled', false)
                }
            })
        }
    }

    function billing_icomplete(){
        Toastify({
            text: 'Complete your billing details'.toUpperCase(),
            duration: 3000,
            position: "center",
            stopOnFocus: true,
            style: {
                background: 'darkred',
            },

        }).showToast();
    }


</script>