$(document).ready(function(){
 
    // show html form when 'create product' button was clicked
    $(document).on('click', '.create-product-button', function(){
        // load list of categories
		$.getJSON("http://localhost/cmapp/cmapp_web/dashboard/api/category/read.php", function(data){
		 
			// build categories option html
			// loop through returned list of data
			var categories_options_html=`<select name='category_id' class='form-control'>`;
			$.each(data.records, function(key, val){
			    categories_options_html+=`<option value='` + val.id + `'>` + val.name + `</option>`;
			});
			categories_options_html+=`</select>`;

			// we have our html form here where product information will be entered
			// we used the 'required' html5 property to prevent empty fields
			var create_product_html=`
			 
			    <!-- 'read products' button to show list of products -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <i class = "fa fa-list"></i>Read All Farm Employees
			    </div>
			    <div class = "container">
			    <div class = "row">
			    <div class = "col-md-3"></div>
			    <div class = "col-md-7">
			    <!-- 'create product' html form -->
				<form id='create-product-form' action='#' method='post' border='0'>
				    <table class='table table-hover table-responsive table-bordered'>
				 
				        <!--  Worker name field -->
				        <tr>
				            <td>Name</td>
				            <td><input type='text' name='device_name' class='form-control' required /></td>
				        </tr>
				 
				        <!-- contact field -->
				        <tr>
				            <td>Mobile Number</td>
				            <td><input type='text' name='location' class='form-control' required /></td>
				        </tr>
				 
				        <!--  field -->
				        <tr>
				            <td>Task</td>
				            <td><textarea name='technician_name' class='form-control' required/></textarea></td>
				        </tr>
				 
				        <!-- categories 'select' field -->
				        <tr>
				            <td>Expected Completion duration</td>
				            <td>` + categories_options_html + `</td>
				        </tr>
				 
				        <!-- button to submit form -->
				        <tr>
				            <td></td>
				            <td>
				                <button type='submit' class='btn btn-primary'>
				                   <i class = "fa fa-plus"></i> Add Worker
				                </button>
				            </td>
				        </tr>
				 
				    </table>
				</form>
				</div>`;

				// inject html to 'page-content' of our app

				$("#page-content").html(create_product_html);
				 
				// chage page title
				changePageTitle("Create New Employee");

		});

    });
 
    // will run if create product form was submitted
	$(document).on('submit', '#create-product-form', function(){
	    // get form data
		var form_data=JSON.stringify($(this).serializeObject());
		// submit form data to api
		$.ajax({
		    url: "http://localhost/cmapp/cmapp_web/dashboard/api/product/create.php",
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