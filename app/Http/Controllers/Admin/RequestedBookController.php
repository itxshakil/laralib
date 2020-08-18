<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RequestedBook;
use Illuminate\Http\Request;

class RequestedBookController extends Controller
{
    public function index()
    {
        $books = RequestedBook::paginate(12);

        return view('admin.requestedbooks.index', compact('books'));
    }

    public function show(RequestedBook $requestedBook)
    {
        return view('admin.requestedbooks.show', compact('requestedBook'));
    }
    public function approve(RequestedBook $requestedBook)
    {
        $requestedBook->status = true;
        $requestedBook->save();
        return back();
    }
    public function reject(RequestedBook $requestedBook)
    {
        $requestedBook->status = false;
        $requestedBook->save();
        return back();
    }
}
