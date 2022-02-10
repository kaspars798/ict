<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductShowResource;
use App\Http\Resources\ProductAttributeResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return ProductIndexResource::collection(
            Product::latest()->paginate(15)
        );
    }

    public function show($id) {
        return new ProductShowResource(Product::findOrFail($id));
    }

    public function store(Request $request) {
        $response = false;
        $validateData = $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2'
        ]);
        $product = new Product();
        $product->name = $validateData['name'];
        $product->description = $validateData['description'];
        if($product->save()) {
            $response = true;
        }
        return response()->json(['response' => $response]);
    }

    public function update(Request $request, $id) {
        $response = false;
        $validateData = $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2'
        ]);
        $product = Product::findOrFail($id);
        $product->name = $validateData['name'];
        $product->description = $validateData['description'];
        if($product->save()) {
            $response = true;
        }
        return response()->json(['response' => $response]);
    }

    public function destroy($id) {
        $response = false;
        $product = Product::findOrFail($id);
        foreach($product->attributes as $attribute) {
            $attribute->delete();
        }
        if($product->delete()) {
            $response = true;
        }
        return response()->json(['response' => $response]);
    }

    public function productAttributes($id) {
        $product = Product::findOrFail($id);
        return ProductAttributeResource::collection(
            $product->attributes
        );
    }
}
