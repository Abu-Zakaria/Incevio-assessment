@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-md-8 offset-md-2 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    Product List
                </h2>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Product Title</th>
                                <th>Current bidding price</th>
                                <th>Deadline</th>
                                <td></td>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ $product->title }}
                                    </td>
                                    <td>
                                        @php
                                        $highest_bid = $product->bids()->orderBy('price', 'desc')->first();
                                        @endphp
                                        {{ $highest_bid ? $highest_bid->price : "N/A" }}
                                    </td>
                                    <td>
                                        {{ $product->deadline }}
                                    </td>
                                    <td>
                                        <a href="{{ route('user.product.show', ['product' => $product->id]) }}" class="btn btn-primary-outline btn-sm">View</a>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection