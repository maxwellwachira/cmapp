<?php

    require '../vendor/mailjet/vendor/autoload.php';
    use \Mailjet\Resources;
    //Send Mail function
    function send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html){

        $mj_public_key = '';
        $mj_private_key = '';

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
        // $response->success() && var_dump($response->getData());
    }

    $mj_from_email = $_POST["email"];
    $mj_from_name = "CMapp DSAIL Web";
    $mj_to_email = "cmappdsail@gmail.com";
    $mj_to_name = $_POST["name"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $mj_subject = $_POST["subject"];
    $message = $_POST["message"];
    $mj_text = '';
    $mj_html = 'You have recevied a New message from <br>Name: '.$mj_to_name.' <br> Email: '.$email.'<br> Phone Number: '.$phonenumber.'<br>Message: '.$message.'';

    send_email($mj_from_email, $mj_from_name, $mj_to_email, $mj_to_name, $mj_subject, $mj_text, $mj_html);


?>
