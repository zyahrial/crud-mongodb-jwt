<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;

use Redirect,Response;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

//Soal3 : CRUD dengan mongodb 
class ProductController extends BaseController
{
    public function index(Request $request)
    {
        /** @OA\Info(title="My First API", version="0.1") */
        /**
        * @OA\Get(

        *  path="/v1/user/account/validate",

         *  operationId="accountValidate",

         *  summary="validates an account",

         *  @OA\Parameter(name="email",

         *    in="query",

         *    required=true,

         *    @OA\Schema(type="string")

         *  ),

         *  @OA\Response(response="200",

         *    description="Validation Response",

         *  )

         * )

         */
        $this->product = Product::all();

        return response()->json([
                "product" => empty($this->product) ? "" : $this->product,
        ], 200);
    }

        function show(Request $request, $_id)
    {
    $data = Product::where('_id', $_id)->first();

        if (!$data) {            
            return response()->json([
            'error' => 'Product does not exist.'
        ], 400);
    }

    return response()->json([
            "product" => empty($data) ? "" : $data,
    ], 200);
    }
    

        function destroy(Request $request, $_id)
    {
        $data = Product::where('_id',$_id)->delete();

        return response()->json([
            'status' => 'success.'
        ], 200);
    }

    function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:product',
            'price' => 'required',
            'unit' => 'required',
            'qty' => 'required',
        ]);

        $session = \DB::getMongoClient()->startSession();
        $session->startTransaction();
        try{
        $product = new Product();
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->unit = $request->get('unit');
        $product->qty = $request->get('qty');
        $product->save();
        $session->commitTransaction();
        }catch(\Exception $e){
            // \DB::rollback();
        $session->abortTransaction();
            return response()->json([
                'error' => 'Fail will rollback.'
            ], 400);
        }

        return response()->json([
            'status' => 'success'
        ], 200);
  
    }
    

        function update(Request $request, $_id) 
    {

        $session = \DB::getMongoClient()->startSession();
        $session->startTransaction();
        try{
        $product = Product::where('_id',$_id)->first();
        if (!$product) {
            return response()->json([
                'error' => 'Product does not exist.'
            ], 400);
        }
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->unit = $request->get('unit');
        $product->qty = $request->get('qty');
        $product->save();  
        $session->commitTransaction();
        }catch(\Exception $e){
            // \DB::rollback();
        $session->abortTransaction();
            return response()->json([
                'error' => 'Fail rollback.'
            ], 400);
        }
        
        return response()->json([
            'status' => 'success.'
        ], 200);
    }
}

