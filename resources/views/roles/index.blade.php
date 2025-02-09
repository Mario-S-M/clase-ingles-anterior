{{-- \resources\views\roles\index.blade.php --}}
@extends('home')
@section('content')
<div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
    <h1><i class="fa fa-key"></i> Roles</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>
</div>
@endsection