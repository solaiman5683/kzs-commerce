<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    //addVariation
    public function addVariation()
    {
        $attribute = Attribute::all();
        if(request()->isMethod('post')){
            try {
                Variation::create([
                    'attribute_id' => request('attribute_id'),
                    'value' => request('value'),
                    'meta' => request('meta'),
                ]);
                session()->flash('success', 'Attribute added successfully');
            } catch (\Throwable $th) {
                return $th;
            }
        }
        return view('variation.addVariation',compact('attribute'));
    }
    //allVariation
    public function allVariation()
    {
        $variation = Variation::all();
        return view('variation.allVariation',compact('variation'));
    }
}
