<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // validation
        $validation_rules = [
            'name'          => 'required|string|max:100',
            'email'          => 'required|email|max:256',
            'message'       => 'required|string|max:8000',
            'mailinglist'   => 'required|boolean',
        ];

        // $request->validate($validation_rules); // per le routes in api.php ritorna un json, in web.php invece fa il redirect
                                               // sulla $request che ci è arrivata chiamiamo il metodo validate()

        // per avere più controllo nel comportamento del validator
        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'response'  => $validator->errors(),
            ]);
        }

        // salvare nel database


        // inviare mail al lead


        // inviare mail all'admin del sito
    }



    public function show(Lead $lead)
    {
        //
    }


    public function edit(Lead $lead)
    {
        //
    }


    public function update(Request $request, Lead $lead)
    {
        //
    }


    public function destroy(Lead $lead)
    {
        //
    }
}
