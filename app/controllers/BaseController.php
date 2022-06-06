<?php
namespace App\Controllers;

require_once __DIR__.'/../../app/classes/View.php';

use View;

class BaseController
{
    
    public function useView($view, array $data = [])
    {
        return new View($view, $data);
    }

}