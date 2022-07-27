@extends('templates.layout')
@section('title', 'Thêm mới sản phẩm')
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

        <form class="form-horizontal " action="" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            <div style="padding-right: 130px;" class="col-md-9">
                <div class="form-group">
                    <label for="ten_de_thi" class="control-label">Tên sản phẩm <span
                            class="text-danger">(*)</span></label>
                    {{-- <input type="text" class="form-control" name="ten_sp" id="" placeholder="Sản phẩm"> --}}
                    <input type="text" name="ten_sp" id="" class="form-control"
                        value="@isset($request['ten_sp']) {{ $request['ten_sp'] }} @endisset">
                    <span id="mes_sdt"></span>
                  
                </div>
                <div class="form-group">
                    <label for="">Ảnh sản phẩm</label>
                    {{-- <input type="file" class="form-control" name="hinh_anh" id=""> --}}
                    <input style="    width: 270px;" type="file" name="hinh_anh" id="" class="form-control"
                        value="@isset($request['hinh_anh']) {{ $request['hinh_anh'] }} @endisset">
                    <span id="mes_sdt"></span>
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea style="    height: 200px;" name="mo_ta" id="content" class="form-control"></textarea>
                </div>
            </div>

          
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tên danh mục</label>
                    <select name="id_danhmuc" id="" class="form-control" required="required">
                        <option value="">ABC</option>
                        @foreach ($dm as $d)
                            <option value="{{ $d->id }}">{{ $d->ten_danhmuc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">số lượng</label>
                    {{-- <input type="number" class="form-control" name="so_luong" id=""> --}}
                    <input type="number" name="so_luong" id="" class="form-control"
                        value="@isset($request['so_luong']) {{ $request['so_luong'] }} @endisset">
                    <span id="mes_sdt"></span>
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    {{-- <input type="text" class="form-control" name="gia" id="" placeholder=""> --}}
                    <input type="number" name="gia" id="" class="form-control"
                        value="@isset($request['gia']) {{ $request['gia'] }} @endisset">
                    <span id="mes_sdt"></span>
                </div>
                {{-- <div class="form-group">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number" class="form-control" name="khuyen_mai" id="" placeholder="">
                </div> --}}
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="radio">
                        <label for="">
                            <input type="radio" name="trang_thai" id="input" value="1" checked> Còn Hàng
                        </label>
                    </div>
                    <div class="radio">
                        <label for="">
                            <input type="radio" name="trang_thai" id="" value="0"> Hết hàng
                        </label>
                    </div>

                </div>


                <button type="submit" class="btn btn-primary">Tạo Mới</button>
            </div>

    </section>
@endsection
@section('script')
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
 
@endsection
