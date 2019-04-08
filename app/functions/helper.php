<?php

use Philo\Blade\Blade;
use Symfony\Component\VarDumper\VarDumper;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Session;

function view($path, array $data = [])
{
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';
    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path, $data)->render();
}

function make($filename, $data)
{
    extract($data);
    ob_start();
    
    // include template
    include(__DIR__ . '/../../resources/views/emails/' . $filename . '.php');
    
    // get content of the file
    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        die(1);
    }
}

function paginate($num_of_records, $total_records, $table_name, $object) {
    $pages = new Paginator($num_of_records, 'p');
    $pages->set_total($total_records);
    $data = Capsule::select("SELECT * FROM $table_name ORDER BY created_at DESC  " . $pages->get_limit());
    $items = $object->transform($data);
    
    return [$items, $pages->page_links()]; 
}
