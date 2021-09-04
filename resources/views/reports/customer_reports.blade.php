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
							<h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تقارير العملاء </span>
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
                                <form action="/search_customer" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}


                                    <div class="row">
                                        <div class="col">
                                            <label for="inPutName" class="control-label" >القسم</label>
                                            <select name="section_id" class="form-control  "
                                                onchange="console.log('change is firing')" >
                                                <option value="" selected disabled>--حدد القسم-- </option>

                                                <option value="{{$section_name ?? ''}}" disabled selected>
                                                    {{$section_name ?? ''}}
                                                </option>

                                                @foreach ($sections as $section)
                                                <option value="{{$section->id}}"> {{$section->section_name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="inPutName" class="control-label" >المنتج</label>
                                            <select name="products" id="product" class="form-control ">
                                                <option value="{{$product ?? ''}}" selected>
                                                    {{$product ?? ''}}
                                                </option>
                                            </select>
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
</script>
@endsection

