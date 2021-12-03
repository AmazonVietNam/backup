<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Seller;
use App\Upload;
use App\BusinessSetting;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use App\Notifications\EmailVerificationNotification;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('user', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Auth::user()->shop;
        $ids = explode(',', $shop->sliders);
        $sliders = Upload::whereIn('id', $ids)->get();
        // return view('frontend.user.seller.shop', compact('shop'));
        return view('frontend-v2.user.seller.shop', compact('shop', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        if(Auth::check() && Auth::user()->user_type == 'admin'){
            flash(translate('Admin can not be a seller'))->error();
            return back();
        }
        else{
            // return view('frontend.seller_form');
            return view('frontend-v2.shop.seller_create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = null;
        if(!Auth::check()){

            $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6|regex:/^\S+$/i|confirmed',
                'email' => 'required|string|email|unique:users',
                'address' => 'required|string',
                'phone' => 'required|regex:/[0-9]/i|digits_between:9,10',
                'logo' => 'required|image',
                'id_user_code' => 'numeric|digits_between:9,12',
                'id_com_code' => 'numeric|digits:10'
            ], [
                'required' => 'Vui lòng nhập :attribute',
                'name.string' => 'Họ và tên không hợp lệ',
                'password.string' => 'Mật khẩu không hợp lệ',
                'password.regex' => 'Mật khẩu không hợp lệ',
                'password.min' => 'Mật khẩu cần ít nhất 6 kí tự',
                'password.confirmed' => 'Xác nhận mật khẩu không hợp lệ',
                'email.string' => 'Địa chỉ email không hợp lệ',
                'email.unique' => 'Địa chỉ email không hợp lệ',
                'id_user_code.numeric' => ':attribute phải là số',
                'id_com_code.numeric' => ':attribute phải là số',
                'id_com_code.digits' => ':attribute phải có 10 kí tự',
                'id_user_code.digits_between' => ':attribute phải từ :min đến :max kí tự',
                'phone.required' => 'Hãy nhập :attribute',
                'phone.regex' => ':attribute không hợp lệ',
                'phone.digits_between' => ':attribute phải từ :min đến :max kí tự'
            ],
            [
                'name' => 'họ và tên',
                'password' => 'mật khẩu',
                'email' => 'địa chỉ email',
                'address' => 'địa chỉ',
                'id_user_code' => 'CCCD',
                'id_com_code' => 'MST',
                'phone' => 'SĐT'
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type = "seller";
            $user->password = Hash::make($request->password);
            $user->save();
        }
        else{
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'phone' => 'required|regex:/[0-9]/i|digits_between:9,10',
                'logo' => 'required|image'
            ], [
                'required' => 'Vui lòng nhập :attribute',
                'name.string' => 'Họ và tên không hợp lệ',
                'phone.required' => 'Hãy nhập :attribute',
                'phone.regex' => ':attribute không hợp lệ',
                'phone.digits_between' => ':attribute phải từ :min đến :max kí tự'
            ],
            [
                'name' => 'họ và tên',
                'password' => 'mật khẩu',
                'email' => 'địa chỉ email',
                'address' => 'địa chỉ',
                'id_user_code' => 'CCCD',
                'id_com_code' => 'MST',
                'phone' => 'SĐT'
            ]);

            $user = Auth::user();
            if($user->customer != null){
                $user->customer->delete();
            }
            $user->user_type = "seller";
            $user->save();
        }

        $seller = new Seller;
        $seller->user_id = $user->id;
        $seller->save();

        if(Shop::where('user_id', $user->id)->first() == null){
            $shop = new Shop;
            $shop->user_id = $user->id;
            $shop->name = $request->name;
            $shop->address = $request->address;
            $shop->slug = preg_replace('/\s+/', '-', $request->name).'-'.$shop->id;
            $shop->phone = $request->phone;
            
            if($shop->save()){
                auth()->login($user, false);
                if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                    $user->email_verified_at = date('Y-m-d H:m:s');
                    $user->save();
                }
                else {
                    $user->notify(new EmailVerificationNotification());
                }

                if($request->hasFile('logo')) {
                    $type = array(
                        "jpg"=>"image",
                        "jpeg"=>"image",
                        "png"=>"image",
                        "svg"=>"image",
                        "webp"=>"image",
                        "gif"=>"image",
                        "mp4"=>"video",
                        "mpg"=>"video",
                        "mpeg"=>"video",
                        "webm"=>"video",
                        "ogg"=>"video",
                        "avi"=>"video",
                        "mov"=>"video",
                        "flv"=>"video",
                        "swf"=>"video",
                        "mkv"=>"video",
                        "wmv"=>"video",
                        "wma"=>"audio",
                        "aac"=>"audio",
                        "wav"=>"audio",
                        "mp3"=>"audio",
                        "zip"=>"archive",
                        "rar"=>"archive",
                        "7z"=>"archive",
                        "doc"=>"document",
                        "txt"=>"document",
                        "docx"=>"document",
                        "pdf"=>"document",
                        "csv"=>"document",
                        "xml"=>"document",
                        "ods"=>"document",
                        "xlr"=>"document",
                        "xls"=>"document",
                        "xlsx"=>"document"
                    );
        
                    $upload = new Upload;
                    $upload->file_original_name = null;
        
                    $arr = explode('.', $request->file('logo')->getClientOriginalName());
        
                    for($i=0; $i < count($arr)-1; $i++){
                        if($i == 0){
                            $upload->file_original_name .= $arr[$i];
                        }
                        else{
                            $upload->file_original_name .= ".".$arr[$i];
                        }
                    }
        
                    $upload->file_name = $request->file('logo')->store('uploads/all');
                    $upload->user_id = $user->id;
                    $upload->extension = strtolower($request->file('logo')->getClientOriginalExtension());
                    if(isset($type[$upload->extension])){
                        $upload->type = $type[$upload->extension];
                    }
                    else{
                        $upload->type = "others";
                    }
                    $upload->file_size = $request->file('logo')->getSize();
                    $upload->save();
        
                    $shop->logo = $upload->id;
                }

                flash(translate('Your Shop has been created successfully!'))->success();
                return redirect()->route('shops.index');
            }
            else{
                $seller->delete();
                $user->user_type == 'customer';
                $user->save();
            }
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
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
        $shop = Shop::findOrFail($id);

        $validated = $request->validate([
            'logo' => 'image',
            'sliders.index' => 'image',
        ]);

        $type = array(
            "jpg"=>"image",
            "jpeg"=>"image",
            "png"=>"image",
            "svg"=>"image",
            "webp"=>"image",
            "gif"=>"image",
            "mp4"=>"video",
            "mpg"=>"video",
            "mpeg"=>"video",
            "webm"=>"video",
            "ogg"=>"video",
            "avi"=>"video",
            "mov"=>"video",
            "flv"=>"video",
            "swf"=>"video",
            "mkv"=>"video",
            "wmv"=>"video",
            "wma"=>"audio",
            "aac"=>"audio",
            "wav"=>"audio",
            "mp3"=>"audio",
            "zip"=>"archive",
            "rar"=>"archive",
            "7z"=>"archive",
            "doc"=>"document",
            "txt"=>"document",
            "docx"=>"document",
            "pdf"=>"document",
            "csv"=>"document",
            "xml"=>"document",
            "ods"=>"document",
            "xlr"=>"document",
            "xls"=>"document",
            "xlsx"=>"document"
        );

        if($request->has('name') && $request->has('address')){
            $shop->name = $request->name;
            if ($request->has('shipping_cost')) {
                $shop->shipping_cost = $request->shipping_cost;
            }
            $shop->address = $request->address;
            $shop->slug = preg_replace('/\s+/', '-', $request->name).'-'.$shop->id;
            $shop->phone = $request->phone;
            $shop->meta_title = $request->meta_title;
            $shop->meta_description = $request->meta_description;

            if($request->hasFile('logo')) {
                $upload = new Upload;
                $upload->file_original_name = null;
    
                $arr = explode('.', $request->file('logo')->getClientOriginalName());
    
                for($i=0; $i < count($arr)-1; $i++){
                    if($i == 0){
                        $upload->file_original_name .= $arr[$i];
                    }
                    else{
                        $upload->file_original_name .= ".".$arr[$i];
                    }
                }
    
                $upload->file_name = $request->file('logo')->store('uploads/all');
                $upload->user_id = Auth::user()->id;
                $upload->extension = strtolower($request->file('logo')->getClientOriginalExtension());
                if(isset($type[$upload->extension])){
                    $upload->type = $type[$upload->extension];
                }
                else{
                    $upload->type = "others";
                }
                $upload->file_size = $request->file('logo')->getSize();
                $upload->save();
    
                $shop->logo = $upload->id;
            }

            if ($request->has('pick_up_point_id')) {
                $shop->pick_up_point_id = json_encode($request->pick_up_point_id);
            }
            else {
                $shop->pick_up_point_id = json_encode(array());
            }
        }

        elseif($request->has('facebook') || $request->has('google') || $request->has('twitter') || $request->has('youtube') || $request->has('instagram')){
            $shop->facebook = $request->facebook;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
        }

        else if($request->hasFile('sliders')) {
            // $shop->sliders = $request->sliders;
            
        }

        if($shop->save()){
            flash(translate('Your Shop has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function dropzone_upload(Request $request)
    {
        if($request->hasFile('slider'))
        {
            $type = array(
                "jpg"=>"image",
                "jpeg"=>"image",
                "png"=>"image",
                "svg"=>"image",
                "webp"=>"image",
                "gif"=>"image",
                "mp4"=>"video",
                "mpg"=>"video",
                "mpeg"=>"video",
                "webm"=>"video",
                "ogg"=>"video",
                "avi"=>"video",
                "mov"=>"video",
                "flv"=>"video",
                "swf"=>"video",
                "mkv"=>"video",
                "wmv"=>"video",
                "wma"=>"audio",
                "aac"=>"audio",
                "wav"=>"audio",
                "mp3"=>"audio",
                "zip"=>"archive",
                "rar"=>"archive",
                "7z"=>"archive",
                "doc"=>"document",
                "txt"=>"document",
                "docx"=>"document",
                "pdf"=>"document",
                "csv"=>"document",
                "xml"=>"document",
                "ods"=>"document",
                "xlr"=>"document",
                "xls"=>"document",
                "xlsx"=>"document"
            );
            $upload = new Upload;
            $upload->file_original_name = null;

            $arr = explode('.', $request->file('slider')->getClientOriginalName());

            for($i=0; $i < count($arr)-1; $i++){
                if($i == 0){
                    $upload->file_original_name .= $arr[$i];
                }
                else{
                    $upload->file_original_name .= ".".$arr[$i];
                }
            }
        
            $upload->file_name = $request->file('slider')->store('uploads/all');
            $upload->user_id = Auth::user()->id;
            $upload->extension = strtolower($request->file('slider')->getClientOriginalExtension());
            if(isset($type[$upload->extension])){
                $upload->type = $type[$upload->extension];
            }
            else{
                $upload->type = "others";
            }
            $upload->file_size = $request->file('slider')->getSize();

            $exist = Upload::where(['file_original_name' => $upload->file_original_name, 'file_size' => $request->file('slider')->getSize()])->first();
            if($exist == null) {
                $upload->save();
                return response()->json(['success'=>$upload]);
            } else {
                return response()->json(['success'=>$exist]);
            }
        }
        else {
            return response()->json(['error'=>'Not found image']);
        }

        // $sss = implode(",", $arrSliders);
        // return response()->json(['success'=>$uploaded, 'sliders' => $sss]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verify_form(Request $request)
    {
        if(Auth::user()->seller->verification_info == null){
            $shop = Auth::user()->shop;
            return view('frontend.user.seller.verify_form', compact('shop'));
        }
        else {
            flash(translate('Sorry! You have sent verification request already.'))->error();
            return back();
        }
    }

    public function verify_form_store(Request $request)
    {
        $data = array();
        $i = 0;
        foreach (json_decode(BusinessSetting::where('type', 'verification_form')->first()->value) as $key => $element) {
            $item = array();
            if ($element->type == 'text') {
                $item['type'] = 'text';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'select' || $element->type == 'radio') {
                $item['type'] = 'select';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'multi_select') {
                $item['type'] = 'multi_select';
                $item['label'] = $element->label;
                $item['value'] = json_encode($request['element_'.$i]);
            }
            elseif ($element->type == 'file') {
                $item['type'] = 'file';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i]->store('uploads/verification_form');
            }
            array_push($data, $item);
            $i++;
        }
        $seller = Auth::user()->seller;
        $seller->verification_info = json_encode($data);
        if($seller->save()){
            flash(translate('Your shop verification request has been submitted successfully!'))->success();
            return redirect()->route('dashboard');
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }
}
