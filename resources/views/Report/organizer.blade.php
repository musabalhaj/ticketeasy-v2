@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('sentence.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Organizers Reports')</li>
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
                <h3 class="card-title"><i class="fas fa-user-secret"></i> @lang('sentence.Monthly Organizers Joined')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="OrganizerData2" height="200" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
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
                <canvas id="OrganizerData" height="200" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var year =  {{ $year }} 
        var month =  {{ $month }} 
        var organizer =   {{ $organizer }} 
        var organizer2 =   {{ $organizer2 }}
        var OrganizerData = {
            labels: year,
            datasets: [{
                label: '@lang('sentence.Organizers')',
                backgroundColor: "#17a2b8",
                data: organizer
            }]
        };
        var OrganizerData2 = {
            labels: month,
            datasets: [{
                label: '@lang('sentence.Organizers')',
                backgroundColor: "#17a2b8",
                data: organizer2
            }]
        };
        
        window.onload = function() {
            var ctx1 = document.getElementById("OrganizerData").getContext("2d");
            window.myBar = new Chart(ctx1, {
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
                        text: 'Yearly Organizers Joined'
                    }
                }
            });
            var ctx2 = document.getElementById("OrganizerData2").getContext("2d");
            window.myBar = new Chart(ctx2, {
                type: 'bar',
                data: OrganizerData2,
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
                        text: 'Yearly Organizers Joined'
                    }
                }
            });
        };
    </script>
    
@endsection
