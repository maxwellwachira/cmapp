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

    if(isset($_POST['email']))
    {
        // include Database connection file 
        
        include("../../../auth/db.php");

        // instantiate database and user_class objects
        $database = new Database();
        $con = $database->getConnection_mysqli();

        session_start();
        $manager_id = $_SESSION["id"];
 
        // get values 
        $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
        $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email']));
        $phone = mysqli_real_escape_string($con, htmlspecialchars($_POST['phone']));
        $workgroup = mysqli_real_escape_string($con, htmlspecialchars($_POST['workgroup']));

        $new_pwd = md5($username);

        // encrypt password
        $password = password_hash($new_pwd, PASSWORD_DEFAULT);
        $created_at = date('Y/m/d H:i:s');
        
        $sql = "SELECT * FROM employees WHERE email = '".$email."' LIMIT 1";
        $result = mysqli_query($con, $sql);
        if ($result){
            $num = mysqli_num_rows($result);
            if($num > 0){

                $data = [
                'status' => 'error',
                'message' => 'account exists'
                ];

            } else {
                $query = "INSERT INTO
                     employees 
                     (username, email, phone, password, manager_id, workgroup, created_at) 
                     VALUES 
                     ('$username', '$email', '$phone', '$password', '$manager_id', '$workgroup', '$created_at')";

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

                    // send html email

                    $mj_from_email = 'cmapp@triples.co.ke';
                    $mj_from_name = 'CMAPP DSAIL';
                
                    $mj_to_email = $email;
                    $mj_to_name = $username;
                
                    $mj_subject = 'New Account';
                    $mj_text = "Hello " . strtoupper($mj_to_name) . " .\n";
                    $mj_text .= "Your Farm manager, ".strtoupper($farm_manager_name). " has created an account for you.\n";
                    $mj_text .= "To login to you account, visit the link http://localhost/cmapp/auth/login.php. Your email address is ".$email."  and password is ".$new_pwd."\n";
                    $mj_text .= "Once you have logged in, you can change your password by clicking the change password button on the top right of the dashboard\n";
                    $mj_text .= "To learn more about cmapp, visit the following link http://localhost/cmapp/blog/first_blog.php\n";
                    $mj_html = '';

                    send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html);
                    
                }

            }
        } else {
            $data = [
                'status' => 'error',
                'message' => mysqli_error($con)
            ];
        }
        
    }

    $data = json_encode($data);
    echo $data;
?>