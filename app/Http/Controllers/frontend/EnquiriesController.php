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
use Illuminate\Support\Facades\Log;

class EnquiriesController extends Controller
{
    public function submitEnquiry(CreateEnquiryRequest $request)
    {
        $model = null;
        $modelId = null;
        if ($request->model === 'property' && Property::whereKey($request->model_id)->exists()) {
            $model = Property::class;
            $modelId = (int) $request->model_id;
        } elseif ($request->model === 'fre' && FRE::whereKey($request->model_id)->exists()) {
            $model = FRE::class;
            $modelId = (int) $request->model_id;
        }

        $enquiry = Enquiry::create([
            'model_id' => $modelId,
            'model' => $model,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'state' => $request->state,
            'message' => $request->message,
        ]);

        // The lead is saved; a mail outage must not show the visitor an error.
        try {
            foreach (User::admins()->get() as $user) {
                $user->notify(new NewEnquiryNotification($enquiry));
            }
            if ($enquiry->email) {
                $enquiry->notify(new RevertEnquiryNotification($enquiry));
            }
        } catch (\Throwable $e) {
            Log::error('Enquiry notification failed', ['enquiry_id' => $enquiry->id, 'error' => $e->getMessage()]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you! Our team will call you shortly.',
        ]);
    }
}
