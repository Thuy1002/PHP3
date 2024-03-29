@php
    use Illuminate\Support\Facades\DB;
@endphp
@extends('templates.layoutadmin')
@section('title', 'san pham')
@section('css')
    <style>
        body {
            /*-webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;*/
            user-select: none;
        }

        .toolbar-box form .btn {
            /*margin-top: -3px!important;*/
        }

        .select2-container {
            margin-top: 0;
        }

        .select2-container--default .select2-selection--multiple {
            border-radius: 0;
        }

        .select2-container .select2-selection--multiple {
            min-height: 30px;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 3px;
        }

        .table>tbody>tr.success>td {
            background-color: #009688;
            color: white !important;
        }

        .table>tbody>tr.success>td span {
            color: white !important;
        }

        .table>tbody>tr.success>td span.button__csentity {
            color: #333 !important;
        }

        /*.table>tbody>tr.success>td i{*/
        /*    color: white !important;*/
        /*}*/
        .text-silver {
            color: #f4f4f4;
        }

        .btn-silver {
            background-color: #f4f4f4;
            color: #333;
        }

        .select2-container--default .select2-results__group {
            background-color: #eeeeee;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{-- @include('templates.header-action') --}}
        <div class="clearfix"></div>
        <div style="border: 1px solid #ccc;margin-top: 10px;padding: 5px;">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="search_ten_nguoi_dung" class="form-control"
                                placeholder="Tên người dùng" value="">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12" style="text-align:center;">
                        <div class="form-group">
                            <button type="submit" name="btnSearch" class="btn btn-primary btn-sm "><i class="fa fa-search"
                                    style="color:white;"></i> Search
                            </button>
                            <a href="{{ url('/user') }}" class="btn btn-default btn-sm "><i class="fa fa-remove"></i>
                                Clear </a>
                            <a href="{{route('route_BackEnd_Sanpham_Add')}}" class="btn btn-info btn-sm"><i class="fa fa-user-plus"
                                    style="color:white;"></i>
                                Add new</a>
                        </div>
                    </div>
                </div>

            </form>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content appTuyenSinh">
        <div id="msg-box">
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
        </div>
        @if (count($id_dm) <= 0)
            <p class="alert alert-warning">
                Không có dữ liệu phù hợp
            </p>
        @endif
        <div class="box-body table-responsive no-padding">
            <form action="" method="post">
                @csrf
                <span class="pull-right">Tổng số bản ghi tìm thấy: <span
                        style="font-size: 15px;font-weight: bold;">{{count($id_dm)}}</span></span>
                <div class="clearfix"></div>
                <div class="double-scroll">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 50px" class="text-center">
                                #ID
                            </th>
                            <th class="text-center">Tên sản phẩm</th>
                            <th class="text-center">
                                Giá
                            </th>
                            <th class="text-center">
                                Hình
                            </th>
                            <th class="text-center">
                                Mô tả 
                            </th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Trạng thái</th>
                            {{-- <th class="text-center">Danh mục</th> --}}
                            <th class="text-center">Hành động</th>
                        </tr>
                        @foreach ($id_dm as $l)
                            <tr>
                                {{-- <td><input type="checkbox" name="chk_hv[]" class="chk_hv" id="chk_hv_{{$item->id}}" value="{{$item->id}}"> </td> --}}
                                <td class="text-center">{{$l ->id}}</td>
                                <td class="text-center"><a style="color:#333333;font-weight: bold;" href=""
                                        style="white-space:unset;text-align: justify;"> {{$l ->ten_sp}} <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">{{$l ->gia}}</td>
                                <td class="text-center">  <img id="mat_truoc_preview"
                                    src="{{Storage::url($l->hinh_anh)}}"
                                 
                                    style="text-aligh:center ;max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/></td>
                                <td class="text-center">
                                <td class="text-center">{{$l ->mo_ta}}</td>
                                <td class="text-center">{{$l ->so_luong}}</td>
                                <td class="text-center">
                                    @if (($l->trang_thai) == 1)
                                    Còn Hàng
                                @else
                                   hết hàng
                                
                                   @endif
                                </td>
                              
                                {{-- <td class="text-center">
                                 {{       DB::table('danh_muc')->where('id','=',$l->id_danhmuc)->first()->ten_danhmuc}}
                                </td> --}}
                                <td class="text-center"><a onclick="return confirm('Hãy cẩn thận với xuy nghĩ của bạn !!')" class="btn btn-danger" href="{{ route('route_BackEnd_Sanpham_del',[$l->id]) }}">Xóa</a>
                                    <a class="btn btn-primary" href="{{ route('route_BackEnd_Sanpham_detail',[$l->id]) }}" >Sửa</a></td>
                               

                            </tr>
                        @endforeach

                    </table>
                </div>
            </form>
        </div>
        <br>
        <div class="text-center">
            {{$id_dm->appends($extParams)->links()}}
          
        </div>
        <index-cs ref="index_cs"></index-cs>
    </section>

@endsection
