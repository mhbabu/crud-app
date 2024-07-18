@extends('layouts.app')
@section('title', 'Product List')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5> Product List</h5>
                <a href="{{ route('products.create') }}" class="btn btn-primary AppModal" data-bs-toggle="modal"
                    data-bs-target="#AppModal" title="Create new" data-original-title="Create New">
                    <i class="fa fa-plus-circle"></i> Create
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 my-2">
                    {!! html()->text('search')->class('form-control')->placeholder('Search..')->id('search')->autofocus() !!}
                </div>
                <div class="col-md-6 my-2">
                    {!! html()->select('sort_by')->options(['desc' => 'Highest Price', 'asc' => 'Lowest Price'])->class('form-control')->id('sortBy')->placeholder('Sort By')->autofocus() !!}
                </div>
            </div>
            <div id="productArea">
                <table class="table" id="product-table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price ?? '-' }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ ucfirst($product->status) }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm AppModal" data-bs-toggle="modal"
                                    data-bs-target="#AppModal" href="{{ route('products.edit', $product->id) }}">
                                        Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?')" href="{{ route('products.delete', $product->id) }}">
                                        Delete</a>
                                </td>
                            </tr>
                        @empty  
                            <tr class="text-center">
                                <td colspan="5">No record found...!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
           
        </div>
    </div>
    @include('layouts.includes.modal-dialogue')
@endsection

@section('footer-script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        /**************************
        DYNAMIC MODAL SCRIPT HERE
        **************************/
        $(document.body).on('click', '.AppModal', function(e) {
            e.preventDefault();
            $('#ModalContent').html(
                '<div style="text-align:center;"><h3 class="text-primary">Loading Form...</h3></div>');
            $('#ModalContent').load(
                $(this).attr('href'),
                function(response, status, xhr) {
                    if (status === 'error') {
                        alert('error');
                        $('#ModalContent').html('<p>Sorry, but there was an error:' + xhr.status + ' ' + xhr
                            .statusText + '</p>');
                    }
                    return this;
                }
            );
        });

        // AJAX Search and Sort
        $('#search, #sortBy').on('change keyup', function() {
            let query = $('#search').val();
            let sortBy = $('#sortBy').val();
            $.ajax({
                url: "{{ route('products.index') }}",
                method: "GET",
                data: { search: query, sort_by: sortBy },
                success: function(data) {
                    $('#productArea').html(data);
                }
            });
        });
    </script>
@endsection
