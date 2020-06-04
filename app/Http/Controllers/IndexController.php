<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers as customer;
use App\Sales as sale;
use App\Products as product;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function storeJsonData(Request $request){
            $file = $request->file('json_file');
            $fileName = time().$request->file('json_file')->getClientOriginalExtension();
            $file-> move(public_path('/json'), $fileName);

            $path = public_path()."/json/${fileName}";
            $json = json_decode(file_get_contents($path), true); 

            $this->storeDataInDatabase($json);
        //return redirect();
    }

    public function storeDataInDatabase(array $json){
        foreach($json as $input){
            $already_customer = Customer::where(['email' => $input['customer_mail']])->first();
            $already_product = Product::where(['id' => $input['product_id']])->first();
            if(!$already_customer){
                $customer = new Customer();
                $customer->name = $input['customer_name'];
                $customer->email = $input['customer_mail'];
                $customer->save();
            }

            if(!$already_product){
                $product = new Product();
                $product->id = $input['product_id'];
                $product->name = $input['product_name'];
                $product->price = $input['product_price'];
                $product->save();
            }

            $sale = new sale();
            $sale->product_id = $input['product_id'];
            $sale->customer_id = $already_customer->id;
            $sale->date = $input['sale_date'];
            $sale->save();

        }
    }
}
