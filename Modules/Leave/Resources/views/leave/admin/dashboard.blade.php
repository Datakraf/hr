@extends('backend.master')
@section('page-title')
Leave Module Dashboard
@endsection
@section('page-css')
<link rel="stylesheet" href="{{asset('css/no-admin-sidebar.css')}}">
{!! Charts::assets() !!}
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Leave Modules</h1>
                <p class="display-6">Here's the summary of employees leaves.</p>
            </div>
        </div>
        <div class="col mx-auto">
            <img src="{{asset('images/dashboard/requests.svg')}}" alt="" class="" height="400px">
        </div>
    </div>
    <div class="row">
            @include('components.admin.panel',[
            'title' => ' Leave Applications ',
            'img' => asset('images/leave-list.svg'),
            'link' => route('leave.admin.index',['status' => 'submitted']),
            'linkText' => 'View',
            'linkClass' => 'btn-primary'
            ])
            @include('components.admin.panel',[
            'title' =>'Leave Type Management',
            'img' => asset('images/category.svg'),
            'link' => route('leave-type.index'),
            'linkText' => 'View',
            'linkClass' => 'btn-primary'
            ])
            @include('components.admin.panel',[
            'title' => 'Holidays Management',
            'img' => asset('images/holidays.svg'),
            'link' => route('holiday.index'),
            'linkText' => 'View',
            'linkClass' => 'btn-primary'
            ])
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="card p-30 pt-50 text-center">
                    <div>
                        <img src="{{asset('images/settings.svg')}}" alt="" class="mb-5" height="150px">
                    </div>
                    <h5 class="">Leave Configuration</h5>
                    <p class="text-light fs-12 mb-30"></p>
                    <a href="{{route('leave.config.index')}}" class="btn btn-round btn-xs btn-primary">Manage</a>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leave Applications By Month</h3>
                </div>
                <div class="card-body">
                    <div id="monthly">
                        {!! $monthly->render() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Who's not in the office?</h3>
                    <div class="card-options">
                        <select name="" id="daysSelector" class="form-control">
                            <option value="7">This week</option>
                            <option value="30">This month</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @widget('absenteesWidget')
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('page-js')

@endsection
