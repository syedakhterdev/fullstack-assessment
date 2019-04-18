<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use Validator;
use Mail;
class UserFeedbackController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'           => 'required',
            'email'          => 'required|unique:users',
            'company'        => 'required',
            'phone_number'   => 'required',
            'subject'        => 'required',
            'message'        => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $setData                    = new Feedback();
        $setData->name              = $request->name;
        $setData->email             = $request->email;
        $setData->company           = $request->company;
        $setData->phone_number      = $request->phone_number;
        $setData->subject           = $request->subject;
        $setData->message           = $request->message;
        if($setData->save()) 
        {
            Mail::raw($setData->message, function($message) use ($setData)
            {
                $message->subject($setData->subject);
                $message->from('developer-test@liquidfish.com', 'User Feedback');
                $message->to($setData->email);
            });
            return response()->json(['success'=>'Record is successfully added']);
        }
        
    }
}
