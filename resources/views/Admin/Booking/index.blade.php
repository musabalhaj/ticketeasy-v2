@extends('layouts.master')
@section('content-header')

<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Bookings')</li>
        </ol>
    </nav> 
</h6>
<hr>
@endsection
@section('content')

    @if (count($Bookings) == 0)
        <div class="row empty">
            <div class="col-4 mt-5">
                <p class="mt-5">
                    @lang('sentence.Here You Can View Booking For An Event Or Bookings For All Events.')
                </p>    
            </div>
            <div class="col-8">
                <img src="{{ asset('images/Plain credit card-bro.png') }}" width="100%" height="400px" alt="{{ __('Plain credit card-bro.png') }}">
            </div>  
        </div>
    @else
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list"></i> @lang('sentence.Bookings List')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body"> 
                <div class="custom-form create mb-2">
                    <form action="{{ route('Booking.index') }}" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="search" value="{{ request()->query('search') }}"
                            placeholder="@lang('sentence.Search By Event')" style="max-width: 373px;">
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>  
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th>@lang('sentence.#ID')</th>
                                <th>@lang('sentence.User')</th>
                                <th>@lang('sentence.Event')</th>
                                <th>@lang('sentence.Seats')</th>
                                <th>@lang('sentence.Amount')</th>
                                <th>@lang('sentence.Ticket Status')</th>
                                <th>@lang('sentence.Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Bookings as $v=>$Booking)
                                <tr>
                                    <td>{{ $v+1 }} </td>
                                    <td>{{ $Booking->User->name }}</td>
                                    <td>{{ $Booking->Event->title }}</td>
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
                <div class="paginate">
                    {{ $Bookings->appends(['search' => request()->query('search') ])->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection
