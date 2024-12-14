<style>
/* General Table Styles */
/* Limit table cell width and height */
#service_page_data_table td {
    max-width: 200px; /* Maximum width of a cell */
    height: 200px; /* Set fixed height for the cell */
    overflow: hidden; /* Hide overflowing content */
    word-wrap: break-word; /* Allow text to wrap within the cell */
    text-overflow: ellipsis; /* Add ellipsis (...) for overflowing text */
    white-space: normal; /* Allow wrapping for multiline text */
}

/* Limit table header cell width */
#service_page_data_table th {
    max-width: 200px;
    word-wrap: break-word;
}

/* Style images within table cells */
#service_page_data_table td img {
    max-width: 100%; /* Ensure images fit within the cell width */
    max-height: 100%; /* Ensure images fit within the cell height */
    display: block; /* Prevent inline issues */
    margin: 0 auto; /* Center images */
}

/* Optional: Adjust table layout to prevent overlapping */
#service_page_data_table {
    table-layout: auto; /* Let column widths adjust dynamically */
    width: 100%; /* Ensure the table takes full width */
}

/* Optional: Ensure the table fits within the container */
#service_page_data_table_wrapper {
    overflow-x: auto; /* Allow horizontal scrolling if needed */
}



</style>



<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Service</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-auto">
                <div>
                    <a href="<?= base_url('/admin/service/add') ?>" class="btn btn-success"
                        id="addproduct-btn">
                        <i class="ri-add-line align-bottom me-1"></i>
                        Add Service
                    </a>
                </div>
            </div>
            <!-- <div class="col-sm-auto">
                <div>
                    <a href="<?= base_url('/admin/product/bulk/edit') ?>" class="btn btn-success"
                        id="addproduct-btn">
                        <i class="ri ri-edit-line"></i>
                         Edit Service
                    </a>
                </div>
            </div> -->
         </div>
        <!-- end page title -->

        
        <div class="container" style="margin-top:10px;">
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
                <div class="card">
                    <div class="card-body">
                    <div id="service_page_data_table_wrapper">
                    <table id="service_page_data_table" class="table nowrap align-middle table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Service Page</th>
                                <th>Service Title</th>
                                <th>Service Description</th>
                                <th>Service Tags</th>
                                <th>Service Image</th>
                                <th>Service Owner Contact</th>
                                <th>Service Icon</th>
                                <th>Card Data</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="table-banner-list-all-body">
                            
                                
                            
                           
                        </tbody>
                    </table>

                    </div>

                    </div>
                </div>
        </div>
       


    </div>
    <!-- container-fluid -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                        <!-- <button class="btn btn-success w-sm" id="service_add_btn">Submit</button> -->
                        <button class="btn btn-success w-sm" id="service_update_btn">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="s_uid">
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        
        
      </div>
    </div>
  </div>
</div>