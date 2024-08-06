<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    public function __construct(private UserServices $userServices){
    }

    public function index(Request $filter)
    {
        try {
            $patients = $this->userServices->index($filter);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'Doutores' => $patients,
            'Status' => 200
        ], 200);
    }
}
