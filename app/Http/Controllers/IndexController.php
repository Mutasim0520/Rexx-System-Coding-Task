<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers as Customer;
use App\Sales as Sale;
use App\Products as Product;

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

    public function filter(Request $request){

        if($request->has('customer_name')){
            $customers = Customer::where(['name' => $request->customer_name])->get()->unique('email');
        }
        if($request->has('product_name') && $request->has('product_price')){
            $products_n_p = Product::where(['name' => $request->product_name , 'price' => $request->product_price])->get()->unique('id');
        }
        else if($request->has('product_price')){
            $products_p = Customer::where(['price' => $request->product_price])->get()->unique('id');
        }
        else{
            $products_n = Customer::where(['name' => $request->product_name])->get()->unique('id');
        }
        
        if($request->has('customer_name') && $request->has('product_name') && $request->has('product_price')){
            $query_result = collect();
            foreach($customers as $customer){
                foreach($products_n_p as $product){
                    $result = Sale::where(['product_id' => $product->id , 'customer_id' => $customer->id])->with('product','customer')->get();
                    $query_result = $query_result->concat($result);
                }
            }

            return view('index',['query_result' => $query_result]);
        }
        else if($request->has('customer_name') && $request->has('product_name')){
            $query_result = collect();
            foreach($customers as $customer){
                foreach($products_n as $product){
                    $result = Sale::where(['product_id' => $product->id , 'customer_id' => $customer->id])->with('product','customer')->get();
                    $query_result = $query_result->concat($result);
                }
            }

            return view('index',['query_result' => $query_result]);
        }
        else if($request->has('customer_name') && $request->has('product_price')){
            $query_result = collect();
            foreach($customers as $customer){
                foreach($products_p as $product){
                    $result = Sale::where(['product_id' => $product->id , 'customer_id' => $customer->id])->with('product','customer')->get();
                    $query_result = $query_result->concat($result);
                }
            }

            return view('index',['query_result' => $query_result]);

        }
        else if($request->has('product_name') && $request->has('product_price')){
            $query_result = collect();
            foreach($products_n_p as $product){
                $result = Sale::where(['product_id' => $product->id])->with('product','customer')->get();
                $query_result = $query_result->concat($result);
            }

            return view('index',['query_result' => $query_result]);
        }
        else if($request->has('customer_name')){
            $query_result = collect();
            foreach($customers as $customer){
                $result = Sale::where(['customer_id' => $customer->id])->with('product','customer')->get();
                $query_result = $query_result->concat($result);
            }

            return view('index',['query_result' => $query_result]);
        }
        else if($request->has('product_name')){
            $query_result = collect();
            foreach($products_n as $product){
                $result = Sale::where(['product_id' => $product->id])->with('product','customer')->get();
                $query_result = $query_result->concat($result);
            }

            return view('index',['query_result' => $query_result]);
        }
        else if($request->has('product_price')){
            $query_result = collect();
            foreach($products_p as $product){
                $result = Sale::where(['product_id' => $product->id])->with('product','customer')->get();
                $query_result = $query_result->concat($result);
            }

            return view('index',['query_result' => $query_result]);
        }
        else{
            return redirect();
        }
    }
}
