<?php

namespace App\Http\Controllers;

use App\IssueLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Cache::remember("issues." . auth()->id() . ".latest", 600, function () {
            return auth()->user()->issue_logs()->with('book.authors')->latest()->get();
        });

        return view('issues.index', compact('issues'));
    }
}
