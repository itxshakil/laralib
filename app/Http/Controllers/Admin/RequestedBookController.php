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
        dd($requestedBook);
    }
}
