@extends('layouts.layout')
@section('content')
    <div class='col-md-12'>
        <h1 class='display-2'>Welcome</h1>
    </div>
    <div class="col-md-12">
        <form enctype="multipart/form-data" method="post" action="{{Route('store.json')}}">
        {{csrf_field()}}
        Upload JSON file <input type ='file' name='json_file'>
        <buton class="btn btn-primary" type='submit'>Upload</button>
        </form>
    </div>
    <div class='col-md-12'>
    <h1 class='display-5'>Filter your data</h1>
        <form class = 'form' enctype="multipart/form-data" method="get" action="{{Route('filter')}}">
            {{csrf_field()}}
            <div class="form-group col-md-4">
                <span>Enter Customer Name</span>
                <input class="form-control" type = 'text' name = 'customer_name' placeholder='John Doe'>
            </div>
            <div class="form-group col-md-4">
                <span>Enter Product Name</span>
                <input class="form-control" type = 'text' name = 'product_name' placeholder=''>
            </div>
            <div class="form-group col-md-4">
                <span>Enter Product Price</span>
                <input class="form-control" type = 'text' name = 'product_price' placeholder='34.99'>
            </div>
            <div class='form-group col-md-3'>
                <buton class="btn btn-primary" type='submit'>Filter</button>
            </div>
        </form>
    </div>
    @if($query_result)
        <div class='col-md-12'>
        <h1 class='display-5'>Filter Result</h1>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Product Name</th>
                        <th>Product ID</th>
                        <th>price</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    @endif
@endsection