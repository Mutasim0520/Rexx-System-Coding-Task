@extends('layouts.layout')
@section('content')
    <div>
        Welcome
        <form enctype="multipart/form-data" method="post" action="{{Route('store.json')}}">
        {{csrf_field()}}
        Upload JSON file <input type ='file' name='json_file'>
        <input type='submit' value = 'Submit'>
        </form>
    </div>
    <div>
        <form enctype="multipart/form-data" method="get" action="{{Route('filter')}}">
        {{csrf_field()}}
        <span>Enter Customer Name</span>
        <input type = 'text' name = 'customer_name' placeholder='John Doe'>
        <span>Enter Product Name</span>
        <input type = 'text' name = 'product_name' placeholder=''>
        <span>Enter Product Price</span>
        <input type = 'text' name = 'product_price' placeholder='34.99'>
        <input type = 'submit' value = 'Filter'>
        </form>
    </div>
    @if($query_result)
        <div>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Product Name</th>
                    <th>Product ID</th>
                    <th>price</th>
                </tr>
                <?php $total = 0; ?>
                @foreach($query_result as $result)
                    <tr>
                        <td>{{$result->date}}</td>
                        <td>{{$result->customer->name}}</td>
                        <td>{{$result->customer->email}}</td>
                        <td>{{$result->product->name}}</td>
                        <td>{{$result->product->id}}</td>
                        <td>{{$result->product->price}}</td>
                    </tr>
                    <?php $total = $total+floatval($result->product->price); ?>
                @endforeach
                <tr>
                    <td colspan=5>Total</td>
                    <td>{{$total}}</td>
                </tr>
            </table>
        </div>
    @endif
@endsection