<?php

namespace App\Controllers;

use App\Classes\Mail;

class IndexController extends BaseController
{
    public function index()
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

        $mail->send($data);
    }
}
