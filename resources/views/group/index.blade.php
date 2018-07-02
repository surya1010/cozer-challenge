@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Groups

                    <div class="pull-right">
                        <a href="{{ route('groups.create') }}" class="btn btn-flat btn-sm btn-primary">Create</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $grup)
                            <tr>
                                <td>{{ $grup->name }}</td>
                                <td><a class="btn btn-info btn-flat btn-sm" href="{{ route('groups.show', $grup->id ) }}" > Start Chat</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection