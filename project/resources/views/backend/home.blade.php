@extends('layouts.backend.app')
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{!! $pages_title !!}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/dashboard' )) }}">{{ __('main.dashboard') }}</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">        
                        <h4 class="card-title" id="1">Welcome Back!&nbsp;&nbsp;<strong>{{ $data_user->name }}</strong></h4>
                        <h4 class="card-subtitle">{{ $data_user->display_name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <h4 class="card-title">Nilai Mahasiswa<br><small class="text-muted">Berdasarkan matakuliah</small></h4>
                            <div class="ml-auto">
                                <select name="course_id" class="form-control" onclick="chart_courses()">
                                    <option value="" disabled selected>--{{ __('main.choose') }} {{ __('main.course') }}--</option>
                                    @foreach ($data_courses as $kcourse => $vcourse)
                                        <option value="{{ $vcourse->courses_id }}">{{ $vcourse->courses->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="grade-courses"></div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-body">        
                        <!-- <div id="grade-coursesa"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ URL::asset('admin_assets/plugins/highcharts/highcharts.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/plugins/highcharts/exporting.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/plugins/highcharts/series-label.js') }}"></script>
    <script type="text/javascript">
            @if (session()->has('success'))
                $.toast({
                    heading: 'Welcome {{ $data_user->name }}',
                    text: '{!! session()->get('success') !!}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 5500, 
                    stack: 6
                });
            @endif


            // ChartCourses
            function chart_courses(){
                var course_id = $("select[name=course_id]").val();
                var course_name = $("select[name=course_id]").find('option:selected').text();
                $.ajax({
                    url : "dashboard/report/grade-courses",
                    type: "POST",
                    dataType: "JSON",
                    data: {"course_id":course_id},
                    headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    success: function(response){
                        Highcharts.chart('grade-courses', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: course_name
                            },
                            subtitle: {
                                text: ""
                            },
                            xAxis: {
                                categories: response.categories,
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '0 - 100'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: response.series
                        });
                    },
                    error: function (response){
                        alert(data);
                    }
                })                

            }

    </script>
@endpush
