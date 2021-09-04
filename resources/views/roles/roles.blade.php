@extends('layouts.master')
@section('title')
    صلاحيات المستخدمين
@endsection
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
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ صلاحيات المستخدمين </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                {{-- Notifications --}}
                @if (session()->has('delete_invoice'))
                    <script>
                        window.onload = function () {
                            notif({
                            msg: "تم حذف الفاتورة",
                            type: "success"
                        });
                        }

                    </script>
                @endif
                @if (session()->has('update_status'))
                    <script>
                        window.onload = function () {
                            notif({
                            msg: "تم تحديث حالة الدفع بنجاح",
                            type: "success"
                        });
                        }

                    </script>
                @endif
                @if (session()->has('Add'))
                    <script>
                        window.onload = function () {
                            notif({
                            msg: "تم اضافة الصلاحية بنجاح   ",
                            type: "success"
                        });
                        }

                    </script>
                @endif
				<!-- row -->
				<div class="row">

                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex my-xl-auto left-content">
                                    <div class="pr-1 mb-3 mb-xl-0">
                                        <a class="btn btn-info btn-sm float-left mt-3 btn-block" href="roles/create">
                                            <i class="fas fa fa-plus"></i> أضافة صلاحية</a>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0"> الاسم</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $index => $role)
                                            <tr>
                                                <td> {{$index + 1}} </td>
                                                <td> {{$role->name}} </td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="{{ route('roles.show', [$role->id]) }}">عرض</a>
                                                    <a class="btn btn-info btn-sm" href="{{ route('roles.edit', [$role->id]) }}">تعديل</a>
                                                    <a class="btn btn-danger btn-sm" href="#"
                                                        data-toggle = 'modal'
                                                        data-role_id = {{$role->id}}
                                                        data-target = "#delete_role">حذف</a>
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
                    <!-- DELETE MODEL -->
                        <div class="modal" id="delete_role">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title"> حذف الصلاحية</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                        type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('roles.destroy',[$role->id]) }}" method="POST">
                                            {{method_field('delete')}}
                                            {{ csrf_field() }}
                                            <p>هل أنت متأكد من عملية الحذف ؟ </p><br>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit">تأكيد</button>
                                                <button class="btn  btn-secondary" data-dismiss="modal" type="button">ألغاء</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- END DELETE MODEL -->

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
