<?php

namespace App\Http\Controllers;

use App\Admin;
use App\IssueLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function index()
    {
        $pending_issues = IssueLog::issued()->get();
        $pending_issues->load('admin', 'book.authors', 'user');

        $issuedChart = Cache::remember('issuedInLast28Days', 86400, function () {
            return IssueLog::select('id', 'created_at')->whereBetween('created_at', [Carbon::now()->subDays(28), Carbon::now()])->orderBy('created_at')->get()->countBy(function ($issuelog) {
                return Carbon::parse($issuelog->created_at)->format('d-M');
            });
        });

        $returnedChart = Cache::remember('returedInLast28Days', 86400, function () {
            return IssueLog::select('id', 'returned_at')->whereBetween('returned_at', [Carbon::now()->subDays(28), Carbon::now()])->orderBy('returned_at')->get()->countBy(function ($issuelog) {
                return Carbon::parse($issuelog->returned_at)->format('d-M');
            });
        });

        return view('admin.index', compact('pending_issues', 'issuedChart', 'returnedChart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Admin $admin
     * @return Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
