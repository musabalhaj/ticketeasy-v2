@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Events Reports')</li>
        </ol>
    </nav>
</h6>
<hr>
@endsection
@section('content')
<div class="row">

    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-star"></i> @lang('sentence.Monthly Events Created')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="EventData2" height="200" width="600"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-star"></i> @lang('sentence.Yearly Events Created')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="EventData" height="200" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var year =  {{ $year }} 
        var month =  {{ $month }}
        var event =   {{ $event }}
        var event2 =   {{ $event2 }}
        var EventData = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Events')',
                backgroundColor: "#17a2b8",
                data: event,
                backgroundColor     : 'transparent',
                borderColor         : '#007bff',
                pointBorderColor    : '#1f2937',
                pointBackgroundColor: '#1f2937',
                fill                : false
            }]
        };
        var EventData2 = {
            labels: month,
            datasets: [{
                label: '@lang('sentence.Events')',
                backgroundColor: "#17a2b8",
                data: event2,
                backgroundColor     : 'transparent',
                borderColor         : '#007bff',
                pointBorderColor    : '#1f2937',
                pointBackgroundColor: '#1f2937',
                fill                : false
            }]
        };
        window.onload = function() {
            var ctx = document.getElementById("EventData").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'line',
                data: EventData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Yearly Events Created'
                    }
                }
            });
            var ctx2 = document.getElementById("EventData2").getContext("2d");
            window.myBar = new Chart(ctx2, {
                type: 'line',
                data: EventData2,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Monthly Events Created'
                    }
                }
            });
        };
    </script>
    
@endsection
