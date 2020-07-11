@extends('layouts.admin')

@section('main')
<div class="panel panel-primary" ng-app="role" ng-controller="roleController">
    <!-- Default panel contents -->
    <div class="panel-heading">Danh sách nhóm quyền</div>
    <div class="panel-body">
        
        <form action="{{route('admin.role.store')}}" method="POST" role="form">
            @csrf
            <div class="form-group">
                <label for="">Tên nhóm quyền</label>
                <input type="text" class="form-control" name="name" placeholder="Input field">
            </div>
        
            <div class="form-group" style="height: 300px; overflow-y: auto">
                 
                <label for="">Routes list</label>
                <input type="text" class="form-control" ng-model="rname" placeholder="Input rolte name">

                <div class="checkbox" ng-repeat="r in roles | filter:rname">
                    <label>
                        <input type="checkbox" class="role-item" name="route[]" value="@{{r}}">
                        @{{r}}
                    </label>
                </div>
               
            </div>
        
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <label><input type="checkbox" id="check-all" > Check All</label>
        </form>
        
    </div>
</div>

@stop()

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.0/angular.min.js"></script>
<script type="text/javascript">
    var app = angular.module('role',[]);

    app.controller('roleController', function($scope){
        var roles = '<?php echo json_encode($routes) ;?>';
        $scope.roles = angular.fromJson(roles);
    })

    // jQuery check all 
    $('#check-all').click(function(){
        $('.role-item').not(this).prop('checked', this.checked);
    })

</script>
@stop()