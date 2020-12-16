<?php

  session_start();
  
  // include Database connection file 
        
  include("../../../auth/db.php");

  // instantiate database and user_class objects
  $database = new Database();
  $con = $database->getConnection_mysqli();

  $search = $_GET['search'];

  if (!$search) {
    $query = "SELECT * FROM employees where deleted=0 and manager_id = '".$_SESSION["id"]."' order by id asc ";
  } else {
    $query = "
        SELECT * FROM employees where deleted=0 and manager_id = '".$_SESSION["id"]."'  and 
        (username like '%$search%' 
        
        ) order by id asc ";
  }
 
  

  if (!$result = mysqli_query($con, $query)) {exit(mysqli_error($con));}

  $total_no = mysqli_num_rows($result);

  // session_start();
  $user_type_ssn = 1;
  $search = $_GET['search'];
  $data_view = $_GET['data_view'];
  $numbering = 0;
  $stats_op = '<div class="col-lg-12"><span class="badge badge-pill badge-primary">Total : '.$total_no.' Employee(s)</span></div>';
  $data_card = $stats_op . '';  
  $data_table = $stats_op . '
    <table class="table table-stripped table-sm" style="box-shadow: 0px 0px 8px #888888;background-color:#fff;margin:10px;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Date Registered</th>
        </tr>
      </thead>
      <tbody>';
     
  if($total_no > 0){     
      
    while($row = mysqli_fetch_assoc($result)) {
      $numbering += 1;  
      // type session management 
        if ($user_type_ssn == 1)  {
          $admin_actions = '
          <button onclick="getDetails('.$row["id"].')" type="button" class="btn btn-outline-success btn-sm" style="padding:5px;"><i class="fa fa-pencil"></i> edit</button>
          <button onclick="reset_btn('.$row["id"].')" type="button" class="btn btn-outline-warning btn-sm" style="padding:5px;"><i class="fa fa-lock"></i> reset</button>
          <button onclick="deleteDetails('.$row["id"].')" type="button" class="btn btn-outline-danger btn-sm" style="padding:5px;"><i class="fa fa-times"></i> delete</button>
          ';
          
        } else  {
          $admin_actions = '';
          
        } 

      $data_card .= '    
        <div style="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div  style="box-shadow: 0px 0px 8px #888888;margin:5px;">
            <div class="card" style="width: ;">
              <!--img src="..." class="card-img-top" alt="..."-->
              <div class="card-body">                
                <h5 class="card-title"><i class="fa fa-user"></i> : '.$row["username"].'</h5>                
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa fa-at"></i> <b>email :</b> '.$row["email"].'</li>
                <li class="list-group-item"><i class="fa fa-phone"></i> <b>phone :</b> '.$row["phone"].'</li>
                
                <li class="list-group-item"><i class="fa fa-calendar"></i> <b>Date Registered :</b> '.$row["created_at"].'</li>
                
              </ul>
              <div class="card-body">
                <button onclick="more('.$row["id"].')" type="button" class="btn btn-outline-primary btn-sm" style="padding:5px;"><i class="fa fa-info-circle"></i> more</button>
                '.$admin_actions.'
              </div>
            </div>
          </div>
        </div>
     ';

     $data_table .= '
        <tr>
          <th scope="row">'.$numbering.'</th>
          <th>
            '.$admin_actions.'
            <button onclick="more('.$row["id"].')" type="button" class="btn btn-outline-primary btn-sm" style="padding:5px;"><i class="fa fa-info-circle"></i> more</button>
          </th>
          <td>'.$row["username"].'</td>
          <td>'.$row["email"].'</td>
          <td>'.$row["phone"].'</td> 
          <td>'.$row["created_at"].'</td>
        </tr> 
        ';
    }
  
  }else{
    // records now found 
    $data_card = '<div class="alert alert-primary animated bounce" role="alert">No Record</div>';
    $data_table = '<div class="alert alert-primary animated bounce" role="alert">No Record</div>';
    
  }

  $data_table .= '</tbody></table>';
  
  if ($data_view == "card") {
    echo   $data_card;
  } else if ($data_view == "table") {
    echo   $data_table;
  } 
?>

