<?php

namespace App\Http\Controllers;

use App\Account; // Make sure this line is present
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return response()->json(Account::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:accounts',
            'firstname' => 'required',
            'password' => 'required'
        ]);

        $account = Account::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => '', // Assuming lastname is not required
            'password' => $request->password
        ]);

        return response()->json($account, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $account = Account::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($account) {
            return response()->json(['id' => $account->id, 'firstname' => $account->firstname], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function show(Account $account)
    {
        return response()->json($account, 200);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'email' => 'required|unique:accounts,email,' . $account->id,
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required'
        ]);

        $account->update($request->all());
        return response()->json($account, 200);
    }



    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}