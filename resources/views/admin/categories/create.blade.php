
@extends('admin.layouts.master')

@section('content')

    <div class="container" style="padding: 140px 0px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="fw-bold">Thêm Danh mục sản phẩm</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('category.category-manager') }}" class="btn btn-success float-end">Quản lý Danh mục</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('category.category-store') }}" 
                    class="form-horizontal"  method="POST">
                        @csrf
                        <div class="form-group row my-2">
                            <label for="" class="col-md-4 control-label fw-bold">Nhập tên danh mục</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Nhập tên danh mục sản phẩm" name="category_name"
                                    class="form-control input-md border border-secondary px-2" value="{{ old('category_name') }}"/>
                            </div>
                        </div>


                        <div class="form-group my-2">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-success float-end" type="Submit">Thêm danh mục sản phẩm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection