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