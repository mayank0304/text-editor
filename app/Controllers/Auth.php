<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        return view('register');
    }

    public function registerUser()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Check if email already exists
        if ($this->userModel->emailExists($email)) {
            // Handle error - email already exists
            return redirect()->to('/register')->with('error', 'Email already exists');
        }

        // Register the user
        $this->userModel->register($email, $password);
        return redirect()->to('/')->with('success', 'Registration successful');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Attempt to login
        $user = $this->userModel->login($email, $password);

        if ($user) {
            session()->set('user_id', $user['id']);
            return redirect()->to('/editor');
        } else {
            // Handle login failure
            return redirect()->to('/')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        session()->remove('user_id');
        return redirect()->to('/')->with('success', 'Logged out successfully');
    }
}
