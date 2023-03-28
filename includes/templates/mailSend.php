<?php

    include 'includes/phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.stackmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    /*     - -- - - - -- - - here  -  - - -- - - - - --  - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - --  */
    $mail->Username = 'noreply@wearedevilz.com'; // الايميل المستخدم                 // SMTP username
    $mail->Password = 'Bv825af38'; // الباسوورد                          // SMTP password
    /*     - -- - - - -- - - here  -  - - -- - - - - - -  --  - - - - - - - - - - - - - - --  - - - - - - - - - - - - - - */

    $mail->SMTPSecure = 'TSL';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('noreply@wearedevilz.com', 'Devilz'); 
                                                          // Add a recipient
    $mail->addAddress($email);                            // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Your Devilz Account\'s password';
                    $mail->Body    = '

    <!DOCTYPE html>
    <html>
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
            <meta content="width=device-width" name="viewport"/>
            <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
            <style type="text/css">
                body {
                    background-color: #EEE;
                    text-align: right;
                    width: 100%;
                    height: 100vh;
                }
                
                h1, p {
                    color: #000 !important;
                }
                
                p {
                    font-size: 17px;
                }
                
                .container {
                    text-align: center;
                    background-color: #FFF;
                    float: right;
                    padding: 20px;
                    width: 38%;
                }
                
                @media (max-width: 576px) {
                
                    .container {
                        width: 100% !important;
                    }
                
                }
                
                btn {
                    text-aligh: center;
                    margin: 18px;
                }
                
                .btn-info {
                    color: #fff;
                    background-color: #17a2b8;
                    border-color: #17a2b8;
                }
                
                .btn {
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    border: 1px solid transparent;
                    padding: .375rem .75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: .25rem;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                    text-decoration: none;
                    color: #FFF !important;
                    margin-bottom: 44px;
                    margin-top: 14px;
                }
                
                .footer {
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>' . $username . ' ,مرحبًا</h1>
                <p>
                 كلمة مرورك المؤقتة هي: <br>
                ' . $randPassword . '
                </p>
                <a href="' . $websiteURL . '" class="btn btn-info"> الذهاب إلى الموقع </a>
                <hr />
                <div class="footer">
                    في حال كانت لديك مشكلة في كلمة المرور الرجاء التواصل مع الإدارة عن طريق التذاكر
                </div>
            </div>
        </body>
    </html>

                ';
    $mail->AltBody = 'كلمة مرورك المؤقتة : ' . $randPassword . ' \n يمكنك تغييرها لاحقًا عند قبولك من لوحة التحكم';

    if(!$mail->send()) {

        header("Location: index.php?" . $mail->ErrorInfo . "");

    } else {

         header("Location: insertSuccess.php?joinForm");

    }

?>