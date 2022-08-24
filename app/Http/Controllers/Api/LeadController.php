<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Mail\LeadToLead;
use App\Mail\LeadToAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
        $form_data = $request->all();
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
        $validator = Validator::make($form_data, $validation_rules);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'response'  => $validator->errors(),
            ]);
        }

        try {
            // salvare nel db
            // throw new \Exception("Error Processing Request", 1); // riga per generare un errore di prova; decommentare
            $lead = Lead::create($form_data);

            // inviare mail al lead
            Mail::to($lead->email)->send(new LeadToLead($lead));
            // inviare mail all'admin del sito
            Mail::to('admin@bool.press')->send(new LeadToAdmin($lead));
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'response'  => 'C\'è stato un errore, riprova',   // analizzare bene collegamento a PageContacts.vue
            ], 500);


        }

        return response()->json([
            'success'   => true,
            'response'  => 'Messaggio inviato, verrai contattato al più presto',  // analizzare bene collegamento a PageContacts.vue
        ]);
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
