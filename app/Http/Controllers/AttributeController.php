<?php

namespace App\Http\Controllers;

use App\Models\attribute as ModelsAttribute;
use App\Models\Attribute;
use Illuminate\Http\Request;
use PDOException;

class AttributeController extends Controller
{
    public function addAttribute()
    {
        if(request()->isMethod('post')){
            try{
                Attribute::create([
                    'name' => request('name'),
                    'slug' => request('slug'),
                ]);
                session()->flash('success', 'Attribute added successfully');
            }catch(PDOException $e){
                return $e;
            }
        }
        return view('attribute.addAttribute');
    }
    //allAttribute
    public function allAttribute()
    {
        $attribute = Attribute::all();
        return view('attribute.allAttribute',compact('attribute'));
    }
}
