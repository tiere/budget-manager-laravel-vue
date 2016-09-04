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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:accounts',
        ]);

        return Account::create($request->all());
    }

    public function destroy(Account $account)
    {
        $account->delete();
    }

    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'name' => "required|unique:accounts,name,{$account->id}",
        ]);

        $account->update($request->all());

        return $account;
    }
}
