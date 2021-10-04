<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Practice\Setting;
use Exception;
use App\Models\Form\ImageValidation;
class SettingController extends Controller
{

    /**
     * [取得網站設定]
     *
     * @return object
     */
    public function getConfig()
    {
        $result = Setting::getConfig();
        return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$result,
            ]);
      
    }

    /**
     * [修改網站設定]
     * @return object
     */
    public function updateConfig(Request $request)
    {
        $data = $request->all();
        $form = new ImageValidation($request->file());
        if ($form->isValid()) {
            return response()->json([
                'status'=>$this::$REQUEST_VERIFY_FAILD,
                'message'=>$form->getErrors()
            ]);
        }
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = 'uploads';//資料夾
            $file->move($location,$filename);
            $data['filename'] ='uploads/'. $filename;
        }
        $result = Setting::updateConfig($data);
        if($result){
               return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$result,
            ]);
        }else{
               return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
    }
   
}