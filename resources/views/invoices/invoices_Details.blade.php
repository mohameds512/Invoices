@extends('layouts.master')
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
							<h4 class="content-title mb-0 my-auto">الفولتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل</span>
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
                    <div class="col-xl-12">
                        <div class="card mg-b-20">

                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href="#tab11" class="active" data-toggle="tab">   معلومات الفاتورة  </a></li>
                                            <li><a href="#tab12" data-toggle="tab"> حالات الدفع  </a></li>
                                            <li><a href="#tab13" data-toggle="tab"></i> المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab11">
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-striped" style="text-align: center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">رقم الفاتورة</th>
                                                            <td> {{$invoices->invoices_number}} </td>
                                                            <th scope="row">تاريخ الاصدار</th>
                                                            <td> {{$invoices->invoices_date}} </td>
                                                            <th scope="row">تاريخ الاستحقاق  </th>
                                                            <td> {{$invoices->due_date}} </td>
                                                            <th scope="row"> القسم  </th>
                                                            <td> {{$invoices->section->section_name}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">المنتج </th>
                                                            <td> {{$invoices->product}} </td>
                                                            <th scope="row"> مبلغ التحصيل  </th>
                                                            <td> {{$invoices->Amount_collection}} </td>
                                                            <th scope="row"> مبلغ العمولة </th>
                                                            <td> {{$invoices->Amount_commission}} </td>
                                                            <th scope="row"> الخصم  </th>
                                                            <td> {{$invoices->discount}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">نسبة الضريبة  </th>
                                                            <td> {{$invoices->rate_vat}} </td>
                                                            <th scope="row"> قيمة الضريبة   </th>
                                                            <td> {{$invoices->value_vat}} </td>
                                                            <th scope="row">  الاجمالي مع الضريبة </th>
                                                            <td> {{$invoices->total}} </td>
                                                            <th scope="row"> الحاله الحاليه  </th>
                                                            <td>
                                                                @if ($invoices->value_status === 1 )
                                                                <span class="badge badge-pill badge-success"> {{$invoices->status}} </span>
                                                                @elseif(  $invoices->value_status === 2  )
                                                                    <span class="badge badge-pill badge-danger"> {{$invoices->status}} </span>
                                                                @else
                                                                    <span class="badge badge-pill badge-warning"> {{$invoices->status}} </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"> ملاحظات   </th>
                                                            <td> {{$invoices->note}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab12">
                                            <table id="example1" class="table key-buttons text-md-nowrap" style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">#</th>
                                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                                        <th class="border-bottom-0"> المنتج</th>
                                                        <th class="border-bottom-0">القسم</th>
                                                        <th class="border-bottom-0">الحالة</th>
                                                        <th class="border-bottom-0">تاريخ الدفع</th>
                                                        <th class="border-bottom-0">ملاحاظات</th>
                                                        <th class="border-bottom-0">تاريخ الاضافة</th>
                                                        <th class="border-bottom-0"> المستخدم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoices_details as $index => $details)
                                                    <tr>
                                                        <td> {{$index + 1}} </td>
                                                        <td> {{$details->invoices_number}} </td>
                                                        <td> {{$details->product}} </td>
                                                        <td> {{$invoices->section->section_name}} </td>
                                                        <td>
                                                            @if ($details->value_status === 1 )
                                                            <span class="badge badge-pill badge-success"> {{$details->status}} </span>
                                                            @elseif(  $details->value_status === 2  )
                                                                <span class="badge badge-pill badge-danger"> {{$details->status}} </span>
                                                            @elseif($details->value_status === 3 )
                                                                <span class="badge badge-pill badge-warning"> {{$details->status}} </span>
                                                            @endif
                                                        </td>
                                                        <td> {{$details->Payment_Date}} </td>
                                                        <td>{{$details->note}}</td>
                                                        <td> {{$details->created_at}} </td>
                                                        <td> {{$details->user}} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab13">
                                            <div class="card card-statistics">
                                                <div class="card-body">
                                                    <p class="text-danger">pdf , jpeg , png , jpg صيغة المرفق *</p>
                                                    <h5 class="card-title">اضافة مرفق</h5>
                                                    <form action="{{ url('InvoiceAttachments') }}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-" name="file_name" id="customFile" required >
                                                            <input type="hidden" name="invoices_number" id="customFile"
                                                                value="{{$invoices->invoices_number}} ">
                                                            <input type="hidden" name="invoice_id" id="invoice_id"
                                                                value="{{$invoices->id}} ">
                                                            <label class="custom-file-label" for="customFile">حدد المرفق</label>
                                                        </div> <br> <br>
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            name="uploadFile"> تأكيد </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <table id="example1" class="table key-buttons text-md-nowrap" style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">#</th>
                                                        <th class="border-bottom-0"> اسم الملف </th>
                                                        <th class="border-bottom-0"> قام بالاضافة</th>
                                                        <th class="border-bottom-0">تاريخ الاضافه</th>
                                                        <th class="border-bottom-0">العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoices_attachments as $index => $attachs)
                                                    <tr>
                                                        <td> {{$index + 1}} </td>
                                                        <td> {{$attachs->file_name}} </td>
                                                        <td> {{$attachs->created_by}} </td>
                                                        <td> {{$invoices->created_at}} </td>
                                                        <td>
                                                            <a  class="btn btn-outline-success btn-sm"
                                                                href="{{ url('view_file') }}/{{$invoices->invoices_number}}/{{$attachs->file_name}}"
                                                                role="button">
                                                                <i class="fas fa-eye"></i>&nbsp;
                                                                عرض
                                                            </a>
                                                            <a  class="btn btn-outline-info btn-sm"
                                                                href="{{ url('download') }}/{{$invoices->invoices_number}}/{{$attachs->file_name}}"
                                                                role="button">
                                                                <i class="fas fa-download"></i>&nbsp;
                                                                تحميل
                                                            </a>
                                                            <a  class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-file_name = "{{$attachs->file_name}} "
                                                                data-invoices_number = "{{$invoices->invoices_number}} "
                                                                data-file_id = "{{$attachs->id}} "
                                                                data-target = "#file_delete">
                                                                حذف
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
                        </div>
                    </div>
				</div>
				<!-- row closed -->

                <!-- DELETE MODEL -->
                <div class="modal" id="file_delete">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title"> حذف المرفق</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('file_delete') }}" method="POST">
                                    {{ csrf_field() }}
                                    <p>هل أنت متأكد من عملية الحذف ؟ </p><br>

                                    <input type="hidden" name="file_id" id="file_id" >
                                    <input type="hidden" name="file_name" id="file_name" >
                                    <input type="hidden" name="invoices_number" id="invoices_number">
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
