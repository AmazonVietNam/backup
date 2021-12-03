<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->session()->get('compare'));
        $categories = Category::all();
        // return view('frontend.view_compare', compact('categories'));
        return view('frontend-v2.compare.list', compact('categories'));
    }

    //clears the session data for compare
    public function reset(Request $request)
    {
        $request->session()->forget('compare');
        return back();
    }

    //store comparing products ids in session
    public function addToCompare(Request $request)
    {
        if($request->session()->has('compare')){
            $compare = $request->session()->get('compare', collect([]));
            if(!$compare->contains($request->id)){
                if(count($compare) == 3){
                    $compare->forget(0);
                    $compare->push($request->id);
                }
                else{
                    $compare->push($request->id);
                }
            }
        }
        else{
            $compare = collect([$request->id]);
            $request->session()->put('compare', $compare);
        }

        return view('frontend.partials.compare');
    }

    public function new_add(Request $request, $id)
    {
        if($request->session()->has('compare')){
            $compare = $request->session()->get('compare', collect([]));
            if(!$compare->contains($id)){
                if(count($compare) == 3){
                    $compare->forget(0);
                    $compare->push($id);
                }
                else{
                    $compare->push($id);
                }
            }
        }
        else{
            $compare = collect([$id]);
            $request->session()->put('compare', $compare);
        }

        return back()->with('success', translate('Item has been added to compare list'));
    }

    public function removeFromCompare(Request $request, $key)
    {
        if($request->session()->has('compare')){
            $cart = $request->session()->get('compare', collect([]));
            $cart->forget($key);
            $request->session()->put('compare', $cart);
        }

        return back()->with('success', translate('Item has been removed from comparion!'));
        // return view('frontend.partials.cart_details');
    }
}
