@extends('layouts.layout')
@section('content')
    <div class='col-md-12'>
        <h1 class='display-2'>Welcome</h1>
    </div>
    <div class="col-md-12">
        <form enctype="multipart/form-data" method="post" action="{{Route('store.json')}}">
        {{csrf_field()}}
        Upload JSON file <input type ='file' name='json_file'>
        <input class="btn btn-primary" type='submit' value='Upload' accept=".json" required = 'required'>
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
                <input class="btn btn-primary" type='submit' value = 'Filter'>
            </div>
        </form>
    </div>
   
@endsection