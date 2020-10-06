<?php

namespace App\Http\Controllers;

use App\Admin;
use App\IssueLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $issuedChart = Cache::remember('issuedInLast28Days', 86400, function () {
            return IssueLog::select('id', 'created_at')->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(28), \Carbon\Carbon::now()])->orderBy('created_at')->get()->countBy(function ($issuelog) {
                return \Carbon\Carbon::parse($issuelog->created_at)->format('d-M');
            });
        });

        $returnedChart = Cache::remember('returedInLast28Days', 86400, function () {
            return IssueLog::select('id', 'returned_at')->whereBetween('returned_at', [\Carbon\Carbon::now()->subDays(28), \Carbon\Carbon::now()])->orderBy('returned_at')->get()->countBy(function ($issuelog) {
                return \Carbon\Carbon::parse($issuelog->returned_at)->format('d-M');
            });
        });

        return view('admin.index', compact('pending_issues', 'issuedChart', 'returnedChart'));
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
