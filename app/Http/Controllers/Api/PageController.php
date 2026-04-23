<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use App\Mail\SupportFormMail;
use Illuminate\Support\Facades\Mail;
class PageController extends Controller
{





    public function supportForm(Request $request)
    {

        $validator = Validator::make($request->all(),[
         
            'name' => 'required|min:3|string',
            'email' => 'required|email|min:6',
            'subject' => 'required|string|max:255',
            'description' => 'required|max:10000',
        ]);

         if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $data = $request->only('name', 'email', 'subject', 'description');
            // $adminEmail = "man411210@gmail.com"; 
            $adminEmail = Setting::where("key", "admin_mail")->value('value');

            Mail::to($adminEmail)->send(new SupportFormMail($data));

            return response()->json([
                'message' => 'Your inquiry has been sent successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Email sending failed: ' . $e->getMessage()
            ], 500);
        }




    }



}