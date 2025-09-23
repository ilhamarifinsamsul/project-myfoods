<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;

class QRController extends Controller
{
    // function untuk storeResult
    public function storeResult(Request $request)
    {
        $request->validate([
            'table_number' => 'required'|'string',
        ]);

        // simpan di session
        session(['table_number' => $request->table_number]);

        // return response
        return response()->json(['status' => 'success']);
    }

    // function untuk check barcode
    public function checkCode($code)
    {
        if (preg_match('/^[a-Za-Z]\d{4}$/', $code)) {
            // exist
            $exist = Barcode::where('table_number', $code)->exists();

            // jika exist
            if ($exist) {
                // simpan di session
                session(['table_number' => $code]);
                return view('home', [
                    'message' => 'Welcome! Code verified successfully.'
                ]);
            } else {
                return view('invalid', [
                    'message' => 'Invalid code. Please try again.'
                ]);
            }
        }
    }
}
