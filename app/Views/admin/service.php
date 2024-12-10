<style>
/* General Table Styles */
#service_page_data_table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    table-layout: auto; /* Adjust column widths based on content */
}

#service_page_data_table th,
#service_page_data_table td {
    padding: 10px;
    border: 1px solid #ddd;
    word-wrap: break-word; /* Ensure long text wraps within the cell */
}

/* Adjust Specific Column Widths */
#service_page_data_table th:nth-child(8), /* Card Data */
#service_page_data_table td:nth-child(8) {
    width: 20%; /* Increase the width of the Card Data column */
}

#service_page_data_table th:nth-child(1), /* Sl No. */
#service_page_data_table td:nth-child(1) {
    width: 5%; /* Sl No. column width */
    text-align: center;
}

#service_page_data_table th:nth-child(6), /* Service Image */
#service_page_data_table td:nth-child(6) {
    width: 15%; /* Adjust image column width */
}

#service_page_data_table th, /* Other columns auto-adjust */
#service_page_data_table td {
    width: auto;
}

/* Scrollable Table */
#service_page_data_table_wrapper {
    max-height: 500px;
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: auto; /* Enable horizontal scrolling */
}

#service_page_data_table thead th {
    position: sticky; /* Sticky header */
    top: 0;
    background-color: #f8f9fa; /* Sticky header background */
    z-index: 2; /* Ensures header stays on top */
}
.preview-image {
    width: 100px; /* Set the desired width */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Ensure proper image fitting */
    border: 1px solid #ddd; /* Optional: Add a border for aesthetics */
    border-radius: 4px; /* Optional: Rounded corners */
    margin: 5px; /* Spacing between images */
}

</style>




</style>
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
                                <input type="text" class="form-control" id="service_description" placeholder="Enter service description" required>
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
                                    <label for="service_tags_icon_input" class="form-label">Service Tag Icon</label>
                                    <input type="text" id="service_tags_icon_input" placeholder="Enter a tag icon" class="form-control">
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
                        <button class="btn btn-success w-sm" id="service_update_btn">Update</button>
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
                                <th>Action</th>
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