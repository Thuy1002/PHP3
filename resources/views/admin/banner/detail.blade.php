@extends('templates.layoutadmin')
@section('title', $_title)
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
        <form class="form-horizontal " action="{{ route('route_BackEnd_Banner_update', ['id' => request()->route('id')]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-md-3 col-sm-4 control-label">Tên ảnh <span
                                    class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <input type="text" name="ten_banner" id="ten_banner" class="form-control"
                                    value="{{$objitem->ten_banner}}">
                                <span id="mes_sdt"></span>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Ảnh <span class="text-danger">(*)</span></label>
                            <div class="col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img id="mat_truoc_preview"
                                             src="{{ $objitem->hinh_anh?''.Storage::url($objitem->hinh_anh):'http://placehold.it/100x100' }}"
                                             alt="your image"
                                             style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/>
                                        <label for="cmt_truoc">Mặt trước</label><br/>
                                    </div>
                                    <input type="file" name="hinh_anh" class="form-group">
                                </div>
                            </div>
                        </div>


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
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#cmt_truoc").change(function() {
                readURL(this, '#mat_truoc_preview');
            });

        });
    </script>
@endsection
