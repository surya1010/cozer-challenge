@extends('layouts.app')

@section('content')
<meta name="receiverId" content="{{ $users->id }}">

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $users->name }}</div>

                <div class="panel-body">
                    <chat-messages v-bind:messages="messages" v-bind:senderid="{{ Auth::user()->id }}" v-bind:receiverid="{{ $users->id }}" ></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :senderid="{{ Auth::user()->id }}" :receiverid="{{ $users->id }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    
<style>
    .chat {
    list-style: none;
    margin: 0;
    padding: 0;
    }

    .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
    margin: 0;
    color: #777777;
    }

    .panel-body {
    overflow-y: scroll;
    height: 350px;
    }

    ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
    }
</style>

@endpush