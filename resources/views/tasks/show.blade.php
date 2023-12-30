@extends('layouts.frontend')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header flex justify-between items-center">
                <h4 class="card-title">{{ __('Task') }} #{{$task->id}}</h4>
                <a href="{{ route('tasks.index') }}" class="btn bg-gray-800">{{ __('Back To List') }}</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td>{{ $task->title }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $task->description }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $task->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $task->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection