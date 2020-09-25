<?php

namespace App\Http\Controllers;

use App\Admin;
use App\IssueLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_issues = IssueLog::issued()->get();
        $pending_issues->load('admin', 'book.authors', 'user');

        // $returnChart =  IssueLog::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
        // ->groupBy('year', 'month')
        // ->orderBy('year', 'desc')
        // ->get()->dd();

        $returnChart =  IssueLog::whereYear('returned_at', \Carbon\Carbon::now()->format('Y'))->selectRaw('monthname(created_at) month, count(*) data')->groupBy('month')->orderBy('month', 'desc')->get();
        $issuedChart =  IssueLog::whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->selectRaw('monthname(created_at) month, count(*) data')->groupBy('month')->orderBy('month', 'desc')->get();

        return view('admin.index', compact('pending_issues', 'returnChart', 'issuedChart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
