<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Http\Resources\AttributeShowResource;

class AttributeController extends Controller
{
   
    public function store(Request $request) {
        $response = false;
        $validateData = $request->validate([
            'product_id' => 'required|integer',
            'key' => 'required|min:1|max:255',
            'value' => 'required|min:1|max:255'
        ]);
        $attribute = new Attribute();
        $attribute->product_id = $validateData['product_id'];
        $attribute->key = $validateData['key'];
        $attribute->value = $validateData['value'];
        if($attribute->save()) {
            $response = true;
        }
        return response()->json(['response' => $response]);
    }

    public function destroy($id) {
        $response = false;
        $attribute = Attribute::findOrFail($id);
        if($attribute->delete()) {
            $response = true;
        }
        return response()->json(['response' => $response]);
    }
}
