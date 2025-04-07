<?php
namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;


class EmailService{
    protected $app_name;
    protected $host;
    protected $port;
    protected $user_name;
    protected $password;

    function __construct(){
        $this->app_name = config('app.name');
        $this->username = config('mail.mailers.smtp.username');
        $this->password = config('mail.mailers.smtp.password');
        $this->host = config('mail.mailers.smtp.host');
        $this->port = config('mail.mailers.smtp.port');

    }
    public function sendEmail($subject,$emailUser,$nameUser,$isHtml,$activation_code,$activation_token){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->Username= $this->username;
        $mail->Password= $this->password;
        $mail->SMTPAuth = true;
        $mail->Subject = $subject;
        $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
        $mail->addReplyTo(config('mail.from.address'), config('mail.from.name'));
        $mail->addAddress($emailUser,$nameUser);
        $mail->isHtml($isHtml);
        $mail->Body = $this->viewSendEmail($nameUser,$activation_code,$activation_token);

        $mail->send();


    }
    public function viewSendEmail($name,$activation_code,$activation_token){
        return view('mail.confirmation_email')
        ->with([
            'name' => $name,
            'activation_code' => $activation_code,
            'activation_token' => $activation_token

        ]);

    }


}
