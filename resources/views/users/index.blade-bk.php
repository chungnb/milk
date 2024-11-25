@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('contents')
<div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div> -->
    <div class="card-body">
        @if (auth()->user()->level == 'Admin')
        <a href="{{ route('products.add') }}" class="btn btn-primary mb-3">Tạo mới</a>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code product</th>
                        <th>Name product</th>
                        <th>Category</th>
                        <th>Price</th>
                        @if (auth()->user()->level == 'Admin')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->item_code }}</td>
                        <td>{{ $row->productname }}</td>
                        <td>{{ $row->category }}</td>
                        <td>{{ $row->price }}</td>
                        @if (auth()->user()->level == 'Admin')
                        <td>
                            <a href="{{ route('products.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('products.delete', $row->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(function() {
    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('products')}}",
        columns: [{
                colum: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                colum: 'item_code',
                name: 'item_code'
            },
            {
                colum: 'productname',
                name: 'productname'
            },
            {
                colum: 'category',
                name: 'category'
            },
            {
                colum: 'price',
                name: 'price'
            },
        ]
    });
})
</script>
@endsection