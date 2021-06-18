<?php
namespace App\controllers;


use Exception;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;


class Message
{

    
    private function transport($name, $email, $subject, $content){

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername(EMAIL)
        ->setPassword(PASSWORD)
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($subject))
        ->setFrom([EMAIL => 'message from my blog'])
        ->setTo([EMAIL])
        ->setBody("from: $name" . '<br>' . "email: $email" . '<br>' . "message: $content ".'<br>' , 'text/html')
        ;

        // Send the message
        $result = $mailer->send($message);
        if (!$result){
            throw new Exception("fail to send the message", 400);            
        }
        return $result;
    }

    public function sendMessage(){

        if(empty(filter_input(INPUT_POST, 'submit'))){
            throw new Exception("Impossible to do the request", 1);            
        }

        $name = filter_input(INPUT_POST, 'contact-name');
        $email = filter_input(INPUT_POST, 'contact-email');
        $subject = filter_input(INPUT_POST, 'contact-subject');
        $content = filter_input(INPUT_POST, 'contact-message');
        if( !$name || !$email || !$subject || !$content){
            throw new Exception("please fill all the fields", 1);            
        }

        $this->transport($name, $email, $subject, $content);
    }
}