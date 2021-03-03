<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecurringPaymentsAPI extends Controller
{
    // End point hits this function
    public function index(Request $request) {
      // Set up rules for input validation
      	$rules = [
            'subscriptionStartDate' => 'required|date_format:Y-m-d|before:tomorrow',
            'scheduleInMonths' => 'required|integer|between:0,36',
        ];
        $validator = \Validator::make($request->all(), $rules);
        // Validation failure, set response code to 400 and ouput error as JSON to user
        if ($validator->fails()) {
           return response()->json($validator->errors(),400);
        }

	    $paymentDates = $this->returnPaymentDateArray($request->subscriptionStartDate, $request->scheduleInMonths);
	    return response()->json($paymentDates, 200); 
    }

    // This function returns the payment dates in an array
    // Use addMonthsNoOverflow for day's falling between 29-31 ex 31-01-2020
    private function returnPaymentDateArray($inputDate, $numberOfMonths){
    	$results = array();
    	for ( $i=1; $i < $numberOfMonths+1; $i++){
    		$results[] = Carbon::parse($inputDate)->addMonthsNoOverflow($i)->format('Y-m-d');
    	}
    	return $results;
    }

}
