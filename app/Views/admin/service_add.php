

<div class="container-fluid" style="margin-top:100px;">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Service</h4>
                </div>
            </div>
        </div>
         
        <!-- end page title -->

        <div id="createproduct-form">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Name -->
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="page_name">Page Name</label>
                                <input type="text" class="form-control" id="page_name" placeholder="Enter page name" required>
                                <div class="invalid-feedback">Please Enter Page Name.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Image Upload -->
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label" for="file-input-service">Service Image</label>
                            <!-- File input remains hidden -->
                            <input type="file" id="file-input-service" multiple style="display: none;">
                            <!-- Styled button for file upload -->
                            <label for="file-input-service" id="btn_upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Service Image
                            </label>
                            <p id="num-of-files"></p>
                            <div id="images"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label class="form-label" for="file-input-service-icon">Service Icon</label>
                            <!-- File input remains hidden -->
                            <input type="file" id="file-input-service-icon" multiple style="display: none;">
                            <!-- Styled button for file upload -->
                            <label for="file-input-service-icon" id="btn_upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Service Icon
                            </label>
                            <p id="num-of-icons"></p>
                            <div id="icons" ></div>
                        </div>
                    </div>


                    <!-- Service Title -->
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="service_title">Service Title</label>
                                <input type="text" class="form-control" id="service_title" placeholder="Enter service title" required>
                                <div class="invalid-feedback">Please Enter Service Title.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Description -->
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="service_description">Service Description</label>
                                <textarea class="form-control" id="service_description" placeholder="Enter service description" required></textarea>
                                <div class="invalid-feedback">Please Enter Service Description.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Tags -->
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="service-tag-input-section">
                                    <label for="service_tags_input" class="form-label">Service Tags</label>
                                    <input type="text" id="service_tags_input" placeholder="Enter a tag" class="form-control">
                                    <!-- <label for="service_tags_icon_input" class="form-label">Service Tag Icon</label>
                                    <input type="text" id="service_tags_icon_input" placeholder="Enter a tag icon" class="form-control"> -->
                                    <button id="add-service-tag" class="btn btn-primary mt-2">Add Tag</button>
                                    <div id="selected-service-tags" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="service-tag-input-section">
                                    <label for="service_card_image" class="form-label">Card Image</label>
                                    <input type="file" id="service_card_image" class="form-control">
                                    <label for="service_card_title" class="form-label">Service Card Title</label>
                                    <input type="text" id="service_card_title" placeholder="Enter a card title" class="form-control">
                                    <label for="service_card_description" class="form-label">Service Card Description</label>
                                    <input type="text" id="service_card_description" placeholder="Enter a card description" class="form-control">
                                    <button id="add-service-card" class="btn btn-primary mt-2">Add Card</button>
                                    <div id="selected-service-cards" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="service_owner_contact">Service Owner Contact</label>
                                <input type="text" class="form-control" id="service_owner_contact" placeholder="Service Owner Contact" required>
                                <div class="invalid-feedback">Please Enter Service Owner Contacte.</div>
                            </div>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="text-start mb-3">
                        <button class="btn btn-success w-sm" id="service_add_btn">Submit</button>
                        <!-- <button class="btn btn-success w-sm" id="service_update_btn">Update</button> -->
                        <input type="hidden" id="s_uid">
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:80px;">
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