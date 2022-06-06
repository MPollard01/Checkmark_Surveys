<?php
namespace App\Controllers;

class IndexController extends BaseController
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $data['data'] = 'hello world';
        $this->useView('home', $data)->render();
    }
}