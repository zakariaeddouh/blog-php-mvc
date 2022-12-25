<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ServiceManager extends Model
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function contactAction()
    {
        return $this->contact();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function contact()
    {
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $mail = new PHPMailer;

        $mail->isSMTP();                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;               // Enable SMTP authentication
        $mail->Username = '';   // SMTP username
        $mail->Password = '';   // SMTP password
        $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                    // TCP port to connect to

        // Sender info
        $mail->setFrom('blog.bona@gmail.com', 'Bona');

        // Add a recipient
        $mail->addAddress($newFields['email']);

        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Set email format to HTML
        $mail->isHTML(true);

        // Mail subject
        $mail->Subject = 'Bona | blog personnel';

        // Mail body content
        $bodyContent = "Bonjour ".$newFields['firstName'].' '.$newFields['lastName'].",";
        $bodyContent .= "<p> Nous avons bien reçu votre message et ne manquerons pas de vous recontacter dans les plus brefs délais.</p>";
        $bodyContent .= "Cordialement,<br>";
        $bodyContent .= "Bona | blog personnel";
        $mail->Body    = $bodyContent;

        // Send email 
        if(!$mail->send()) { 
            return "Le message n'a pas pu être envoyé. Erreur de messagerie: ".$mail->ErrorInfo; 
        } else { 
            return "Le message a été envoyé!"; 
        }
    }
}
