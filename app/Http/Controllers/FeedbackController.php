<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // show feedback form
   function showFeedbackForm(Request $request)
   {
      //for simplicity i am taking country from ip
        $geoloc = geoip()->getLocation(request()->ip());
        $country=$geoloc->country;
        return view('feedback',compact('country'));
   }
   function storeFeedback(Request $request)
   {
        $validator = Validator::make($request->all(), [
        'name'                       => 'required|min:2|max:50',
        'state'                      => 'required',
        'city'                       => 'required',
        'feedback_message'           => 'required|min:3|max:100',
     ],[
        'name.required'              => 'Name is required.',
        'name.min'                   => 'Name should not below 2 characters.',
        'name.max'                   => 'Name may not be greater than 50 characters',
        'state.required'             => 'State is required.',
        'city.required'              => 'City is required.',
        'feedback_message.required'  => 'Message is required.',
        'feedback_message.min'       => 'Message should not below 3 characters.',
        'feedback_message.max'       => 'Message may not be greater than 100 characters',
     ]);
        if ($validator->fails()) {
        return ['status' => false,'message' => __($validator->errors()->first()) ];
        }
        $feedback = new Feedback;
        $feedback->name = $request->name;
        $feedback->feedback_message = $request->feedback_message;
        $feedback->country = $request->country;
        $feedback->state = $request->state;
        $feedback->city = $request->city;
        if($feedback->save())
        {
            return ['status' => true, 'message' => __('Feedback submited successfully')];
        }
        return ['status' => false, 'message' => __('Unabled to submit feedback')];
   }

   function getStateList(Request $request){
    $states = [];
    if($request->country_name){
        $country = Country::where('name',$request->country_name)->first();            
        if ($country) {
            return $states = State::where('country_id',$country->id)->get(['id','name']);
        }
    }
    return $states;
   }

   function getCityList(Request $request){
    $cities = [];
        if($request->state_name){
            $state = State::where('name',$request->state_name)->first();
            if ($state) {
                return $states = City::where('state_id',$state->id)->get(['id','name']);
            }
        }
        return $cities;
   }
}
