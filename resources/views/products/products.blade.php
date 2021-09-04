@extends('layouts.master')
@section('title')
المنتجات
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
                        <h4 class="content-title mb-0 my-auto">الأعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
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
                {{-- modal table  --}}

                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header pb-0">
                            <div class="col-sm-6 col-md-4 col-xl-3">
                                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modalProdct">أضافة منتج</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0"> اسم المنتج </th>
                                            <th class="border-bottom-0"> اسم القسم </th>
                                            <th class="border-bottom-0">الوصف </th>
                                            <th class="border-bottom-0">تعديلات </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $product)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td> {{$product->product_name}}</td>
                                            <td> {{$product->section->section_name}}</td>
                                            <td> {{$product->description}} </td>
                                            <td>
                                                {{-- edit button --}}
                                                <a class="modal-effect btn btn-info btn-sm" data-effect="effect-scale"
                                                    data-id=" {{$product->id}} " data-name="{{$product->product_name}}"
                                                    data-description="{{$product->description}}"
                                                    data-section_name = " {{$product->section->section_name}} "
                                                    data-toggle="modal" href="#editProduct"
                                                    title="تعديل"> <i class="las la-pen"></i>
                                                </a>

                                                {{-- delete button --}}
                                                <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale"
                                                    data-id=" {{$product->id}} " data-product_name=" {{$product->product_name}} "
                                                    data-toggle="modal" href="#deleteProduct" title="حذف"> <i class="las la-trash"></i>
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
                <div class="modal" id="modalProdct">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title"> أضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('products.store') }}" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="exampleInputEmail">أسم المنتج</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                                    </div>

                                    <label for="" class="my-1 mr-2 " >القسم</label>
                                    <select name="section_id" id="section_id" class="form-control">
                                        <option value="" selected disabled >-- حدد القسم --</option>
                                        @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                                        @endforeach
                                    </select>
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
                <div class="modal" id="editProduct">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title"> تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="products/update" method="POST" autocomplete="off">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input type="hidden" name="product_id" id="product_id" value="">
                                        <label for="exampleInputEmail">أسم المنتج</label>
                                        <input type="text" class="custom-select my-1 mr-sm-0" id="product_name" name="product_name" required>
                                    </div>

                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> القسم </label>
                                    <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-0">
                                        @foreach ($sections as $section)
                                            <option {{$section->id}} >{{$section->section_name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                                        <textarea class="form-control" id="product_description" name="product_description" rows="3"></textarea>
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
                <div class="modal" id="deleteProduct">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title"> حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="products/destroy" method="POST">
                                    {{ method_field('Delete') }}
                                    {{ csrf_field() }}

                                    <p>هل أنت متأكد من عملية الحذف ؟ </p><br>

                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="text" class="form-control" name="product_name" id="product_name" readonly>
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
