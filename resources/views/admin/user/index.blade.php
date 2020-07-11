@extends('layouts.admin')

@section('main')
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Danh sách nhóm quyền</div>
        <div class="panel-body">
            <p>Text goes here...</p>
        </div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($data as $model)
                <tr>
                    <td>{{$model->id}}</td>
                    <td>{{$model->name}}</td>
                    <td>{{$model->email}}</td>
                    <td>{{$model->phone}}</td>
                    <td>
                        <a href="{{route('admin.user.show',$model->id)}}" class="btn btn-xs btn-warning">Roles</a>
                        <a href="{{route('admin.user.edit',$model->id)}}" class="btn btn-xs btn-primary">Sửa</a>
                        <a href="" class="btn btn-xs btn-danger">Xóa</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            {{$data->links()}}
        </div>
</div>

@stop()