<?php
class AdminController extends Controller {
    //! HTTP route pre-processor
    function beforeroute($f3) {
        if (empty($f3->get('SESSION.user_id'))){
            $f3->set('flash', 'Please login to continue');
            $f3->reroute('/login');
        }
    }
    function profile($f3){
        $f3->set('title', 'Profile');
        $f3->set('inc', 'profile.html');
    }
}

