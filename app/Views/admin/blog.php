<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Blog</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0"></ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div id="createproduct-form">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label" for="file-input-blog">Blog Image</label>
                            <input type="file" id="file-input-blog" multiple>
                            <label for="file-input-blog" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Blog Image
                            </label>
                            <p id="num-of-files"></p>
                            <div id="images"></div> <!-- Image preview will be displayed here -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="blog_title">Title</label>
                                <input type="text" class="form-control" id="blog_title" placeholder="Enter Title" required>
                                <div class="invalid-feedback">Please Enter Title.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="blog_description">Description</label>
                                <input type="text" class="form-control" id="blog_description" placeholder="Enter Description" required>
                                <div class="invalid-feedback">Please Enter Description.</div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="blog_uid" value="" required>

                    <div class="text-start mb-3">
                        <button class="btn btn-success w-sm" id="blog_update_btn">Update Blog</button>
                        <button class="btn btn-success w-sm" id="blog_add_btn">Add Blog</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table-banner-list-all" class="table nowrap align-middle table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Blog Title</th>
                                    <th>Blog Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-banner-list-all-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
