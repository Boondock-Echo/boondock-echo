<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MyaccountController extends Controller
{
    public function index(Request $request)
    {


      if (auth()->user()->hasRole('Admin')) {
        $per_page = $request->input('per_page', 5);
        $accounts = Account::where('id', auth()->user()->company)
        ->orderBy('id', 'DESC')
        ->paginate($per_page);
        $totalUsers = User::where('company', auth()->user()->company)->count();
        $accountusers = User::where('company', auth()->user()->company)->get();
        $users = User::all();
         $user_id = $request->get('owner');
        $user = User::find($user_id);
        $firstAccount = $accounts->first();
        // dd($firstAccount->account_name);
        $totalAccount = Account::where('owner', auth()->user()->id)->count();
        return view('myaccount.index', ['totalAccount' => $totalAccount ], compact('firstAccount','per_page','users','user','totalUsers','accountusers'))
        ->with('i', ($request->input('page', 1) - 1) * $per_page);
      }

       return redirect()->back()->withErrors(['Access denied. You are not authorized to view this page.']);

    }

    public function create()
    {
        return view('myaccount.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_zip' => 'required',
            'billing_amount' => 'required'
        ]);
        // $user_id = $request->get('owner');
        // $user = User::find($user_id);
        $account = new Account([
            'owner' =>  $request->get('owner'),
            'account_name' => $request->get('account_name'),
            'billing_address' => $request->get('billing_address'),
            'billing_city' => $request->get('billing_city'),
            'billing_state' => $request->get('billing_state'),
            'billing_zip' => $request->get('billing_zip'),
            'billing_amount' => $request->get('billing_amount'),
            'active' => $request->get('active')
        ]);
        $account->save();
        return redirect('myaccount')->with('success', 'Account created successfully.');
    }
   public function storecompany(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_zip' => 'required',
            'billing_amount' => 'required'
        ]);
        // $user_id = $request->get('owner');
        // $user = User::find($user_id);
        $account = new Account([
            'owner' =>  $request->get('owner'),
            'account_name' => $request->get('account_name'),
            'billing_address' => $request->get('billing_address'),
            'billing_city' => $request->get('billing_city'),
            'billing_state' => $request->get('billing_state'),
            'billing_zip' => $request->get('billing_zip'),
            'billing_amount' => $request->get('billing_amount'),
            'active' => $request->get('active')
        ]);
        $account->save();
        $user = auth()->user();
        $user->assignRole('Admin');

      $user->company = $account->id;

       $user->save();


        return redirect('profile')->with('success', 'Account created successfully.');
    }

    public function edit($id)
{
    $account = Account::findOrFail($id);
    return view('myaccount.edit', compact('account'));
}
public function update(Request $request, $id)
{
    $account = Account::findOrFail($id);
    $account->update($request->all());

    return redirect()->route('myaccount.index')
        ->with('success','Account updated successfully');
}
public function destroy($id)
    {
        Account::find($id)->delete();
        return redirect()->route('profile')
                        ->with('success','User deleted successfully');
    }
}
