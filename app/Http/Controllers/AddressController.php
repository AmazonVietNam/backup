<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Province;
use App\District;
use App\Ward;
use App\Country;
use Auth;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'province' => 'required|integer|min:0',
            'district' => 'required|integer|min:0',
            'ward' => 'required|integer|min:0'
        ]);

        $address = new Address;
        if($request->has('customer_id')){
            $address->user_id = $request->customer_id;
        }
        else{
            $address->user_id = Auth::user()->id;
        }
        $province = Province::findOrFail($request->province, ['name', 'id']);
        $district = District::findOrFail($request->district, ['fullname', 'id']);
        $ward = Ward::findOrFail($request->ward, ['fullname', 'id']);
        $country = Country::findOrFail($request->country, ['name']);

        $address->address = $request->address;
        $address->country = $country->name;
        $address->city = Str::title($province->name);
        $address->province_id = $province->id;
        $address->district_name = Str::title($district->fullname);
        $address->district_id = $district->id;
        $address->ward_name = Str::title($ward->fullname);
        $address->ward_id = $ward->id;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->save();

        return back();
    }

    public function getProvincesInContry(Request $request, $id) {
        if($request->ajax()) {
            $provinces = Province::where('country_id', $id)->select('id', 'name')->get();

            return response()->json($provinces);
        }
    }

    public function getDistrictsInProvince(Request $request, $id) {
        if($request->ajax()) {
            $districts = District::where('province_id', $id)->select('id', 'name')->get();

            return response()->json($districts);
        }
    }

    public function getWardsInDistrict(Request $request, $id) {
        if($request->ajax()) {
            $wards = Ward::where('district_id', $id)->select('id', 'name')->get();

            return response()->json($wards);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        if(!$address->set_default){
            $address->delete();
            return back();
        }
        flash(translate('Default address can not be deleted'))->warning();
        return back();
    }

    public function set_default($id){
        foreach (Auth::user()->addresses as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        $address = Address::findOrFail($id);
        $address->set_default = 1;
        $address->save();

        return back();
    }
}
