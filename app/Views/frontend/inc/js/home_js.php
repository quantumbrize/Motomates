<script>
    $(document).ready(function () {
        get_promotion_card();
        load_all_blog();
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


</script>