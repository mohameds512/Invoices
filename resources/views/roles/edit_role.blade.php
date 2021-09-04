@extends('layouts.master')

@section('title')
أضافة صلاحية
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل صلاحية </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')



                            @if ($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error )
                                    <li> {{$error}} </li>
                                @endforeach
                            </ul>
                            </div>

                            @endif

				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">

                                </div>

                            </div>

                            <div class="card-body">
                                <form action="{{ route('roles.update',[$role->id])}}" method="POST" autocomplete="off">
                                    {{method_field('PATCH')}}
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label"> اسم الصلاحية </label>
                                                <input type="text" class="form-control"  id="name" name="name" value="{{$role->name}}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label">  صلاحيات المستخدم  </label>

                                                <div class="panel panel-primary tabs-style-2">
                                                    <div class=" tab-menu-heading">
                                                        <div class="tabs-menu1">
                                                            <!-- Tabs -->
                                                            <ul class="nav panel-tabs main-nav-line">
                                                                <li><a href="#tab4" class="nav-link active" data-toggle="tab">الفواتير</a></li>
                                                                <li><a href="#tab5" class="nav-link" data-toggle="tab">المستخدمين</a></li>
                                                                <li><a href="#tab6" class="nav-link" data-toggle="tab">التقارير</a></li>
                                                                <li><a href="#tab7" class="nav-link" data-toggle="tab">الاعدادات</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab4">
                                                                @foreach ($permissions as $index=> $permission)
                                                                @if ($index>=0 && $index <13)
                                                                    <label style="padding-left: 10px">
                                                                    <input type="checkbox" class="form-check-input" name="permissions_id[]" value="{{$permission->id}}" $checked>
                                                                    {{$permission->name}}
                                                                </label>
                                                                @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="tab-pane" id="tab5">
                                                                @foreach ($permissions as $index=> $permission)
                                                                @if ($index>=13 && $index <23)
                                                                    <label style="padding-left: 10px">
                                                                    <input type="checkbox" class="form-check-input" name="permissions_id[]" value="{{$permission->id}}">
                                                                    {{$permission->name}}
                                                                </label>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="tab-pane" id="tab6">
                                                                @foreach ($permissions as $index=> $permission)
                                                                @if ($index>=23 && $index <26)
                                                                    <label style="padding-left: 10px">
                                                                    <input type="checkbox" class="form-check-input" name="permissions_id[]" value="{{$permission->id}}">
                                                                    {{$permission->name}}
                                                                </label>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="tab-pane" id="tab7">
                                                                @foreach ($permissions as $index=> $permission)
                                                                @if ($index>=26 && $index <=35)
                                                                    <label style="padding-left: 10px">
                                                                    <input type="checkbox" class="form-check-input" name="permissions_id[]" value="{{$permission->id}}">
                                                                    {{$permission->name}}
                                                                </label>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <center>
                                            <button type="submit" class="btn btn-main-primary pd-x-20 ">أضافة</button>
                                            <br>
                                        </center>
                                        <br><br><br><br>
                                    </div>


                                    <br>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action=""></form>

                    </div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
{{-- edit modal  --}}
{{-- <script src="{{URL::asset('assets/plugins/InvoicesJS/edit.js')}}"></script> --}}
@endsection
