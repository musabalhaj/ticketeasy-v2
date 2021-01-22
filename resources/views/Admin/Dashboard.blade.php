@extends('layouts.master')
@section('content-header')

@section('content')

<div class="row">
    <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
        
        <div class="info-box-content">
        <span class="info-box-text">@lang('sentence.Events')</span>
        <a href="{{ route('Event.index') }}">
            <span class="info-box-number">{{ $Event }}</span>
        </a>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">@lang('sentence.Users')</span>
        <a href="{{ route('User.index') }}">
            <span class="info-box-number">{{ $User }}</span>
        </a>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-sitemap"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">@lang('sentence.Organizers')</span>
            <a href="{{ route('Organizer.index') }}">
                <span class="info-box-number">{{ $Orgnaizer }}</span>
            </a>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-star"></i> @lang('sentence.Latest Events')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th>@lang('sentence.Image')</th>
                                <th>@lang('sentence.Tickets')</th>
                                <th>@lang('sentence.Price')</th>
                                <th>@lang('sentence.Date')</th>
                                <th>@lang('sentence.Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Events as $v=>$Event)
                                <tr>
                                    <td><a href="{{ route('Event.show',$Event->id) }}">
                                        <img class="elevation-2" width="50" height="20" src="{{ asset('storage/Events/'.$Event->image) }}" alt="Event Image">
                                        </a>
                                    </td>
                                    <td>{{ $Event->tickets }}</td>
                                    <td>{{ $Event->price }} @lang('sentence.SDG')</td>
                                    <td>{{Carbon\Carbon::parse($Event->date)->toFormattedDateString()}}</td>
                                    <td>
                                        @if ($Event->status == 0)
                                            <span class="badge badge-danger">@lang('sentence.Pending')</span>
                                        @else
                                            <span class="badge badge-success">@lang('sentence.Done')</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> @lang('sentence.Latest Bookings')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th>@lang('sentence.#ID')</th>
                                <th>@lang('sentence.Seats')</th>
                                <th>@lang('sentence.Amount')</th>
                                <th>@lang('sentence.Ticket Status')</th>
                                <th>@lang('sentence.Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Bookings as $v=>$Booking)
                                <tr>
                                    <td>{{ $v+1 }}</td>
                                    <td>{{ $Booking->seats }}</td>
                                    <td>{{ $Booking->amount }} @lang('sentence.SDG')</td>
                                    <td>
                                        @if ($Booking->ticket_status == 2)
                                            <span class="badge badge-success">@lang('sentence.Payment Done')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('sentence.Pending Payment')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($Booking->status == 0)
                                            <span class="badge badge-success">@lang('sentence.Valid')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('sentence.InValid')</span>
                                        @endif
                                    </td>
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
