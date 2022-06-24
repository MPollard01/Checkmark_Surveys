<?php
namespace App\Controllers;

class IndexController extends BaseController
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $this->useView('home')->render();
    }

    public function redirect()
    {
        $this->useView('response-redirect')->render();
    }
}