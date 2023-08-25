<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class UniqueNumberController extends Controller
{
    private $outputNumbers = [];
    public function getUniqueNumber(Request $request)
    { 
        $inputNumber = $request->input('input_number');

        $outputNumbers = Cache::get('output_number', []);

        if (in_array($inputNumber, $outputNumbers)) {
            $outputNumber = $inputNumber + 1;
            while (in_array($outputNumber, $outputNumbers)) {
                $outputNumber++;
            }
        } else {
            $outputNumber = $inputNumber;
        }

        $outputNumbers[] = $outputNumber;
        Cache::put('output_number', $outputNumbers);

        return response()->json(['output_number' => $outputNumber]);
    }
}
