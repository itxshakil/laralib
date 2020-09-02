<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\BookRequestApproved;
use App\Notifications\BookRequestRejected;
use App\RequestedBook;
use App\User;

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

        if ($requestedBook->user_id) {
            User::find($requestedBook->user_id)
                ->notify(new BookRequestApproved($requestedBook->name));
        }

        return back();
    }
    
    public function reject(RequestedBook $requestedBook)
    {
        $this->updateStatus($requestedBook, false);

        if ($requestedBook->user_id) {
            User::find($requestedBook->user_id)
                ->notify(new BookRequestRejected($requestedBook->name));
        }

        return back();
    }

    protected function updateStatus(RequestedBook $requestedBook, Bool $status = true)
    {
        $requestedBook->status = $status;
        $requestedBook->admin_id = auth('admin')->id();
        return $requestedBook->save();
    }
}
