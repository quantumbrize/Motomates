<script>
    $(document).ready(function () {
        get_promotion_card();
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
</script>