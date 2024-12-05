<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add  Blog</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                           
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div id="createproduct-form">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-label" for="product-image-input">Blog Image</label>
                                    <input type="file" id="file-input-blog"  multiple>
                                    <label for="file-input-blog" class="btn btn-success">
                                        <i class="fas fa-upload"></i> &nbsp; Select Blog Image
                                    </label>
                                    <p id="num-of-files"></p>
                                    <div id="images"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="blog_title">Title</label>
                                <input type="text" class="form-control" id="blog_title" value=""
                                    placeholder="Enter Title" required="">
                                <div class="invalid-feedback">Please Enter Title.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="blog_description">Description</label>
                                <input type="text" class="form-control" id="blog_description" value=""
                                    placeholder="Enter Description" required="">
                                <div class="invalid-feedback">Please Enter Description.</div>
                                
                               
                                <input type="hidden" class="form-control" id="blog_uid" value=""
                                    placeholder="Enter Description" required="">
                                
                            </div>
                        </div>
                    </div>


                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                            <label class="form-label" for="frontend-meta-author">meta-author</label>
                                <input type="text" class="form-control" id="frontend-meta-author" value=""
                                    placeholder="Enter meta-author" required="">
                                <div class="invalid-feedback">Please Enter meta-author.</div>

                                
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                            <label class="form-label" for="frontend-copyright">copyright</label>
                                <input type="text" class="form-control" id="frontend-copyright" value=""
                                    placeholder="Enter meta-author" required="">
                                <div class="invalid-feedback">Please Enter copyright</div>

                                
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                            <div class="frontend-tag-input-section">
                                <input type="text" id="frontend-tag-input" placeholder="Enter a tag" class="form-control"><br>
                                <button id="add-frontend-tag" class="btn btn-primary">Add Tag</button>

                                <div id="selected-frontend-tags" class="selected-frontend-tags">
                                    
                                </div>

                                <button id="submit-frontend-tags" class="btn btn-success mt-3">Submit Tags</button>
                            </div>

                                
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="card">
                        <div class="card-body">
                            <div>
                                <label>About Us</label>
                                <div id="ckeditor-classic">

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Address</label>
                                <input type="text" class="form-control" id="address" value=""
                                    placeholder="Enter address" required="">
                                <div class="invalid-feedback">Please Enter Address.</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Phone No 1</label>
                                        <input type="text" class="form-control" id="phoneNo1" value=""
                                            placeholder="Enter Phone no 1" required="">
                                        <div class="invalid-feedback">Please Enter Phone no 1.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">WhatsApp</label>
                                        <input type="text" class="form-control" id="phoneNo2" value=""
                                            placeholder="Enter Phone no " required="">
                                        <div class="invalid-feedback">Please Enter WhatsApp Number</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">MAP</label>
                                <input type="text" class="form-control" id="map" value=""
                                    placeholder="Enter Map Url" required="">
                                <div class="invalid-feedback">Please Enter MAP URL</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Email</label>
                                <input type="text" class="form-control" id="email" value=""
                                    placeholder="Enter Email" required="">
                                <div class="invalid-feedback">Please Enter Email</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div>
                                <label>Mission</label>
                                <div id="ckeditor-classic1">

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div>
                                <label>Vision</label>
                                <div id="ckeditor-classic2">

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end card -->

                </div>
                <!-- end col -->

                
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <div class="text-start mb-3">
            <button class="btn btn-success w-sm" id="blog_update_btn">Update Blog</button>
            <button class="btn btn-success w-sm" id="blog_add_btn">Add Blog</button>
        </div>
        
        
    </div>
    <!-- container-fluid -->
    <div class="row">

<div class="col-xl-12 col-lg-12">
    <div>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <!-- <div>
                            <a href="<?= base_url('/admin/live-classes/add') ?>" class="btn btn-success"
                                id="addproduct-btn">
                                <i class="ri-add-line align-bottom me-1"></i>
                                Add Class Link
                            </a>
                        </div> -->
                    </div>
                    <div class="col-sm" style="display: none;">
                        <div class="d-flex justify-content-sm-end">
                            <div class="search-box ms-2">
                                <input type="text" class="form-control" id="searchProductList"
                                    placeholder="Search Products...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                    href="#productnav-all" role="tab">
                                    All <span id="all_banner_count"
                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1"></span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                    href="#productnav-published" role="tab">
                                    Published <span 
                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                    href="#productnav-draft" role="tab">
                                    Draft<span 
                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">0</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="col-auto">
                        <div id="selection-element">
                            <div class="my-n1 d-flex align-items-center text-muted">
                                Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                Result <button type="button"
                                    class="btn btn-link link-danger p-0 ms-3 material-shadow-none"
                                    data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card header -->
            <div class="card-body">

                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="productnav-all" role="tabpanel">

                        <table id="table-banner-list-all" class="table nowrap align-middle table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Blog Title</th>
                                    <th>Blog Description</th>
                                    <th>Action</th>
                                    <!-- <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th> -->
                                </tr>
                            </thead>
                            <tbody id="table-banner-list-all-body">
                                
                            </tbody>
                        </table>

                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="productnav-published" role="tabpanel">
                        <div id="table-product-list-published" class="table-card gridjs-border-none"></div>
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
                        <div class="py-4 text-center">
                            <h5 class="mt-4">Sorry! No Result Found</h5>
                        </div>
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end col -->
</div>
</div>