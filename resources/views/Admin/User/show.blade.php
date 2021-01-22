@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item"><a href="{{route('User.index')}}">@lang('sentence.Users')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Show')</li>
        </ol>
    </nav>
</h6>
<hr>
@endsection
@section('content')
<!-- Widget: user widget style 2 -->
<div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info">
    <div class="widget-user-image">
        <img class="elevation-2" src="{{ asset('storage/Users/'.$User->image) }}" alt="User Image">
    </div>
    <!-- /.widget-user-image -->
    <h3 class="widget-user-username">{{$User->title}}</h3>
    <h5 class="widget-user-desc">{{$User->description}}</h5>
    </div>
    <div class="card-footer p-0">
    <ul class="nav flex-column">
        <li class="nav-item">
            <p class="nav-link">
                <i class="fa fa-list-ol"></i> @lang('sentence.Tickets') <span class=" badge bg-info">{{$User->tickets}}</span>
            </p>
        </li>
        <li class="nav-item">
            <p class="nav-link">
                <i class="fa fa-credit-card"></i> @lang('sentence.Price') <span class=" badge bg-info">{{ $User->price }} @lang('sentence.SDG')</span>
            </p>
        </li>
        <li class="nav-item">
            <p class="nav-link">
                <i class="fa fa-calendar"></i> @lang('sentence.Date') 
                <span class=" badge bg-info">{{Carbon\Carbon::parse($User->date)->toFormattedDateString()}}</span>
            </p>
        </li>
        <li class="nav-item">
            <p class="nav-link">
                <i class="fa fa-map-marker"></i> @lang('sentence.Location') <span class=" badge bg-info">{{$User->location}}</span>
            </p>
        </li>
    </ul>
    </div>
</div>
<!-- /.widget-user -->
@endsection
