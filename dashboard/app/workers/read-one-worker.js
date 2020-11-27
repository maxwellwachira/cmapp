$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-product-button', function(){
        // get product id
		var id = $(this).attr('data-id');
		// read product record based on given ID
		$.getJSON("http://localhost/cmapp/cmapp_web/dashboard/api/product/read_one.php?id=" + id, function(data){
    		// start html

			var read_one_product_html=`
			 
			    <!-- when clicked, it will show the product's list -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <i class = "fa fa-list"></i> Read Farm Employees
			    </div>
			    <!-- product data will be shown in this table -->
				<table class='table table-bordered table-hover'>
				 
				    <!-- product name -->
				    <tr>
				        <td class='w-30-pct'>Name</td>
				        <td class='w-70-pct'>` + data.device_name + `</td>
				    </tr>
				 
				    <!-- location  -->
				    <tr>
				        <td>Mobile Number</td>
				        <td>` + data.location + `</td>
				    </tr>
				 
				    <!-- technician_name description -->
				    <tr>
				        <td>Task</td>
				        <td>` + data.technician_name + `</td>
				    </tr>
				 
				    <!-- product category name -->
				    <tr>
				        <td>Expected Completion Duration</td>
				        <td>` + data.category_name + `</td>
				    </tr>
				 
				</table>`;
				// inject html to 'page-content' of our app
				$("#page-content").html(read_one_product_html);
				 
				// chage page title
				changePageTitle("Create New Employee");
		});
    });
 
});