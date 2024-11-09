<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    // Register a new user
    public function register($email, $password)
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        echo "<pre>";
        print_r($email);
        echo "</pre>";
        // Prepare data for insertion
        $data = [
            'email' => $email,
            'password' => $hashedPassword,
            // 'created_at' will be automatically filled
        ];
        // Insert the user into the database
        return $this->insert($data);
    }

    // Check if email exists
    public function emailExists($email)
    {
        return $this->where('email', $email)->first() !== null; // Return true if email exists
    }

    // Login user
    public function login($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user array if login is successful
        }

        return false; // Return false if login fails
    }

    // Get user by ID
    public function getUserById($userId)
    {
        return $this->find($userId); // Return user array
    }
}
