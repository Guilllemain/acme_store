<?php

namespace App\Classes;

class ErrorHandler
{
    public function handleErrors($error_number, $error_msg, $error_file, $error_line)
    {
        $error = "[{$error_number}] An error occured in file {$error_file} on line {$error_line}: {$error_msg}";
        
        $environment = getenv('APP_ENV');
        if ($environment === 'local') {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            $data = [
                'to' => getenv('MAIL_ADMIN'),
                'subject' => 'welcome',
                'view' => 'errors',
                'name' => 'Admin',
                'body' => $error
            ];
            ErrorHandler::emailAdmin($data)->outputFriendlyError();
        }
    }

    public function outputFriendlyError()
    {
        ob_end_clean();
        view('errors/generic');
        die();
    }

    public static function emailAdmin($data)
    {
        $mail = new Mail();
        $mail->send($data);
        return new static;
    }
}
