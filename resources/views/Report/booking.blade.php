@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Bookings Reports')</li>
        </ol>
    </nav>
</h6>
<hr>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> @lang('sentence.Monthly Valid And InValid Ticket')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="ValidTicketMonthly" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> @lang('sentence.Yearly Valid And InValid Ticket')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="ValidTicketYearly" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> @lang('sentence.Monthly Paied And UnPaied Ticket')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="TicketMonthly" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> @lang('sentence.Yearly Paied And UnPaied Ticket')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="TicketYearly" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var year =  {{ $year }} 
        var month =  {{ $month }}  
        var PaiedTicketMonthly =   {{ $PaiedTicketMonthly }} 
        var UnPaiedTicketMonthly =   {{ $UnPaiedTicketMonthly }} 
        var PaiedTicketYearly =   {{ $PaiedTicketYearly }} 
        var UnPaiedTicketYearly =   {{ $UnPaiedTicketYearly }} 
        var ValidTicketMonthly =   {{ $ValidTicketMonthly }} 
        var InValidTicketMonthly =   {{ $InValidTicketMonthly }} 
        var ValidTicketYearly =   {{ $ValidTicketYearly }} 
        var InValidTicketYearly =   {{ $InValidTicketYearly }} 

        var TicketMonthly = {
            labels: month,
            datasets: [{
                label: '@lang('sentence.Paied Ticket')',
                backgroundColor: "green",
                data: PaiedTicketMonthly
            },
            {
                label: '@lang('sentence.UnPaied Ticket')',
                backgroundColor: "red",
                data: UnPaiedTicketMonthly
            }]
        };
        var TicketYearly = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Paied Ticket')',
                backgroundColor: "green",
                data: PaiedTicketYearly
            },
            {
                label: '@lang('sentence.UnPaied Ticket')',
                backgroundColor: "red",
                data: UnPaiedTicketYearly
            }]
        };
        var ValidTicketMonthly = {
            labels: month,
            datasets: [{
                label: '@lang('sentence.Valid')',
                backgroundColor: "green",
                data: ValidTicketMonthly
            },
            {
                label: '@lang('sentence.InValid')',
                backgroundColor: "red",
                data: InValidTicketMonthly
            }]
        };
        var ValidTicketYearly = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Valid')',
                backgroundColor: "green",
                data: ValidTicketYearly
            },
            {
                label: '@lang('sentence.InValid')',
                backgroundColor: "red",
                data: InValidTicketYearly
            }]
        };
        window.onload = function() {
            var ctx4 = document.getElementById("TicketMonthly").getContext("2d");
            window.myBar = new Chart(ctx4, {
                type: 'bar',
                data: TicketMonthly,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom',
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Yearly Users And Organizers Joined'
                    }
                }
            });
            var ctx5 = document.getElementById("TicketYearly").getContext("2d");
            window.myBar = new Chart(ctx5, {
                type: 'bar',
                data: TicketYearly,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom',
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Yearly Users And Organizers Joined'
                    }
                }
            });
            var ctx6 = document.getElementById("ValidTicketMonthly").getContext("2d");
            window.myBar = new Chart(ctx6, {
                type: 'bar',
                data: ValidTicketMonthly,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom',
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Yearly Users And Organizers Joined'
                    }
                }
            });
            var ctx7 = document.getElementById("ValidTicketYearly").getContext("2d");
            window.myBar = new Chart(ctx7, {
                type: 'bar',
                data: ValidTicketYearly,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom',
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Yearly Users And Organizers Joined'
                    }
                }
            });
        };
    </script>
    
@endsection
