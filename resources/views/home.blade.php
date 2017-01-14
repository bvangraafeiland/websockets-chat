@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat</div>
                <div class="panel-body chat">
                    <div v-for="message in messages">
                        <strong>@{{ message.receivedAt }}</strong>
                        <p>@{{ message.message }}</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input @keyup.enter="sendCurrentMessage" v-model="currentMessage" type="text" class="form-control">
            </div>
        </div>
    </div>
</div>
@endsection
