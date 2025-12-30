<?php

class AuthController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        require_once MODEL_PATH . 'UserModel.php';
        require_once CORE_PATH . 'SessionMiddleware.php';

        $this->userModel = new UsuarioModel();
        $this->session = SessionMiddleware::getInstance();
    }

    public function showLogin()
    {
        return View::render('auth/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            return View::render('auth/login', [
                'error' => 'Debes completar todos los campos'
            ]);
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return View::render('auth/login', [
                'error' => 'Credenciales incorrectas'
            ]);
        }

        $this->session->set('user_id', $user['id']);

        header('Location: /dashboard');
        exit;
    }

    public function showRegister()
    {
        return View::render('auth/register');
    }

    public function register()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            return View::render('auth/register', [
                'error' => 'Debes completar todos los campos'
            ]);
        }

        if ($this->userModel->findByEmail($email)) {
            return View::render('auth/register', [
                'error' => 'El email ya está registrado'
            ]);
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->create([
            'email' => $email,
            'password' => $hashed
        ]);

        header('Location: /login');
        exit;
    }

    public function logout()
    {
        $this->session->destroy();
        header('Location: /login');
        exit;
    }
}
