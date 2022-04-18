@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create New Plan
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('plans/create') }}">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">Enter amount to charge per month</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">Amount</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', '') }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">Enter amount to charge per month</span>
            </div>
            <input type="submit" class="btn btn-primary" value="Save">
        </form>
    </div>
</div>

@endsection