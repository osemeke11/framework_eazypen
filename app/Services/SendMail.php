<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    public $mail;
    public $error;

    private function mailTemplate($message, $title = "Eazypen Inc.")
    {
        return
            "<!DOCTYPE html>
            <html>
            <body style='width: 90%; border: 2px solid #000; margin: 0; margin-left: auto; margin-right: auto; padding: 0;'>
                <!-- Header -->
                <div style='min-height: 50px; background-color: #6495ED; padding: 0; margin: 0; padding-top: 10px;'>
                    <h2 style='color: #ffffff; padding: 0; text-align: center;'>" . $title . "</h2>
                </div>
                <!-- Body -->
                <div style='width: 90%; margin: 0 auto; min-height: 250px;'>
                    <p>" . $message . "</p>
                </div>
                <!-- Footer -->
                <div style='padding-bottom: 10px; background-color: #dcdcdc; min-height: 40px; padding-top: 5px; text-align:center'>
                    <p><a href='//www.facebook.com/eazypen'>Visit Our website</a> | <a href='#'>facebook</a> | <a href='#''>Instagram</a></p>
                </div>
            </body>
            </html>";
    }

    public function sendMail($sender_email,$subject, $message, $title = null)
    {
        $this->mail = new PHPMailer;

        $this->mail->isSMTP();                            // Set mailer to use SMTP
        $this->mail->Host = getenv("MAIL_HOST");          // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                     // Enable SMTP authentication
        $this->mail->Username = getenv("MAIL_USER");      // SMTP username
        $this->mail->Password = getenv("MAIL_PASS");      // SMTP password
        $this->mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = getenv("MAIL_PORT");          // TCP port to connect to

        $this->mail->From = getenv("MAIL_FROM_EMAIL");
        $this->mail->FromName = getenv("MAIL_FROM_NAME");//$name;

        $this->mail->addReplyTo(getenv("MAIL_FROM_EMAIL"), getenv("MAIL_FROM_NAME"));

        $this->mail->addAddress($sender_email);   // Add a recipient

        $this->mail->isHTML(true);  // Set email format to HTML

        $bodyContent = $this->mailTemplate($message, $title);

        $this->mail->Subject = $subject;
        $this->mail->Body    = $bodyContent;

        if(!$this->mail->send()) {
           $this->error .= '<li>Message could not be sent.</li>';
           $this->error .= '<li>Mailer Error: ' . $this->mail->ErrorInfo . '</li>';
           return $this->error;
        } else {
            return '<li>Message has been sent</li>';
        }
    }
}

