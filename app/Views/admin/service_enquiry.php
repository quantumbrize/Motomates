
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
            <div><h2>Enquiry</h2>
        </div>
        <div id="service_page_data_table_wrapper">
            <table id="service_enquiry_data_table" class="table nowrap align-middle table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Phone</th>
                        <th>Enquiry Details</th>
                        <th>Service Title</th>
                        <!-- <th>Service Title</th> -->
                        <!-- <th>Service UID</th> -->
                        
                    </tr>
                </thead>
                <tbody id="service_enquiry_data_table_body">
                    <!-- Rows will be dynamically populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        
    </div>
</div>
        