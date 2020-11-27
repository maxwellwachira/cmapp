// product list html
function readProductsTemplate(data, keywords){
 
    var read_products_html=`
        <!-- search products form -->
        <form id='search-product-form' action='#' method='post'>
        <div class='input-group float-left w-30-pct'>
 
            <input type='text' value='` + keywords + `' name='keywords' class='form-control product-search-keywords' placeholder='Search Farm Employee...' />
 
            <span class='input-group-btn'>
                <button type='submit' class='btn btn-default' type='button'>
                    <i class = "fa fa-search"></i>
                </button>
            </span>
 
        </div>
        </form>
 
        <!-- when clicked, it will load the create product form -->
        <div id='create-product' class='btn btn-primary float-right m-b-15px create-product-button'>
            <i class = "fa fa-plus"></i> Add Farm Employee
        </div>
 
        <!-- start table -->
        <table class='table table-bordered table-hover'>
 
            <!-- creating our table heading -->
            <tr>
                <th class='w-25-pct'>Name</th>
                <th class='w-10-pct'>Mobile Phone</th>
                <th class='w-15-pct'>Expected Completion Duration</th>
                <th class='w-25-pct text-align-center'>Action</th>
            </tr>`;
 
 
    // loop through returned list of data
    $.each(data.records, function(key, val) {
 
        // creating new table row per record
        read_products_html+=`<tr>
 
            <td>` + val.device_name + `</td>
            <td>` + val.location + `</td>
            <td>` + val.category_name + `</td>
 
            <!-- 'action' buttons -->
            <td>
                <!-- read product button -->
                <button class='btn btn-primary m-r-10px read-one-product-button' data-id='` + val.id + `'>
                    <i class = "fa fa-eye"></i> Read
                </button>
 
                <!-- edit button -->
                <button class='btn btn-info m-r-10px update-product-button' data-id='` + val.id + `'>
                    <i class = "fa fa-edit"></i> Edit
                </button>
 
                <!-- delete button -->
                <button class='btn btn-danger delete-product-button' data-id='` + val.id + `'>
                   <i class = "fa fa-remove"></i> Delete
                </button>
            </td>
        </tr>`;
    });
 
    // end table
    read_products_html+=`</table>`;
    // pagination
    if(data.paging){
        read_products_html+="<ul class='pagination float-left margin-zero padding-bottom-2em'>";
     
            // first page
            if(data.paging.first!=""){
                read_products_html+="<li><a data-page='" + data.paging.first + "'>First Page</a></li>";
            }
     
            // loop through pages
            $.each(data.paging.pages, function(key, val){
                var active_page=val.current_page=="yes" ? "class='active'" : "";
                read_products_html+="<li " + active_page + "><a data-page='" + val.url + "'>" + val.page + "</a></li>";
            });
     
            // last page
            if(data.paging.last!=""){
                read_products_html+="<li><a data-page='" + data.paging.last + "'>Last Page</a></li>";
            }
        read_products_html+="</ul>";
    }
 
    // inject to 'page-content' of our app
    $("#page-content").html(read_products_html);
}