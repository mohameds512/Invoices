@extends('layouts.master')

@section('title')
التقارير
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
							<h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تقارير الفواتير </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">

                                </div>

                            </div>

                            <div class="card-body">
                                <form action="/search_reports" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="col-lg-3">
                                        <label class="radioBox">
                                            <input type="radio" name="radio" value="1" id="typ_div"checked>
                                            <span>بحث بنوع الفاتورة</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="radioBox">
                                            <input type="radio" name="radio" value="2" >
                                            <span>بحث برقم الفاتورة</span>
                                        </label>
                                    </div>
                                    <br> <br>


                                    <div class="row">
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-2"> تحديد نوع الفاتورة</p>
                                            <select class="form-control" name="type"  id="invoices_type" required>
                                                <option value="{{$type ?? 'حدد نوع الفواتير'}}" selected>
                                                    {{$type ?? 'حدد نوع الفواتير'}}
                                                </option>
                                                <option value="4"> الكل</option>
                                                <option value="1">الفواتير المدفوعه</option>
                                                <option value="2"> الفواتير الغير مدفوعه</option>
                                                <option value="3"> الفواتير الندفوعه جزئيا</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoices_number" >
                                            <p class="mg-b-10">البحث برقم الفاتورة</p>
                                            <input type="text" class="form-control" id="invoices_number" name="invoices_number">
                                        </div>

                                        <div class="col-lg-3" id="start_at">
                                            <label for="exampleFormControlSelect1">من تاريخ</label>

                                                <input class="form-control fc-datepicker" type="date" placeholder="YYYY-MM-DD"
                                                    value="{{$start_at ?? ''}}" name="start_at" id="">

                                        </div>

                                        <div class="col-lg-3" id="end_at">
                                            <label for="exampleFormatControlSelect1">الي تاريخ</label>

                                                <input class="form-control fc-datepicker" type="date" placeholder="YYYY-MM-DD"
                                                    value="{{$end_at ?? ''}}" name="end_at" id="">

                                        </div>
                                    </div>
                                    <br> <br>
                                    <div class="row">
                                        <div class="col-sm-1 col-md-1">
                                            <button class="btn btn-primary btn-block">بحث</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if (isset($details))
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
                                    @foreach ($details as $index => $detail)
                                    <tr>
                                        <td> {{$index + 1}} </td>
                                        <td> {{$detail->invoices_number}} </td>
                                        <td> {{$detail->invoices_date}} </td>
                                        <td> {{$detail->due_date}} </td>
                                        <td> {{$detail->product}} </td>
                                        <td>
                                            <a href="{{ url('invoices/Details', [$detail->id]) }}">
                                                {{$detail->section->section_name}}
                                            </a>
                                        </td>
                                        <td> {{$detail->discount}} </td>
                                        <td> {{$detail->rate_vat}} </td>
                                        <td> {{$detail->value_vat}} </td>
                                        <td> {{$detail->total}} </td>
                                        <td>
                                            @if ($detail->value_status === 1 )
                                                <span class="badge badge-pill badge-success"> {{$detail->status}} </span>
                                            @elseif(  $detail->value_status === 2  )
                                                <span class="badge badge-pill badge-danger"> {{$detail->status}} </span>
                                            @elseif(  $detail->value_status === 3  )
                                                <span class="badge badge-pill badge-warning"> {{$detail->status}} </span>
                                            @endif
                                        </td>
                                        <td></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
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
<script src="{{URL::asset('assets/plugins/InvoicesJS/editReport.js')}}"></script>
@endsection

