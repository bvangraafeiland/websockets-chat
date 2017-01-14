@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <chatbox sender-name="{{$loggedInUserName}}">Our awesome chat</chatbox>
        </div>
    </div>
</div>
@endsection
