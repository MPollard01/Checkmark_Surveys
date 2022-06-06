<?php
namespace App\Controllers;

class RegisterController extends BaseController
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $data['data'] = 'hello world';
        $this->useView('register', $data)->render();
    }
}