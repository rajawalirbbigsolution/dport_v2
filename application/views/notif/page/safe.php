<div class="table-responsive" style="border-top: none;">

    <table class="table projects" name="myTable" id="data" style="border-top: none">

        <thead>

            <tr>
                <th colspan="11">
                    <div class="row p-2">
                        <!--                <div class="col-md-2">-->
                        <!--                    <input class="form-control search-input" type="text" placeholder="Promo Name" style="height: 100%">-->
                        <!--                </div>-->
                        <!--                <div class="col-md-2">-->
                        <!--                    <select class="form-control search-input" type="text" placeholder="Promo Name" style="height: 100%">-->
                        <!--                        <option>PRODUCT NAME</option>-->
                        <!--                        <option>CATEGORY</option>-->
                        <!--                        <option>BATCH NUMBER</option>-->
                        <!--                        <option>EXPIRED DATE</option>-->
                        <!--                        <option>LOCATION</option>-->
                        <!--                    </select>-->
                        <!--                </div>-->
                        <!--                <div class="col-md-2">-->
                        <!--                    <button class="btn btn-info btn-block btn-dws-add" style="background-color: #17a2b8 !important;">Search</button>-->
                        <!--                </div>-->
                        <!--                <div class="col-md-4">-->
                        <!--                </div>-->
                        <!-- <div class="col-md-2">
                            <input type="text" class="form-control form-control-sm" id="parameter" name="myInput" placeholder="Parameter">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm" name="status" id="filter-params">
                                    <option value="">--Filter--</option>
                                    <option value="1">SKU NUMBER</option>
                                    <option value="2">UPC NUMBER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-default btn-sm" id="filter-promo">
                                <i class="fa fa-filter" aria-hidden="true"></i> Search
                            </button>
                        </div> -->
                    </div>
                </th>
            </tr>

            <tr>
                <th data-field="module_name" data-editable="true" class="module_name">#</th>
                <th data-field="module_name" data-editable="true" class="module_name">SKU</th>
                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT NAME</th>
                <th data-field="module_name" data-editable="true" class="module_name">SAFETY STOCK</th>
                <th data-field="module_name" data-editable="true" class="module_name">QUANTITY</th>
                <th data-field="module_name" data-editable="true" class="module_name">OUTLET LOCATION</th>
                <th data-field="action"></th>

            </tr>
            <td>

            </td>

        </thead>

        <tbody></tbody>

    </table>

</div>

<div class="card-tools text-center" id="pagination"></div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("data");
        filter = input.value.toUpperCase();
        table = document.getElementById("parameter");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<script src="<?php echo base_url(); ?>assets/js-data/notif/get-safe.js" id="date"></script>    