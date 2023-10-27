<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        // if (auth()->user()->hasRole('Super Admin')) {
        $per_page = $request->input('per_page', 5);
        $accounts = Account::orderBy('id','DESC')->paginate($per_page);
        $users = User::all();
         $user_id = $request->get('owner');
        $user = User::find($user_id);

        $totalAccount = Account::count();
        return view('accounts.index', ['totalAccount' => $totalAccount ], compact('accounts','per_page','users','user'))
        ->with('i', ($request->input('page', 1) - 1) * $per_page);
    //   }

    //   elseif (auth()->user()->hasRole('Admin')) {
    //     $per_page = $request->input('per_page', 5);
    //     $accounts = Account::where('owner', auth()->user()->id)->orderBy('id','DESC')->paginate($per_page);
    //     $users = User::all();
    //      $user_id = $request->get('owner');
    //     $user = User::find($user_id);

    //     $totalAccount = Account::where('owner', auth()->user()->id)->count();
    //     return view('accounts.index', ['totalAccount' => $totalAccount ], compact('accounts','per_page','users','user'))
    //     ->with('i', ($request->input('page', 1) - 1) * $per_page);
    //   }

    //    return redirect()->back()->withErrors(['Access denied. You are not authorized to view this page.']);

    }

    public function create()
    {
        return view('account.create');
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
        return redirect('accounts')->with('success', 'Account created successfully.');
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
    return view('accounts.edit', compact('account'));
    
}
public function update(Request $request, $id)
{
    $account = Account::findOrFail($id);
    $account->update($request->all());

    return redirect()->route('accounts.index')
        ->with('success','Account updated successfully');
}
public function destroy($id)
    {
        Account::find($id)->delete();
        return redirect()->route('accounts.index')
                        ->with('success','User deleted successfully');
    }
}
