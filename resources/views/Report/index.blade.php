@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Reports')</li>
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
                <h3 class="card-title"><i class="fas fa-star"></i> @lang('sentence.Yearly Events Created')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="EventData" height="150" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i> @lang('sentence.Yearly Users Joined')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="UserData" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-secret"></i> @lang('sentence.Yearly Organizers Joined')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="OrganizerData" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var year =  {{ $year }} 
        var month =  {{ $month }} 
        var user =   {{ $user }}
        var event =   {{ $event }}
        var organizer =   {{ $organizer }} 
        var EventData = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Events')',
                backgroundColor: "#17a2b8",
                data: event
            }]
        };
        var UserData = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Users')',
                backgroundColor: "#17a2b8",
                data: user
            }]
        };
        var OrganizerData = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Organizers')',
                backgroundColor: "#17a2b8",
                data: organizer
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
                        text: 'Yearly Users And Organizers Joined'
                    }
                }
            });
            var ctx2 = document.getElementById("UserData").getContext("2d");
            window.myBar = new Chart(ctx2, {
                type: 'bar',
                data: UserData,
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
            var ctx3 = document.getElementById("OrganizerData").getContext("2d");
            window.myBar = new Chart(ctx3, {
                type: 'bar',
                data: OrganizerData,
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
