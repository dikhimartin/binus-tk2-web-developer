@extends('layouts.backend.app')
@section('sidebarActive', $controller)

@section('content')
    <style type="text/css">
        table , td, th {
            border: 1px solid #595959;
            border-collapse: collapse;
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
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="parent-checkbox-hapus" onClick="toggle(this)">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td>Nomor Induk Mahasiswa</td>
                                    <td>{{__('main.name')}}</td>
                                    <td>{{__('main.faculty')}}</td>
                                    <td>{{__('main.description')}}</td>
                                    <td>{{__('main.status')}}</td>
                                    <td>{{__('main.action')}}</td>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($rows->isEmpty())
                                <td colspan="7" class="text-center alert-danger">{{__('main.data_empty')}}</td>
                            @else
                                @foreach ($rows as $key => $value)
                                    <tr id='tr_{{$value->id}}'>
                                        <td width="10">
                                            <label class="custom-control custom-checkbox">
                                                <input  name="ceklis_data" type="checkbox" class="custom-control-input" id='del_{{$value->id}}'>
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td>{{$value->code}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->faculties->name}}</td>
                                        <td>{{$value->description}}</td>
                                        <td>
                                        <div class="switch">
                                            <label>
                                                <input onclick="status_change(this.checked, `{{$value->id}}`)" name="status_change" type="checkbox"{{$value->status == 'Y' ? "checked" : "" }}><span class="lever switch-col-blue" value="Y"></span>
                                            </label>
                                        </div>
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-sm action-buttons center">
                                                @permission('students-edit')
                                                    <a href="javascript:void(0)"> <a href="javascript:void(0)" onclick="edited(`{{$value->id}}`)" class="btn waves-effect waves-light btn-rounded btn-sm btn-info"data-toggle="tooltip" data-placement="top" title="{{__('main.edit')}}"><i class="fa fa-pencil"></i>
                                                    </a>
                                                @endpermission
                                                @permission('students-delete')
                                                    <a href="javascript:void(0)"> <a href="javascript:void(0)" onclick="removed(`{{$value->id}}`)" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger"data-toggle="tooltip" data-placement="top" title="{{__('main.delete')}}"><i class="fa fa-trash"></i>
                                                    </a>
                                                @endpermission
                                            </div>
                                        </td>
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

                                    <!--nim-->
                                    <div class="form-group">
                                       <label class="control-label col-md-5">Nomor Induk Mahasiswa<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="code" required="" placeholder="NIM" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <!--name-->
                                    <div class="form-group">
                                       <label class="control-label col-md-5">{{ __('main.name') }} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" required="" placeholder="{{__('main.name')}}" class="form-control">
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>
                                    
                                    <!-- faculty -->
                                    <div class="form-group">
                                       <label class="control-label col-md-5">{{ __('main.faculty') }} <span class="required">*</span></label>
                                        <div class="col-md-9">
                                             <select name="faculties_id" class="form-control">
                                                <option value="" disabled selected>--{{ __('main.choose') }} {{ __('main.faculty') }}--</option>
                                                @foreach ($faculties as $kfaculties => $vfaculties)
                                                    <option value="{{ $vfaculties->id }}">{{ $vfaculties->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"></small>
                                        </div>
                                    </div>

                                    <!--description-->
                                    <div class="form-group">
                                       <label class="control-label col-md-5">{{ __('main.description') }}</label>
                                        <div class="col-md-9">
                                             <textarea name="description" class="form-control" placeholder="{{__('main.description')}}" data-autosize></textarea>
                                             <small class="form-control-feedback"></small>
                                        </div>
                                    </div>


                                    <!--status-->    
                                    <div class="form-body" id="status">
                                        <div class="form-group">
                                            <label for="status" class="col-md-5 control-label">{{ __('main.status') }} <span class="required" aria-required="true"> * </span></label>
                                            <div class="col-md-10">
                                               <div class="demo-radio-button">
                                                    <input name="status" type="radio" value="Y" class="with-gap price_type" id="radio_1" checked="" />
                                                    <label for="radio_1">{{__('main.active')}}</label>
                                                    <input name="status" type="radio" value="N" class="with-gap price_type" id="radio_2"/>
                                                    <label for="radio_2">{{__('main.non-active')}}</label>
                                                </div>
                                            </div>
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
    <script type="text/javascript">
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

        $(document).ready(function() {
            $('input[name="code"]').on('input', function() {
                var value = $(this).val();
                var newValue = '';
                for (var i = 0; i < value.length; i++) {
                    if (!isNaN(value[i]) && newValue.length < 10) {
                        newValue += value[i];
                    }
                }
                $(this).val(newValue);
            });
        });

        function toggle(source) {
          checkboxes = document.getElementsByName('ceklis_data');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }

        function status_change(source, id){
            var url;
            if(source == true){
                $.ajax({
                    url : "/admin/students/change_status_active/"+id,
                    type: "POST",
                    data: {"id":id},
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    success: function(data)
                    {

                        if (data == "error_403") {
                            $('#modals_confirm').modal('hide');
                            swal("{{__('main.failed')}}","{{__('main.dont_have_permission')}}","error");
                        }

                         $.toast({
                            heading: '{{__('main.success')}}',
                            text: '{{__('main.data_already_active')}}',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: data.data_post.class,
                            hideAfter: 3000, 
                            stack: 6
                          });
                    },
                    error: function (data)
                    {
                    alert('Error adding data');
                    }
                });
            }else{
                $.ajax({
                    url : "/admin/students/change_status_inactive/"+id,
                    type: "POST",
                    data: {"id":id},
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    success: function(data)
                    {


                        if (data == "error_403") {
                            $('#modals_confirm').modal('hide');
                            swal("{{__('main.failed')}}","{{__('main.dont_have_permission')}}","error");
                        }                        

                         $.toast({
                            heading: '{{__('main.success')}}',
                            text: '{{__('main.data_inactive')}}',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: data.data_post.class,
                            hideAfter: 3000, 
                            stack: 6
                          });
                    },
                    error: function (data)
                    {
                    alert('Error adding data');
                    }
                });
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
                url: "{{ url('admin/students') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(result){
                    if(result.data != null){
                        $('[name="id"]').val(result.data.id);
                        $('[name="code"]').val(result.data.code);
                        $('[name="name"]').val(result.data.name);
                        $('[name="email"]').val(result.data.email);
                        $('[name="description"]').val(result.data.description);
    
                        var status =result.data.status;
                        if(status == 'Y'){
                            $('#status').find(':radio[name=status][value="Y"]').prop('checked', true);
                        }else{
                            $('#status').find(':radio[name=status][value="N"]').prop('checked', true);
                        }

                        $('[name="faculties_id"] option[value='+result.data.faculties_id+']').prop('selected',false);
                        $('[name="faculties_id"] option[value='+result.data.faculties_id+']').prop('selected',true);

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
                url ="{{url('admin/students/save')}}";
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;{{__('main.saving')}} ...'); //change button text
            } else {
                url ="{{url('admin/students/update')}}";
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
                    } else{
                        for (var i = 0; i < data.inputerror.length; i++){
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-danger'); //select parent twice to select div form-group class and add has-danger class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('{{__('main.save')}}'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (data){
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
                    var url ="{{url('admin/students/deleted')}}";
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
                            console.log(url);
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
                            var url ="/admin/students/deleted_all/"+post_arr;

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
