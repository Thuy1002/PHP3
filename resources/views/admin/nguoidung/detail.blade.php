@extends('templates.layoutadmin')
@section('title', 'chi tiet nguoi dung')
@section('content')
    <!-- Main content -->
    <section class="content appTuyenSinh">
        <link rel="stylesheet" href="{{ asset('default/bower_components/select2/dist/css/select2.min.css') }} ">
        <style>
            .select2-container--default .select2-selection--single,
            .select2-selection .select2-selection--single {
                padding: 3px 0px;
                height: 30px;
            }

            .select2-container {
                margin-top: -5px;
            }

            option {
                white-space: nowrap;
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 0px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: #216992;
            }

            .select2-container--default .select2-selection--multiple {
                margin-top: 10px;
                border-radius: 0;
            }

            .select2-container--default .select2-results__group {
                background-color: #eeeeee;
            }
        </style>

        <?php //Hiển thị thông báo thành công
        ?>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi
        ?>
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <!-- Phần nội dung riêng của action  -->
        <form class="form-horizontal " action="{{ route('route_BackEnd_Uesr_update', ['id' => request()->route('id')]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Tên người dùng <span
                                    class="text-danger">(*)</span></label>

                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $objitem->name }}">
                                <span id="mes_sdt"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 col-sm-4 control-label">Email <span
                                    class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ $objitem->email }}">
                                <span id="mes_sdt"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 col-sm-4 control-label">Mật khẩu <span
                                    class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="password" name="password" id="password" class="form-control"
                                    value="@isset($request['password']) {{ $request['password'] }} @endisset">
                                <span id="mes_sdt"></span>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Ảnh CMND/CCCD <span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img id="mat_truoc_preview"
                                             src="{{ $objitem->img?''.Storage::url($objitem->img):'http://placehold.it/100x100' }}"
                                             alt="your image"
                                             style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/>
                                        <label for="cmt_truoc">Mặt trước</label><br/>
                                    </div>
                                    <input type="file" name="img" class="form-control">
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class ="form-group">
                            <label  class="col-md-3 col-sm-4 control-label" for="">Trạng thái</label>
                            <div style="    display: grid;" class="col-md-9 col-sm-8">
                                <label  for="">
                                    <input type="radio" name="trang_thai" id="input"
                                        value="{{ $objitem->trang_thai }}"
                                        checked> đại ca
                                </label>
                                <label  for="">
                                    <input type="radio" name="trang_thai" id=""
                                         value="{{ $objitem->trang_thai }}">
                                    Đệ
                                </label>
                            </div>
                          
                        </div> --}}

                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary"> Save</button>
                <a href="   {{-- {{ route('route_BackEnd_NguoiDung_index') }} --}}" class="btn btn-default">Cancel</a>
            </div>
            <!-- /.box-footer -->
        </form>

    </section>
@endsection
@section('script')
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
@endsection
