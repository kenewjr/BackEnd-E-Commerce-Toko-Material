<?php
header("Content-type: Application/json");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/SMTP.php';
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $randompass = generateRandomPassword();
    $sql = "UPDATE user SET password = '$randompass' WHERE email = '$email'";
    $query_add = mysqli_query($koneksi, $sql);

    if ($query_add) {
        if (mysqli_affected_rows($koneksi) > 0) {
            // Now, fetch the username
            $username = getUserName($email);

            $mail = new PHPMailer(true); // Inisialisasi objek PHPMailer
            try {
                // Server settings
                $mail->SMTPDebug = false; // Enable verbose debug output
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'kennie405@gmail.com'; // SMTP username
                $mail->Password = 'uudcfajnhvtludfx'; // SMTP password
                $mail->SMTPSecure = "tls"; // Enable implicit TLS encryption
                $mail->Port = 587; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                // Recipients
                $mail->setFrom('kennie405@gmail.com', 'KenewJR');
                $mail->addAddress($email, $username); // Add a recipient email penerima

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Reset Password';
                $mail->Body = template_email($username, $randompass);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // echo 'Message has been sent';
                http_response_code(200);
                echo json_encode(array('message' => 'Password updated successfully', 'new_password' => $randompass, 'username' => $username));
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                http_response_code(500);
            }
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Data not found for the provided input']);
        }
    }
}

function template_email($username, $new_password)
{
    $email = '
<!DOCTYPE html>
<html>

<head>
    <title>Password Baru Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        strong {
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Reset Password</h2>
        <p>Kami telah mereset password akun Anda. Berikut adalah password baru Anda:</p>
        <p><strong>Username :</strong> <span style="color: #007bff;">' . $username . '</span></p>
        <p><strong>Password Baru:</strong> <span style="color: #007bff;">' . $new_password . '</span></p>
        <p>Harap login dengan menggunakan password baru ini. Harap mengganti password setelah masuk ke akun Anda.</p>
        <p>Terima kasih,</p>
        <p>Tim Support</p>
    </div>

</body>

</html>
';
    return $email;
}

function generateRandomPassword()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $length = 10;
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

function getUserName($identifier)
{
    global $koneksi;
    $sql = "SELECT username FROM user WHERE email = '$identifier'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['username'];
    } else {
        return null; // No user found for the provided identifier
    }
}
?>
