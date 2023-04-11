<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::orderBy('Code', 'asc')->filter(request(['search']))->paginate();
        return view('members.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'Names' => 'required',
            'Code' => ['required', 'unique:members,Code'],
            'currentBalance' => 'required'
        ]);
        $formFields['profile_id'] = 1;
        Member::create($formFields);

        return redirect(route('member.index'))->with('success', 'Member Registered successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toDetail = Member::where('id', $id)->first();
        return view('members.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function memberAccounts(string $id)
    {
        $toDetailMemberAccounts = Member::where('member_id', $id)
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->join('accounts', 'accounts.id', '=', 'transactions.account_id')
            ->selectRaw('accounts.id as accountId, accounts.Name, accounts.year, accounts.Code, accounts.AnualPrinciple, members.id, members.Names as member, members.Code as member_Code, SUM(transactions.Dr) as totalAmountPaid')
            ->groupBy(['accountId', 'accounts.Name', 'members.id'])
            ->orderBy('accountId', 'ASC')
            ->get();
        return view('members.member_accounts', ['toDetailMemberAccounts' => $toDetailMemberAccounts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $toUpdate = Member::where('id', $id)->first();
        return view('members.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $formFields = $request->validate([
            'Names' => 'required',
            'Code' => ['required', 'unique:members,Code'],
            'currentBalance' => 'required'
        ]);
        // $formFields['profile_id'] = 1;
        Member::where('id', $id)->update($formFields);

        return redirect(route('member.index'))->with('success', 'Member Registered successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
