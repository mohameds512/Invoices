@extends('layouts.master')

@section('title')
قائمة الفواتير
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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
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
                            msg: "تم اضافة الفاتورة بنجاح   ",
                            type: "success"
                        });
                        }

                    </script>
                @endif
                @if (session()->has('Archive_invoice'))
                    <script>
                        window.onload = function () {
                            notif({
                            msg: "تم نقل  الفاتورة الي الارشيف   ",
                            type: "success"
                        });
                        }

                    </script>
                @endif

                @if (session()->has('restored'))
                <script>
                    window.onload = function () {
                        notif({
                        msg: "تم استعادة الفاتورة الي القائمة",
                        type: "success"
                    });
                    }

                </script>
            @endif


                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li> {{$error}} </li>
                    @endforeach
                </ul>
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

                        <!--div-->
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex my-xl-auto left-content">
                                        <div class="pr-1 mb-3 mb-xl-0">
                                            <a class="btn btn-info float-left mt-3 btn-block" href="invoices/create">
                                                <i class="fas fa fa-plus"></i> أضافة فاتورة</a>
                                        </div>
                                        <div class="pr-1 mb-3 mb-xl-0">
                                            <a class="btn btn-success float-left mt-3 btn-block" href="export_invoices">
                                                <i class="mdi mdi-telegram ml-1"></i> تصدير اكسيل </a>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                    <th class="border-bottom-0">تاريخ الفاتورة</th>
                                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                    <th class="border-bottom-0"> المنتج</th>
                                                    <th class="border-bottom-0">القسم</th>
                                                    <th class="border-bottom-0">الخصم</th>
                                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                                    <th class="border-bottom-0">الاجمالي </th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoices as $index => $invoice)
                                                <tr>
                                                    <td> {{$index + 1}} </td>
                                                    <td> {{$invoice->invoices_number}} </td>
                                                    <td> {{$invoice->invoices_date}} </td>
                                                    <td> {{$invoice->due_date}} </td>
                                                    <td> {{$invoice->product}} </td>
                                                    <td>
                                                        <a href="{{ url('invoices/Details', [$invoice->id]) }}">
                                                            {{$invoice->section->section_name}}
                                                        </a>
                                                    </td>
                                                    <td> {{$invoice->discount}} </td>
                                                    <td> {{$invoice->rate_vat}} </td>
                                                    <td> {{$invoice->value_vat}} </td>
                                                    <td> {{$invoice->total}} </td>
                                                    <td>
                                                        @if ($invoice->value_status === 1 )
                                                            <span class="badge badge-pill badge-success"> {{$invoice->status}} </span>
                                                        @elseif(  $invoice->value_status === 2  )
                                                            <span class="badge badge-pill badge-danger"> {{$invoice->status}} </span>
                                                        @elseif(  $invoice->value_status === 3  )
                                                            <span class="badge badge-pill badge-warning"> {{$invoice->status}} </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm"
                                                            data-toggle="dropdown" id="dropdownMenuButton" type="button"> العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                                            <div  class="dropdown-menu tx-13">
                                                                <a class="dropdown-item" href="{{ url('edit_invoice', [$invoice->id]) }}">
                                                                    <i class="text-info fas fa-edit "></i>
                                                                    تعديل الفاتورة
                                                                </a>

                                                                <a class="dropdown-item"
                                                                href="{{ route('status_show', [$invoice->id]) }}">
                                                                <i class="text-success fas fa-money-bill"></i>  تغيير حاله الدفع</i>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                href="print_invoice/{{$invoice->id}}">
                                                                <i class="text-success fas fa-print"></i> طباعة الفاتورة</i>
                                                                </a>

                                                                <a  class="dropdown-item" href="#"
                                                                data-toggle="modal"
                                                                data-invoice_id = "{{$invoice->id}} "
                                                                data-target = "#archive_invoices">
                                                                <i class="text-warning fas fa-exchange-alt"></i>
                                                                أرشفة الفاتورة
                                                                </a>
                                                                <a  class="dropdown-item" href="#"
                                                                data-toggle="modal"
                                                                data-invoice_id = "{{$invoice->id}} "
                                                                data-target = "#delete_invoices">
                                                                <i class="text-danger fas fa-trash-alt"></i>
                                                                حذف الفاتورة
                                                                </a>
                                                            </div>
                                                        </div>

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
                            <div class="modal" id="delete_invoices">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title"> حذف الفاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                            type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('invoices.destroy', 'test') }}" method="POST">
                                                {{method_field('delete')}}
                                                {{ csrf_field() }}
                                                <p>هل أنت متأكد من عملية الحذف ؟ </p><br>

                                                <input type="hidden" name="invoice_id" id="invoice_id" value="" >
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
                            <!-- END DELETE MODEL -->
                            <!-- Archive MODEL -->
                            <div class="modal" id="archive_invoices">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title"> ارشفة الفاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                            type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('invoices.destroy', 'test') }}" method="POST">
                                                {{method_field('delete')}}
                                                {{ csrf_field() }}
                                                <p>هل أنت متأكد من عملية الارشيفة ؟ </p><br>

                                                <input type="hidden" name="invoice_id" id="invoice_id" value="" >
                                                <input type="hidden" name = "id_page" id="id_page" value="2">
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
                            <!-- END Archive MODEL -->

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
<script src="{{URL::asset('assets/plugins/InvoicesJS/edit.js')}}"></script>
@endsection
