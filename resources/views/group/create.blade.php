@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Groups

                </div>

                <form action="{{ route('groups.store') }}" class="form from-horizontal" method="POST">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control input-sm" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Users</label>
                            <div class="col-md-6">
                                @foreach($users as $user)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="{{ $user->id }}" name="user_other[]" value="{{ $user->id }}">
                                        <label class="form-check-label" for="{{ $user->id }}">{{ $user->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-flat btn-sm btn-default">Back</a>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-sm btn-flat btn-primary"> Save</button>
                        </div>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection