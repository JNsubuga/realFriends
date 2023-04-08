<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::latest()->filter(request(['search']))->paginate();
        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'Name' => 'required',
            'year' => 'required',
            'Code' => 'required',
            'AnualPrinciple' => 'required'
        ]);

        Account::create($formFields);

        return redirect(route('account.index'))->with('success', 'Account created successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toDetail = Account::where('account_id', $id)
            ->leftJoin('transactions', 'accounts.id', '=', 'transactions.account_id')
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->selectRaw('accounts.id, accounts.Name, accounts.year, account.Code, accounts.AnualPrinciple, member.id, members.Names as member, members.Code as member_code, SUM(transactions.Dr) as totalAmountPaid')
            ->groupBy(['account.id', 'accouunts.Name', 'members.id'])
            ->orderBy('member_id', 'ASC')
            ->get();

        return view('accounts.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
