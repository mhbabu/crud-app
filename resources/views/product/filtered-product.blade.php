<table class="table">
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
                    <a class="btn btn-danger btn-sm" href="{{ route('products.delete', $product->id) }}">
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