@extends('layouts.master')
@section('content-header')
<h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">@lang('sentence.Home')</li>
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
                <h3 class="card-title">@lang('sentence.Yearly Users And Organizers Joined')</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                <canvas id="canvas" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var year = <?php echo $year; ?>;
        var user = <?php echo $user; ?>;
        var organizer = <?php echo $organizer; ?>;
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'Users',
                backgroundColor: "#17a2b8",
                data: user
            },
            {
                label: 'Organizers',
                backgroundColor: "blue",
                data: organizer
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
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
        };
    </script>
    
@endsection
