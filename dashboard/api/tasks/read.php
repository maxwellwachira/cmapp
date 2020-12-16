<?php

  session_start();
  
  // include Database connection file 
        
  include("../../../auth/db.php");

  // instantiate database and user_class objects
  $database = new Database();
  $con = $database->getConnection_mysqli();

  $search = $_GET['search'];

  if (!$search) {
    $query = "SELECT * FROM tasks where deleted=0 and manager_id = '".$_SESSION["id"]."' order by id asc ";
  } else {
    $query = "
        SELECT * FROM tasks where deleted=0 and manager_id = '".$_SESSION["id"]."'  and 
        (task like '%$search%' 
        
        ) order by id asc ";
  }
 
  

  if (!$result = mysqli_query($con, $query)) {exit(mysqli_error($con));}

  $total_no = mysqli_num_rows($result);

  // session_start();
  $user_type_ssn = 1;
  $search = $_GET['search'];
  $data_view = $_GET['data_view'];
  $numbering = 0;
  $stats_op = '<div class="col-lg-12"><span class="badge badge-pill badge-primary">Total : '.$total_no.' Task(s)</span></div>';
  $data_card = $stats_op . '';  
  $data_table = $stats_op . '
    <table class="table table-stripped table-sm" style="box-shadow: 0px 0px 8px #888888;background-color:#fff;margin:10px;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Action</th>
          <th scope="col">Task</th>
          <th scope="col">Description</th>
          <th scope="col">Start Date</th>
          <th scope="col">Completion Date</th>  
        </tr>
      </thead>
      <tbody>';
     
  if($total_no > 0){     
      
    while($row = mysqli_fetch_assoc($result)) {
      $numbering += 1;  
      // type session management 
        if ($user_type_ssn == 1)  {
          $admin_actions = '
          <button onclick="getDetails('.$row["id"].')" type="button" class="btn btn-outline-success btn-sm" id = "edit_val" style="padding:5px;"><i class="fa fa-pencil"></i> edit</button>
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
                <h5 class="card-title"> Task: '.$row["task"].'</h5>                
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>Description :</b> '.$row["description"].'</li>
                <li class="list-group-item"><i class="fa fa-calendar"></i> <b>Start Date :</b> '.$row["start_date"].'</li>
                
                <li class="list-group-item"><i class="fa fa-calendar"></i> <b>Completion Date :</b> '.$row["completion_date"].'</li>
                
              </ul>
              <div class="card-body">
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
          </th>
          <td>'.$row["task"].'</td>
          <td>'.$row["description"].'</td>
          <td>'.$row["start_date"].'</td> 
          <td>'.$row["completion_date"].'</td>
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

