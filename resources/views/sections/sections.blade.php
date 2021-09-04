@extends('layouts.master')
@section('title')
    الاقسام
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
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

                @if (session()->has('Add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{session()->get('Add')}} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('Error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{session()->get('Error')}} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('edit'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{session()->get('edit')}} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{session()->get('delete')}} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    @endif
				<!-- row -->
				<div class="row">

                        {{-- modal table --}}
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">أضافة قسم</a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0"> اسم القسم </th>
                                                <th class="border-bottom-0">الوصف </th>
                                                <th class="border-bottom-0">تعديلات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sections as $index => $section)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td> {{ $section->section_name }} </td>
                                                <td>{{ $section->description }} </td>
                                                <td>
                                                    {{-- edit button --}}
                                                    <a class="modal-effect btn btn-info btn-sm" data-effect="effect-scale"
                                                        data-id="{{$section->id}}" data-name="{{$section->section_name}}"
                                                        data-description="{{$section->description}}" data-toggle="modal" href="#editSection"
                                                        title="تعديل"> <i class="las la-pen"></i>
                                                    </a>

                                                    {{-- delete button --}}
                                                    <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale"
                                                        data-id="{{$section->id}}" data-name="{{$section->section_name}}"
                                                        data-toggle="modal" href="#deleteModel" title="حذف"> <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->
                    <!--  basic modals  -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title"> أضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('sections.store') }}" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="exampleInputEmail">أسم القسم</label>
                                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">تأكيد</button>
                                            <button class="btn  btn-secondary" data-dismiss="modal" type="button">حذف</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End basic modals  -->

                    <!-- edit Modals -->
                    <div class="modal" id="editSection">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title"> تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="sections/update" method="POST" autocomplete="off">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input type="hidden" name="section_id" id="section_id" value="">
                                            <label for="exampleInputEmail">أسم القسم</label>
                                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                                            <textarea class="form-control" id="section_description" name="section_description" rows="3"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">تأكيد</button>
                                            <button class="btn  btn-secondary" data-dismiss="modal" type="button">حذف</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End edit Modals -->

                    <!-- delete Modals -->
                    <div class="modal" id="deleteModel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title"> حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="sections/destroy" method="POST">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}

                                        <p>هل أنت متأكد من عملية الحذف ؟ </p><br>

                                        <input type="hidden" name="section_id" id="section_id">
                                        <input type="text" class="form-control" name="section_name" id="section_name" readonly>
                                        <br>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">تأكيد</button>
                                            <button class="btn  btn-secondary" data-dismiss="modal" type="button">ألغاء</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End delete Modals -->
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
            {{-- edit modal  --}}
<script src="{{URL::asset('assets/plugins/InvoicesJS/edit.js')}}"></script>

<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

                    <!--  modals css  -->
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
