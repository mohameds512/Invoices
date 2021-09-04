@extends('layouts.master')

@section('title')
أضافة مستخدم
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة مستخدم</span>
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
                                        msg: "تم اضافة مستخدم جديد بنجاح   ",
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

				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="col-sm-6 col-md-4 col-xl-3">

                                </div>

                            </div>

                            <div class="card-body">
                                <form action="{{ route('user.store')}}" method="POST" autocomplete="off">
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label"> اسم المستخدم </label>
                                                <input type="text" class="form-control"  id="name" name="name">
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >  البريد الالكتروني</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label"> كلمة المرور  </label>
                                                <input type="password" class="form-control"  id="password" name="password">
                                            </div>
                                            <div class="col">
                                                <label for="inPutName" class="control-label" >   تأكيد كلمة المرور</label>
                                                <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="inPutName" class="form-label">  حالة المستخدم  </label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="" disabled selected>--حدد حالة المستخدم --</option>
                                                    <option value="1">مفعل</option>
                                                    <option value="0">غير مفعل</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="inPutName" class="control-label">  صلاحيات المستخدم  </label>
                                                {!! Form::select('roles_name[]',$roles,[],array('class'=>'form-control','multiple')) !!}
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

@endsection
