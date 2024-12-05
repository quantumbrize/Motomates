<script>
    
    $(document).ready(function() {
        load_single_blog_from_url();
    });

    
    function load_single_blog_from_url() {
    // Get the URL query parameter `blog_id`
    const urlParams = new URLSearchParams(window.location.search);
    const blogId = urlParams.get('blog_id');  // Get the value of `blog_id` from the URL

    if (blogId) {
        // Perform AJAX request to get the single blog post by its UID
        $.ajax({
            url: `<?= base_url('blog/get/single') ?>`,  // Endpoint to fetch the single blog post
            type: 'GET',
            data: { uid: blogId },  // Send the UID as data
            success: function (response) {
                console.log('Blog post response:', response);
                if (response.status) {
                    // Assuming the response contains the blog post data
                    let blog = response.data;  // The blog data object

                    // Create HTML structure to display the blog post
                    let blogHtml = `
                    <main id="content" class="site-main post-${blog.uid} post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                        <div class="page-single-post">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="post-single-image">
                                            <figure class="image-anime">
                                                <img fetchpriority="high" width="1366" height="768"
                                                    src="<?= base_url('public/uploads/blog_images/') ?>${blog.blog_image}"
                                                    class="attachment-large size-large wp-post-image" alt="${blog.blog_title}" decoding="async">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="post-content">
                                            <div class="post-entry novaride-block-style">
                                                <h2>${blog.blog_title}</h2>
                                                <p>${blog.blog_description}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>`;

                    // Insert the blog content into the page
                    $('#content').html(blogHtml);  // Assuming the page has a container with id `content`
                } else {
                    // Handle case where the blog post was not found or there was an error
                    $('#content').html(`
                        <p style="text-align:center;">
                            Blog post not found or error loading the data.
                        </p>
                    `);
                }
            },
            error: function (err) {
                console.log('Error loading blog post:', err);
                $('#content').html(`
                    <p style="text-align:center;">
                        Error loading blog post.
                    </p>
                `);
            }
        });
    } else {
        // If `blog_id` is not present in the URL, show a message
        $('#content').html(`
            <p style="text-align:center;">
                No blog post selected.
            </p>
        `);
    }
}

</script>