<?php

namespace App\Http\Controllers\frontend;

use App\Enquiry;
use App\FRE;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEnquiryRequest;
use App\Notifications\NewEnquiryNotification;
use App\Notifications\RevertEnquiryNotification;
use App\Property;
use App\User;
use Illuminate\Http\Request;

class EnquiriesController extends Controller
{
    public function submitEnquiry(CreateEnquiryRequest $request){
        // dd($request);
        $model = null;
        $model_id = $request->model_id ?? null;
        if($request->model === "property"){
            $model = Property::class;
        }else if($request->model === "fre"){
            $model = FRE::class;
        }
        $enquiry = Enquiry::create([
            'model_id' => $model_id,
            'model' => $model,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'state' => $request->state,
            'message' => $request->message,
        ]);
        $users = User::admins()->get();
        foreach ($users as $user){
            $user->notify(new NewEnquiryNotification($enquiry));
        }

        $enquiry->notify(new RevertEnquiryNotification($enquiry));

        return "success";
    }
}
