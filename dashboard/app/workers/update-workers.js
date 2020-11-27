$(document).ready(function(){
 
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-product-button', function(){
        // get product id
		var id = $(this).attr('data-id');
		// read one record based on given product id
		$.getJSON("http://localhost/cmapp/cmapp_web/dashboard/api/product/read_one.php?id=" + id, function(data){
		 
		    // values will be used to fill out our form
		    var device_name = data.device_name;
		    var location = data.location;
		    var technician_name = data.technician_name;
		    var category_id = data.category_id;
		    var category_name = data.category_name;
		     
		    // load list of categories
			$.getJSON("http://localhost/cmapp/cmapp_web/dashboard/api/category/read.php", function(data){
			 
			    // build 'categories option' html
			    // loop through returned list of data
			        var categories_options_html=`<select name='category_id' class='form-control'>`;
			 
			        $.each(data.records, function(key, val){
			            // pre-select option is category id is the same
			            if(val.id==category_id){ categories_options_html+=`<option value='` + val.id + `' selected>` + val.name + `</option>`; }
			 
			            else{ categories_options_html+=`<option value='` + val.id + `'>` + val.name + `</option>`; }
			        });
			        categories_options_html+=`</select>`;
			     
			    // store 'update product' html to this variable
				var update_product_html=`
				    <div id='read-products' class='btn btn-primary float-right m-b-15px read-products-button'>
				        <i class = "fa fa-list"></i> Read All Farm Employees
				    </div>

				    <!-- build 'update product' html form -->
					<!-- we used the 'required' html5 property to prevent empty fields -->
					<div class = 'container'>
					<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-7'>
					<form id='update-product-form' action='#' method='post' border='0'>
					    <table class='table table-bordered table-hover'>
					 
					        <!-- name field -->
					        <tr>
					            <td>Name</td>
					            <td><input value=\"` + device_name + `\" type='text' name='device_name' class='form-control' required /></td>
					        </tr>
					 
					        <!-- location field -->
					        <tr>
					            <td>Mobile Number</td>
					            <td><input value=\"` + location + `\" type='text'  name='location' class='form-control' required /></td>
					        </tr>
					 
					        <!-- technician_name field -->
					        <tr>
					            <td>Task</td>
					            <td><textarea name='technician_name' class='form-control' required>` + technician_name + `</textarea></td>
					        </tr>
					 
					        <!-- categories 'select' field -->
					        <tr>
					            <td>CExpected Completion Duration</td>
					            <td>` + categories_options_html + `</td>
					        </tr>
					 
					        <tr>
					 
					            <!-- hidden 'product id' to identify which record to delete -->
					            <td><input value=\"` + id + `\" name='id' type='hidden' /></td>
					 
					            <!-- button to submit form -->
					            <td>
					                <button type='submit' class='btn btn-info'>
					                    <i class = "fa fa-edit"></i> Update Employee
					                </button>
					            </td>
					 
					        </tr>
					 
					    </table>
					</form>
					</div>
					</div>
					</div>`;
					// inject to 'page-content' of our app
					$("#page-content").html(update_product_html);
					 
					// chage page title
					changePageTitle("Update Employee");
			});
		});
    });
     
    // will run if 'create product' form was submitted
	$(document).on('submit', '#update-product-form', function(){
	     
	    // get form data
		var form_data=JSON.stringify($(this).serializeObject());
	     // submit form data to api
		$.ajax({
		    url: "http://localhost/cmapp/cmapp_web/dashboard/api/product/update.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        // product was created, go back to products list
		        showProductsFirstPage();
		    },
		    error: function(xhr, resp, text) {
		        // show error to console
		        console.log(xhr, resp, text);
		    }
		});

	    return false;
	});
});