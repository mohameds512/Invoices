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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تغير حاله لفوانتير</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <div class="row">

                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">

                                </div>

                            </div>
                            <div class="card-body">
                                <form action="{{ route('update_status', ['id'=>$invoice->id]) }}" method="POST"  autocomplete="off">
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        {{-- 1  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label">رقم الفاتورة</label>
                                                <input type="hidden" name="invoice_id" value="{{$invoice->id}}" >
                                                <input type="text" class="form-control fc-datepicker" name="invoice_number"
                                                value="{{$invoice->invoices_number}} " readonly >
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" > تاريخ الفاتورة</label>
                                                <input type="text" class="form-control" id="invoices_date" name="invoices_date"
                                                value="{{$invoice->invoices_date}} " readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >تاريخ الأستحقاق</label>
                                                <input type="date" class="form-control" id="Due_date" name="Due_date"
                                                value="{{$invoice->due_date}} " readonly>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- 2 --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >القسم</label>
                                                <input type="hidden" name="section_id" value="{{$invoice->section_id}}">
                                                <input type="text" class="form-control" id="section_name" name="section_name"
                                                value="{{$invoice->section->section_name}} " readonly>

                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >المنتج</label>
                                                <input type="text" class="form-control" id="product" name="product"
                                                value="{{$invoice->product}} " readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >مبلغ التحصيل</label>
                                                <input type="text" class=" form-control" id="amount_collection" name="amount_collection"
                                                value="{{$invoice->Amount_collection}} " readonly>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- 3  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >مبلغ العمولة  </label>
                                                <input type="text" class="form-control form-control-lg" name="Amount_commission"
                                                value="{{$invoice->Amount_commission}} " readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  الخصم</label>
                                                <input type="text" class="form-control form-control-lg" name="discount"
                                                    value="{{$invoice->discount}}" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" > نسبة ضريبة القيمة المضافة</label>
                                                <input type="text" class="form-control form-control-lg" name="rate_vat"
                                                value="{{$invoice->rate_vat}} " readonly>

                                            </div>
                                        </div>
                                        <br>
                                            {{-- 4  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  قيمة ضريبة القيمة المضافة </label>
                                                <input type="text" class="form-control" name="value_vat"
                                                value="{{$invoice->value_vat}}" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  الأجمالي شامل الضريبة </label>
                                                <input type="text" class="form-control" name="total"
                                                value="{{$invoice->total}}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="" class="control-label"> ملاحظات</label>
                                                <textarea class="form-control" rows="3" id="note" name="note" readonly >
                                                {{$invoice->note}}
                                            </textarea></div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >   حالة الدفع</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option selected disabled>-- حدد حالة الدفع --</option>
                                                    <option value="1">مدفوعه</option>
                                                    <option value="3"> مدفوعه جزئيا</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  تاريخ الدفع </label>
                                                <input type="date" class="form-control" name="Payment_Date" id="Payment_Date" required>
                                            </div>
                                        </div>
                                        <br>



                                        <br>
                                        <center>
                                            <button class="btn btn-primary " type="submit">تحديث</button>
                                        </center>
                                        <br>
                                    </div>
                                </form>

                            </>
                        </div>
                    </div>
                    <!--/div-->

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

