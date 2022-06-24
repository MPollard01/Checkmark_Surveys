<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\LoginForm;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;

class AuthController extends BaseController
{
    public function __construct()
    {
       
    }

    public function showRegisterForm()
    {
        $this->useView('register')->render();
    }

    public function showLoginForm()
    {
        $this->useView('login')->render();
    }

    public function register()
    {
        $registerModel = new User();
        if (Request::getMethod() === 'post') {
            $registerModel->loadData(Request::getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                $this->useView('login')->render();
                return 'Show success page';
            }
        }
        $this->useView('register', ['errors' => $registerModel->errors])->render();
    }

    public function login()
    {
        $loginForm = new LoginForm();
        if (Request::getMethod() === 'post') {
            $loginForm->loadData(Request::getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Redirect::to("/surveys");
                return;
            }
        }
        $this->useView('login', ['errors' => $loginForm->errors])->render();
    }

    public function logout()
    {
        Session::remove('username');
        Session::remove('email');
        Redirect::to("/");
    }
}