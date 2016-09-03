<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Account;

class AccountController extends Controller
{
    public function index()
    {
        return Account::all();
    }
}
