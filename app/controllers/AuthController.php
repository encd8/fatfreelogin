<?php
class AuthController extends Controller {
    function __construct() {
        parent::__construct();
        global $md_db;
        $this->db = $md_db;
    }
    function login($f3){
        $f3->clear('SESSION');
        $f3->set('COOKIE.sent',TRUE);
        $f3->set('title', 'Login');
        $f3->set('inc','login.html');
    }
    function logout($f3){
        $f3->clear('SESSION');
        $f3->reroute('/login');
    }
    function auth($f3){
        if(!$f3->get('COOKIE.sent')){
            $f3->set('flash', 'Cookies must be enabled in order to login.');
        } else {
            $email = $f3->get('POST.email');
            $password = $f3->get('POST.password');
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            $user = $this->db->select('users', ['id', 'email', 'password'], [ 'email' => $email]);
            if(!empty($user)){ // user is found
                if(!password_verify($password, $user[0]['password'])){ // pass mismatch
                    $f3->set('flash', 'Password mismatch. Please try again.');
                } else { // all okay
                    $f3->set('SESSION.user_id', $user[0]['id']);
                    $f3->reroute('/admin');
                }
            } else { // no user
                $f3->set('flash', 'User doesn\'t exist. Please enter valid email.');
            }
        }
        $this->login($f3);
    }
    function signup($f3){
        if($f3->get('POST')){
            $email = filter_var($f3->get('POST.email'), FILTER_SANITIZE_EMAIL);
            $firstname = filter_var($f3->get('POST.firstname'),FILTER_SANITIZE_STRING);
            $lastname = filter_var($f3->get('POST.lastname'),FILTER_SANITIZE_STRING);
            $password = filter_var($f3->get('POST.password'),FILTER_SANITIZE_STRING);
            $confirm_pass = filter_var($f3->get('POST.confirm_pass'),FILTER_SANITIZE_STRING);
            if($password != $confirm_pass){
                $f3->set('flash', 'Please enter the same password twice');
            } else if(in_array('', [$email, $firstname, $lastname, $password])){
                $f3->set('flash', 'Please fill in all the required fields');
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $f3->set('flash','Please enter valid email address');
            } else if($this->db->has('users',['email'=> $email])){
                $f3->set('flash', 'User already exists.');
            } else {
                $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
                
                $this->db->insert('users', [
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'password' => $hashed_pass
                ]);
                if($this->db->id()){
                    $f3->set('flash', 'Account created. Please login to continue');
                    $f3->reroute('/login');
                }
            }
        } 
        $f3->set('title', 'Sign Up');
        $f3->set('inc','register.html');
    }
}

