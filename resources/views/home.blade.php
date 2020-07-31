@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (Auth::guard('web')->check())
                    <h4 class="text-lg text-center text-success">You are logged in as User!</h4>
                    @else
                    <h4 class="text-lg text-center text-danger">You are logged out as User!</h4>
                    @endif
                    @if (Auth::guard('admin')->check())
                    <h4 class="text-lg text-center text-success">You are logged in as Admin!</h4>
                    @else
                    <h4 class="text-lg text-center text-danger">You are logged out as Admin!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection