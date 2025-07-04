<?php

namespace App\Controllers;

use App\Helpers\AuthUtils;


class AuthController extends BaseController
{

       protected $session;

    public function __construct()
    {
        helper(['url']);
        $this->session = \Config\Services::session();
    }


    public function loginPage()
    {

        // echo(password_hash("123456", PASSWORD_BCRYPT));
        return view('dashboard/login');
    }

      // POST /api/auth/register
    public function register()
    {
        $request = service('request');
        $data = $request->getJSON(true); // Get JSON payload

        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!$name || !$email || !$password) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'All fields are required'
            ])->setStatusCode(400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid email format'
            ])->setStatusCode(400);
        }

        $users = AuthUtils::readUsers();
        if (AuthUtils::userExists($email)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User already exists'
            ])->setStatusCode(409);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $users[] = [
            'id' => uniqid(),
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];

        AuthUtils::writeUsers($users);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Registered successfully'
        ]);
    }

    // POST /api/auth/login
    public function login()
    {
        // return $this->response->setJSON([
        //         'status' => false,
        //         'message' => 'Email and password are required'
        //     ])->setStatusCode(200);
        $request = service('request');
        $data = $request->getJSON(true);

        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Email and password are required',
                
            ])->setStatusCode(400);
        }

        $user = AuthUtils::findUserByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid credentials',
                // 'user' =>$user
                
            ])->setStatusCode(401);
        }

        $this->session->set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login successful',
            'user' => $this->session->get('user')
        ]);
    }

    // GET /api/auth/verify
    public function verify()
    {
        $user = $this->session->get('user');

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Not authenticated'
            ])->setStatusCode(401);
        }

        return $this->response->setJSON([
            'status' => true,
            'user' => $user
        ]);
    }

    // POST /api/auth/logout
    public function logout()
    {
        $this->session->remove('user');
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}



