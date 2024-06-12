@extends('admin.layouts.master')

@section('content')
<div>
    <div class="container" style="padding: 30px 40px">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Nhập dữ liệu excel
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('product.product-manager') }}" class="btn btn-success">
                                        Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form action="{{ route('import-product-data') }}" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">Nhập file dữ liệu sản phẩm</label>
                                    <div class="col-md-4">
                                        <input type="file" placeholder="Đăng file dữ liệu sản phẩm" name="file" class="form-control input-md">
                                    </div>
                                </div>
    
    
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" type="submit">Nhập</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection