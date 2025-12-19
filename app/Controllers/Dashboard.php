<?php

namespace App\Controllers;

// use App\Models\VisitorRequestModel;
// use App\Models\VisitorLogModel;
// use App\Models\SecurityGateLogModel;
// use App\Models\VisitorRequestHeaderModel;


class Dashboard extends BaseController
{
    // protected $visitorModel;
    // protected $logModel;
    // protected $SecurityGateLogModel;
    // protected $VisitorRequestHeaderModel;

    

    public function __construct()
    {
        // $this->visitorModel = new VisitorRequestModel();
        // $this->logModel     = new VisitorLogModel();
        // $this->SecurityGateLogModel     = new SecurityGateLogModel();
        // $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

    public function index()
    {

        //     if (!$session->has('isLoggedIn') || !$session->has('user_id') || !$session->has('username') || !$session->has('role_id')) {
        //         header("Location: " . base_url('/login'));
        //         exit;
        //    }
        
        //  // Visits today
        // $today = date('Y-m-d');
        // $session = session();
        // $roleId       = $_SESSION['role_id'];
        // $userId       = $_SESSION['user_id'];
        // $departmentId = $_SESSION['department_id'];
        // // Dynamic counts from DB
      
        return view('dashboard/dashboard');
    }
}
