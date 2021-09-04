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
				@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تعديل  فاتورة </span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
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

                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">

                                </div>

                            </div>
                            <div class="card-body">
                                <form action="{{ url('invoices/update') }}"  method="POST" enctype="multipart/form-data" autocomplete="off">
                                    {{method_field('patch')}}
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        {{-- 1  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label">رقم الفاتورة</label>
                                                <input type="hidden" name="invoice_id" value="{{$invoice->id}} " >
                                                <input type="text" class="form-control"  id="invoices_number" name="invoices_number"
                                                    value="{{$invoice->invoices_number}} ">
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" > تاريخ الفاتورة</label>
                                                <input type="text" class="form-control" id="invoices_date" name="invoices_date"
                                                value=" {{$invoice->invoices_date}} ">
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >تاريخ الأستحقاق</label>
                                                <input type="text" class="form-control" id="Due_date" name="Due_date"
                                                    value="{{$invoice->due_date}} ">
                                            </div>
                                        </div>
                                        <br>
                                        {{-- 2 --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >القسم</label>
                                                <select name="section_id" class="form-control  SelectBox"
                                                    onchange="console.log('change is firing')" >
                                                    <option value="{{$invoice->section->id}} " selected >
                                                        {{$invoice->section->section_name}} </option>
                                                    @foreach ($sections as $section)
                                                    <option value="{{$section->id}}"> {{$section->section_name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >المنتج</label>
                                                <select name="products" id="product" class="form-control">
                                                    <option value=" {{$invoice->product}} ">
                                                        {{$invoice->product}} </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >مبلغ التحصيل</label>
                                                <input type="text" class=" form-control" id="amount_collection" name="amount_collection"
                                                    value="{{$invoice->Amount_collection}} ">
                                            </div>
                                        </div>
                                        <br>
                                        {{-- 3  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >مبلغ العمولة  </label>
                                                <input type="text" class="form-control form-control-lg" id="amount_commission"
                                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة"
                                                        value="{{$invoice->Amount_commission}} "    required>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  الخصم</label>
                                                <input type="text" class="form-control form-control-lg" id="discount"
                                                    name="discount" title="يرجي ادخال الخصم "
                                                        value= "{{$invoice->discount}} " >
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" > نسبة ضريبة القيمة المضافة</label>
                                                <select name="rate_vat" id="rate_vat" class="form-control " onchange="GetInvoices()">
                                                    <option value="{{$invoice->rate_vat}} " selected >{{$invoice->rate_vat}}</option>
                                                    <option value="5%">5%</option>
                                                    <option value="7%">7%</option>
                                                    <option value="10%">10%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                            {{-- 4  --}}
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  قيمة ضريبة القيمة المضافة </label>
                                                <input type="text" class="form-control" id="value_vat" name="value_vat"
                                                    value="{{$invoice->value_vat}} " readonly>
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  الأجمالي شامل الضريبة </label>
                                                <input type="text" class="form-control" id="total" name="total"
                                                    value="{{$invoice->total}} " readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="" class="control-label"> ملاحظات</label>
                                                <textarea class="form-control" rows="3" id="note" name="note">
                                                    {{$invoice->note}}</textarea></div>
                                        </div>
                                        <br>
                                        <center>
                                            <button class="btn btn-primary " type="submit">تعديل البيانات</button>
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

{{-- Ajax  --}}
{{-- <script src="{{URL::asset('assets/plugins/InvoicesJS/ajaxWork.js')}}"></script> --}}

<script>

    // get prodcts on selected section
    $(document).ready(function(){
        $('select[name="section_id"]').on('change',function(){
            var section_id = $(this).val();
            if(section_id) {
                $.ajax({
                    url : "{{URL::to('section')}}/ "+ section_id,
                    type : "GET",
                    dataType : "json",
                    success: function(data){
                        $('select[name="products"]').empty();
                        $.each(data , function(key , value){
                            $('select[name="products"]').append('<option option value = "'+
                                value  +'">'  + value + '</option>' );
                        });
                    },
                });
            }else{
                console.log('AJAx load did not Work');
            }
        })
    });

    // get Invoices value

    function GetInvoices() {
        var amount_commission = parseFloat(document.getElementById("amount_commission").value);
        var discount = parseFloat(document.getElementById("discount").value);
        var rate_vat= parseFloat(document.getElementById("rate_vat").value);
        var value_vat = parseFloat(document.getElementById("value_vat").value);

        var amount_commission2 = amount_commission - discount ;

        if (typeof amount_commission === 'undefined' || ! amount_commission) {
            alert('يرجي ادخال مبلغ العمولة');


        } else  {

            var intResult = amount_commission2 * rate_vat /100;
            var intResult2  = parseFloat(intResult + amount_commission2);
            sumq = parseFloat(intResult).toFixed(2);
            sumt = parseFloat(intResult2).toFixed(2);

            document.getElementById("value_vat").value = sumq;
            document.getElementById("total").value = sumt;

        }
    }

</script>
@endsection
