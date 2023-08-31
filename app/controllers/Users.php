<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Users extends Controller
{
    private $userModel;

    public function __construct(){
        $this->userModel = $this->model('User');
        
    }

    public function register()
    {

        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //if == then process form

            //sanitize POST data as strings
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Innit data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                //check email
                //returns true if found 
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already in use';
                }
            }

            //validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            } //else name is taken

            //validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            //validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                //Validated
                
                //Hash Passwords

                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                //Register user
                //call model function=> register user
                if($this->userModel->register($data)){
                    
                    //this will return true or false
                    //if user is registered, we want to redirect to log in page
                    //header('location: ' . URLROOT . '/users/login');
                    flash('register_success', 'You are regestered and can log in');
                    
                    redirect('users/login');

                } else {
                    //if false
                    die('Something went wrong');
                }

            } else {
                // Load view with erros
                $this->view('users/register', $data);
            }
            
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }
    
    public function login()
    {

        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //if == then process form

            //sanitize POST data as strings
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // Innit data
            $data = [
                
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];
            //validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            //validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } 

            //check for user/email
            //reuse find user by email that we created for seeing if email already existed when signing up
            if($this->userModel->findUserByEmail($data['email'])){
                //user found
            } else {
                $data['email_err'] = 'No user found';
            }


            // Make sure are empty
            // Make sure errors are empty
            
            if (empty($data['email_err']) && empty($data['password_err'])){
                //Validated
               //Check and set logged in user
               //model method
               $loggedInUser = $this->userModel->login($data['email'], $data['password']);
               if($loggedInUser){
                //Create Session variables
                //Function for session variables
                $this->createUserSession($loggedInUser);

               } else {
                $data['password_err'] = 'Password incorrect';
               
                $this->view('users/login', $data);
                }

            } else {
                // Load view with erros
                $this->view('users/login', $data);
            }

        } else {
            // Innit data
            $data = [

                'email' => '',
                'password' => '',

                'email_err' => '',
                'password_err' => '',

            ];

            //load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('posts'); //will be posts
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
}
