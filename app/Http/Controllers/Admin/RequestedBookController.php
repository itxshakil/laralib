<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RequestedBook;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

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
        $this->updateStatus($requestedBook);
        return back();
    }
    public function reject(RequestedBook $requestedBook)
    {
        $this->updateStatus($requestedBook, false);
        return back();
    }

    protected function updateStatus(RequestedBook $requestedBook, Bool $status = true)
    {
        $requestedBook->status = $status;
        $requestedBook->admin_id = auth('admin')->id();
        return $requestedBook->save();
    }
}
