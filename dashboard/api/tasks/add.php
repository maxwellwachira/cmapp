<?php
use \Mailjet\Resources;
require '../../../vendor/mailjet/vendor/autoload.php';
    
    //Send Mail function
    function send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html){

        $mj_public_key = 'dd4c0a8351f16622dcc1a7208d5b12ec';
        $mj_private_key = 'c7269d0072a31ba952cbafdbc300e116';

        $mj = new \Mailjet\Client($mj_public_key, $mj_private_key,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $mj_from_email,
                        'Name' => $mj_from_name
                    ],
                    'To' => [
                        [
                            'Email' => $mj_to_email,
                            'Name' => $mj_to_name
                        ]
                    ],
                    'Subject' => $mj_subject,
                    'TextPart' => $mj_text,
                    'HTMLPart' => $mj_html
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());
    }

    date_default_timezone_set("Africa/Nairobi");

    if(isset($_POST['task'])){
        // include Database connection file 
        
        include("../../../auth/db.php");

        // instantiate database and user_class objects
        $database = new Database();
        $con = $database->getConnection_mysqli();

        session_start();
        $manager_id = $_SESSION["id"];
 
        // get values 
        $task = mysqli_real_escape_string($con, htmlspecialchars($_POST['task']));
        $description = mysqli_real_escape_string($con, htmlspecialchars($_POST['description']));
        $start_date = mysqli_real_escape_string($con, htmlspecialchars($_POST['start_date']));
        $completion_date = mysqli_real_escape_string($con, htmlspecialchars($_POST['completion_date']));
        $employee_id = mysqli_real_escape_string($con, htmlspecialchars($_POST['employee_id']));

     
        $query = "INSERT INTO tasks
             (task, description, start_date, completion_date, manager_id, employee_id) 
             VALUES 
             ('$task', '$description', '$start_date', '$completion_date', '$manager_id', '$employee_id')";

        if (!mysqli_query($con, $query)) {
            $data = [
                'status' => 'error',
                'message' => mysqli_error($con)
            ];

        } else {
            $data = [
                'status' => 'success',
                'message' => 'one record added'
            ];

            $sql = "SELECT * FROM users WHERE id = '".$manager_id."'";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                $farm_manager_name = 'Manager';
            }
            else {
                if(mysqli_num_rows($result) > 0) {
                // get user info
                $row = mysqli_fetch_assoc($result);
                $farm_manager_name = $row['username'];

                }
            }
            $sql_1 = "SELECT * FROM employees WHERE id = '".$employee_id."' LIMIT 1";
            $result_1 = mysqli_query($con, $sql_1);

            if (!$result_1) {
                $employee_name = 'Employee';
            }
            else {
                if(mysqli_num_rows($result_1) > 0) {
                // get user info
                $row = mysqli_fetch_assoc($result_1);
                $employee_name = $row['username'];
                $email = $row['email'];

            }
        }
            // send html email

            $mj_from_email = 'cmapp@triples.co.ke';
            $mj_from_name = 'CMAPP DSAIL';
        
            $mj_to_email = $email;
            $mj_to_name = $employee_name;
        
            $mj_subject = 'New Task';
            $mj_text = "Hello " . strtoupper($mj_to_name) . " .\n";
            $mj_text .= "Your Farm manager, ".strtoupper($farm_manager_name). " has assigned a new task for you.\n Find a summary of the task below. \n";
            $mj_text .= "TASK: " .strtoupper($task). ".\n";
            $mj_text .= "START DATE: " .strtoupper($start_date). ".\n";
            $mj_text .= "COMPLETION DATE: " .strtoupper($completion_date). ".\n";
            $mj_text .= "DESCRIPTION: " .strtoupper($description). ".\n";
            $mj_text .= "To learn more about cmapp, visit the following link http://139.59.142.183/cmapp/about.php\n";
            $mj_html = '';

            send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html);
                    
                
        } 
    }else {
            $data = [
                'status' => 'error',
                'message' => 'incomplete data'
            ];
        }
        

    $data = json_encode($data);
    echo $data;
?>