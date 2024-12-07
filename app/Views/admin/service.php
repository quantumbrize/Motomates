<style>
    /* Make the table responsive */
#service_page_data_table {
    width: 100%;
    table-layout: fixed; /* Ensure columns don't stretch beyond a certain width */
}

#service_page_data_table_wrapper {
    max-height: 500px; /* Adjust this to control the height of the table body */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden; /* Hide horizontal overflow */
    display: block; /* Make the wrapper block-level to apply overflow styles */
}

#service_page_data_table thead,
#service_page_data_table tbody {
    display: table; /* Ensure header and body are treated as a table */
    width: 100%;
    table-layout: fixed;
}

#service_page_data_table thead {
    position: sticky;
    top: 0;
    background-color: white; /* Optional: Add a background color for the sticky header */
    z-index: 2; /* Ensure the header stays above the table body when scrolling */
}

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
                            <input type="file" id="file-input-service" multiple>
                            <label for="file-input-service" id="btn_upload" class="btn btn-success">
                                <i class="fas fa-upload"></i> &nbsp; Select Service Image
                            </label>
                            <p id="num-of-files"></p>
                            <div id="images"></div>
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
        <div class="row">
            <div class="col-xl-12 col-lg-12">
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
                                    <th>Card Data</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-banner-list-all-body">
                                <!-- Rows will be dynamically populated here by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>


    </div>
    <!-- container-fluid -->
</div>