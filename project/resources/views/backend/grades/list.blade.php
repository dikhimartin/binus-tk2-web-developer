@extends('layouts.backend.app')
@section('sidebarActive', $controller)

@section('content')
    <link href="{{URL::asset("admin_assets/assets/plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        table , td, th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }
        .select2-container {
            width: 100% !important;
        }        
    </style>

    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{!! $pages_title !!}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/dashboard' )) }}">{{ __('main.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('main.master_data') }}</a></li>
                <li class="breadcrumb-item active">{!! $pages_title !!}</li>
            </ol>
        </div>
    </div>

    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="loading" style="display: none;">Loading&#8230;</div>
            <!-- Filter Data -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-default">
                    <div class="card-header bg-info text-white">
                        {{__('main.filter_data')}}
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 collapse show">
                        <div class="card-body">
                                <div class="row">
                                     <div class="col-md-12">
                                        <form action="" method="GET">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{__('main.search_by')}}</label>
                                                        <select name="field_filter" class="form-control">
                                                            <option value="name" {{ $field_filter == 'name' ? "selected" : "" }}>{{__('main.name')}}</option>
                                                            <option value="description" {{ $field_filter == 'description' ? "selected" : "" }}>{{__('main.description')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label style="color: white;">Operator {{ $operator_filter}}</label>
                                                        <select name="operator_filter" class="form-control">
                                                            <option value="LIKE" {{ $operator_filter == 'LIKE' ? "selected" : "" }}>Contain (like)</option>
                                                            <option value="=" {{ $operator_filter == '=' ? "selected" : "" }}>Equal (=)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="color: white;">Operator</label>
                                                        <input type="text" name="text_filter" class="form-control" value="{{$text_filter}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <button class="btn btn-info btn-sm waves-light btn-search" type="submit"><span class="btn-label"><i class="fa fa-search"></i></span>&nbsp;{{__('main.search')}}
                                                </button>

                                                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'admin/'.$controller )) }}" class="btn btn-warning btn-sm btn-reload" data-toggle="tooltip" data-placement="top" title="{{__('main.reload')}}">
                                                    <i class="fa fa-refresh"></i>&nbsp;{{__('main.reload')}}
                                                </a>
                                            </div>
                                        </form>
                                     </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card-header bg-info text-white">
                    <div class="card-actions ">
                    </div>
                    {{__('main.list_data')}}
                </div>
                <div class="card">

                    <p style="margin-bottom: 20px;"></p>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="button-group">
                                @permission('students-create')
                                <a href="javascript:void(0)">
                                        <button onclick="add()" class="btn btn-info btn-sm waves-light" type="button" data-toggle="tooltip" data-placement="top" title="{{__('main.add_new')}}"><span class="btn-label"><i class="fa fa-plus"></i></span>&nbsp;{{__('main.add_new')}}
                                        </button>
                                </a>
                                @endpermission

                                @permission('students-delete')
                                <a href="javascript:void(0)">
                                    <button id="btn-hps-semua" onclick="removed_all_data()" class="btn btn-danger btn-sm waves-light" type="button" data-toggle="tooltip" data-placement="top" title="{{__('main.delete_all')}}"><span class="btn-label"><i class="fa fa-trash"></i>
                                        </span>&nbsp;{{__('main.delete_all')}}
                                    </button>
                                </a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <p style="margin-bottom: 20px;"></p>

                    <div id="notif_success"></div>

                    <div class="table-responsive">
                        <table class="table table-hover" id='recordsTable'>
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <td rowspan="2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="parent-checkbox-hapus" onClick="toggle(this)">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td rowspan="2">Nama Mahasiswa</td>
                                    <td rowspan="2">Fakultas</td>
                                    <td rowspan="2">Mata Kuliah</td>
                                    <td style="text-align: center;" colspan="7">Informasi Nilai</td>
                                    <tr class="bg-secondary text-white">
                                        <td>Nilai Quiz</td>
                                        <td>Nilai Tugas</td>
                                        <td>Nilai Absensi</td>
                                        <td>Nilai praktek</td>
                                        <td>Nilai UAS</td>
                                        <td>Total&nbsp;</td>
                                        <td>Grade</td>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($rows->isEmpty())
                                <td colspan="11" class="text-center alert-danger">{{__('main.data_empty')}}</td>
                            @else
                                @foreach ($rows as $key => $value)
                                    <tr id='tr_{{$value->id}}'>
                                        <td width="10">
                                            <label class="custom-control custom-checkbox">
                                                <input  name="ceklis_data" type="checkbox" class="custom-control-input" id='del_{{$value->id}}'>
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td>{{$value->student->name}}</td>
                                        <td>{{$value->student->faculties->name}}</td>
                                        <td class="text-primary">
                                            {{$value->courses->code}} - 
                                            {{$value->courses->name}}
                                        </td>
                                        <td>{{$value->quiz}}</td>
                                        <td>{{$value->assignment}}</td>
                                        <td>{{$value->attendance}}</td>
                                        <td>{{$value->practice}}</td>
                                        <td>{{$value->final_exam}}</td>
                                        <td>{{$value->total_score}}</td>
                                        <td class='text-info font-weight-bold'>
                                            {{$value->grade}}
                                        </td>
                                        <!-- <td>
                                            <div class="hidden-sm hidden-sm action-buttons center">
                                                @permission('grades-edit')
                                                    <a href="javascript:void(0)"> <a href="javascript:void(0)" onclick="edited(`{{$value->id}}`)" class="btn waves-effect waves-light btn-rounded btn-sm btn-info"data-toggle="tooltip" data-placement="top" title="{{__('main.edit')}}"><i class="fa fa-pencil"></i>
                                                    </a>
                                                @endpermission
                                                @permission('grades-delete')
                                                    <a href="javascript:void(0)"> <a href="javascript:void(0)" onclick="removed(`{{$value->id}}`)" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger"data-toggle="tooltip" data-placement="top" title="{{__('main.delete')}}"><i class="fa fa-trash"></i>
                                                    </a>
                                                @endpermission
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- paginate-->
                    <p style="margin-bottom: 40px;"></p>
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <div>{{ __('main.showing') }} {{ ($rows->currentPage() - 1) * $rows->perPage() + 1 }} {{ __('main.to') }} {{ $rows->count() * $rows->currentPage() }} {{ __('main.of') }} {{ $rows->total() }} {{ __('main.records') }}</div>
                        </div>
                        <div class="col-md- col-sm-7 block-paginate">
                            {{ $rows->appends(['rows' => $rows])->render() }}
                        </div>
                    </div>
                    <p style="margin-bottom: 40px;"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Modal -->
    <div class="modal fade col-md-12" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" id="form_data_model" enctype="multipart/form-data">
          {{ csrf_field() }}
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header center bg-info">
              <h4 class="modal-title text-white"></h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal Form -->
            <div class="modal-body">
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-12">

                                    <input type="hidden" value="" name="id" id="id" />

                                    <div class="form-group">
                                        <label class="control-label col-md-5">Pilih Mahasiswa <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <select name="student_id" class="form-control select2">
                                                <option selected disabled="">{{__('main.search')}}</option>
                                                @foreach($students as $kstudents => $vstudents)
                                                    <option  value="{{$vstudents->id}}">{{$vstudents->name}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"></small>
                                        </div>
                                    </div>


                                    <!-- course -->
                                    <div class="form-group">
                                       <label class="control-label col-md-5">{{ __('main.course') }} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                             <select name="courses_id" class="form-control">
                                                <option value="" disabled selected>--{{ __('main.choose') }} {{ __('main.course') }}--</option>
                                                @foreach ($courses as $kcourses => $vcourses)
                                                    <option value="{{ $vcourses->id }}">{{ $vcourses->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label col-md-5"> {{__('main.quiz_score')}} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="quiz" required="" placeholder="{{__('main.quiz_score')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label col-md-5"> {{__('main.assignment_score')}} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="assignment" required="" placeholder="{{__('main.assignment_score')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label col-md-5"> {{__('main.attendance_score')}} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="attendance" required="" placeholder="{{__('main.attendance_score')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label col-md-5"> {{__('main.practice_score')}} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="practice" required="" placeholder="{{__('main.practice_score')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label col-md-5"> {{__('main.final_exam_score')}} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="final_exam" required="" placeholder="{{__('main.final_exam_score')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
                <div class="modal-footer">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-info btn-sm"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;{{__('main.save')}}</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-reply">&nbsp;</i>{{__('main.cancel')}}</button>  
                </div>
            </div>

          </div>
        </form>
      </div>
    </div>           
@endsection

@push('js')
    <script src="{{URL::asset("admin_assets/assets/plugins/select2/dist/js/select2.full.min.js")}}" type="text/javascript"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            $(".select2").select2();
        });

        $(".btn-reload").on("click", function () {
            $(".loading").show("fast");
        });     
        $(".btn-search").on("click", function () {
            $(".loading").show("fast");
        });     
        $("#notif_success").hide();
        disabledButtonHapusSemua();
        $("input[type=checkbox]").on("click", function() {
            disabledButtonHapusSemua();
        });

        function toggle(source) {
          checkboxes = document.getElementsByName('ceklis_data');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }

        function add(){
            save_method = 'add';
            $('#btnSave').text('{{__('main.save')}}'); //change button text
            $('#form_data_model')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-danger'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('{{ __("main.add") }} {!! $pages_title !!}');
        }

        function edited(id){
            save_method = 'update';
            $('#btnSave').text('{{__('main.update')}}'); //change button text
            $('#form_data_model')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-danger'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "{{ url('admin/grades') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(result){
                    if(result.data != null){
                        $('[name="id"]').val(result.data.id);
                        $('[name="name"]').val(result.data.name);
                        $('[name="email"]').val(result.data.email);
                        $('[name="description"]').val(result.data.description);
    
                        $('#modal_form').modal('show');
                        $('.modal-title').text('{{ __("main.edit") }} {!! $pages_title !!}');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        }

        function save(){
            $('#btnSave').attr('disabled',true); //set button disable
            var url;

            if(save_method == 'add') {
                url ="{{url('admin/grades/save')}}";
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;{{__('main.saving')}} ...'); //change button text
            } else {
                url ="{{url('admin/grades/update')}}";
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;{{__('main.updated')}} ...'); //change button text
            }
            // ajax adding data to database
            var formData = new FormData($('#form_data_model')[0]);

            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data){
                    if(data.data_post) {
                        $('.loading').show("fast");
                        $('#modal_form').modal('hide');
                        $("#notif_success").animate({
                                left: "+=50",
                                height: "toggle"
                            }, 100, function() {
                        });
                        document.getElementById("notif_success").innerHTML ="<div class='alert alert-"+data.data_post['class']+"'>"+ data.data_post['message']+ "</div>";
                        setTimeout(function() {
                                $('#notif_success').hide();
                        }, 1500);
                        location.reload();
                    }else{
                        for (var i = 0; i < data.inputerror.length; i++){
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-danger'); //select parent twice to select div form-group class and add has-danger class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('{{__('main.save')}}'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (data){
                    alert('Error adding data');
                    $('#btnSave').text('{{__('main.save')}}'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }

        function removed(id){
                swal({
                    title: "{{ __('main.are_you_sure') }}",   
                    text: "{{ __('main.are_you_sure_detail') }}",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#dc3545",   
                    confirmButtonText: "{{ __('main.yes_deleted') }}",   
                    cancelButtonText: "{{ __('main.no_cancel') }}",   
                    closeOnConfirm: false,   
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                 function(isConfirm){
                   if (isConfirm) {
                    var url ="{{url('admin/grades/deleted')}}";
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: {"id":id},
                        dataType: "JSON",
                        headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        },
                        success: function(result){
                             if(result.data_post.status){   
                                swal("{{ __('main.done') }}","{{ __('main.done_detail') }}","success");
                                $("#notif_success").animate({
                                        left: "+=50",
                                        height: "toggle"
                                    }, 100, function() {
                                });
                                document.getElementById("notif_success").innerHTML ="<div class='alert alert-"+result.data_post['class']+"'>{{__('main.data_succesfully_deleted')}}</div>";
                                setTimeout(function() {
                                        $('#notif_success').hide();
                                }, 1500);
                                $("#tr_"+id).remove();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error deleting data');
                        }
                    });
                  }else{
                        swal("{{ __('main.cancelled') }}", "{{ __('main.cancelled_detail') }}", "error");
                  } 
               })
        }

        function removed_all_data(){
                swal({
                    title: "{{ __('main.are_you_sure') }}",   
                    text: "{{__('main.are_you_sure_delete_all_detail')}}",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#dc3545",   
                    confirmButtonText: "{{ __('main.yes_deleted') }}",   
                    cancelButtonText: "{{ __('main.no_cancel') }}",    
                    closeOnConfirm: false,   
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                },
                 function(isConfirm){
                    if (isConfirm) {

                        var post_arr = [];
                        $('#recordsTable input[type=checkbox]').each(function() {
                            if (jQuery(this).is(":checked")) {
                                var id = this.id;
                                var splitid = id.split('_');
                                if(splitid != ''){
                                    var postid = splitid[1];
                                    post_arr.push(postid);
                                }
                            }
                        });


                        if(post_arr.length > 0){
                            var url ="/admin/grades/deleted_all/"+post_arr;

                            // AJAX Request
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: { id: post_arr},
                                headers:
                                {
                                    'X-CSRF-Token': $('input[name="_token"]').val()
                                },
                                success: function(result){
                                    swal("{{ __('main.done') }}","{{ __('main.done_detail') }}","success");
                                    $.each(post_arr, function( i,l ){
                                        $("#tr_"+l).remove();
                                    });
                                    $("#notif_success").animate({
                                            left: "+=50",
                                            height: "toggle"
                                        }, 100, function() {
                                     });
                                    document.getElementById("notif_success").innerHTML ="<div class='alert alert-danger'>{{__('main.data_succesfully_deleted')}}</div>";
                                    setTimeout(function() {
                                            $('#notif_success').hide();
                                    }, 1500);

                                }
                            });
                        }   
                        }else{
                            swal("{{ __('main.cancelled') }}", "{{ __('main.cancelled_detail') }}", "error");
                        } 
                     })
        }

    </script>
@endpush
