@extends('admin.layouts.master')

@section('content')
    <main>
        <div>
            <style>
                nav svg {
                    height: 20px;
                }

                nav .hidden {
                    display: block !important;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="fw-bold">Quản lí danh mục</h2>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <a href="{{ route('category.category-create') }}" class="btn btn-success float-end mx-1">Thêm mới
                                        </a>
                                        <form action="" method="POST">
                                            @csrf
                                            <button class="btn btn-success float-end mx-1">
                                                Export CSV
                                            </button>
                                        </form>
                                        <form action="" method="POST">
                                            @csrf
                                            <button class="btn btn-success float-end mx-1">
                                                Export Excel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-white" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger text-white">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <table class="table table-triped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Danh mục</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-center">
                                    @foreach ($categories as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <p>{{ $item->category_name }}</p>
                                            </td>
                                            <td id="deleteForm" class="d-flex justify-content-center">
                                                <a href="{{ route('category.category-edit', $item->category_slug_name) }}"><i class="fa-solid fa-pen-to-square text-info"></i></i></a>

                                                <button class="border-0 bg-light mx-1" onclick="confirmDelete({{ $item->id }})"><i class="fa-solid fa-trash text-danger"></i></button>
                                               
                                                <form action="{{ route('category.category-destroy', $item->category_slug_name ) }}" method="POST" id="delete-category{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function confirmDelete(id) {
            var result = confirm('Bạn có muốn xóa sản phẩm này không')

            if(result == true)
            {
                document.getElementById('delete-category'+id).submit();
            }
        }
    </script>
@endsection