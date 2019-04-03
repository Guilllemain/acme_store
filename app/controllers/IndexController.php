<?php

namespace App\Controllers;

use App\Classes\Mail;

class IndexController extends BaseController
{
    public function show()
    {
        echo 'Home page controller';
        $mail = new Mail();
        $data = [
            'to' => 'email@email.com',
            'subject' => 'welcome',
            'view' => 'welcome',
            'name' => 'John Doe',
            'body' => 'Test email'
        ];

        if ($mail->send($data)) {
            echo 'mail sent successfully';
        } else {
            echo 'mail sending failed';
        }
    }
}
