<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Client;
use App\Client\Assets;
use App\Client\BanksSavings;
use App\Client\BusinessInterests;
use App\Client\Executors;
use App\Client\Gifts;
use App\Client\JointHeldAssets;
use App\Client\Liabilities;
use App\Client\LifeAssurance;
use App\Client\LifetimeGifts;
use App\Client\NilRateBand;
use App\Client\OtherInformation;
use App\Client\Pensions;
use App\Client\PersonalBelongings;
use App\Client\PowersOfAttorney;
use App\Client\ReceivedInheritance;
use App\Client\StocksShares;
use App\Client\TaxHavens;
use App\Client\Trusts;
use App\Client\UKBritishIsles;
use App\Client\Will;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user) {
            $clients = Client::where('user_id', $user->id)->get();
            return response($clients->toJson(), 200);
        } else {
            return response('Unauthenticated request', 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Using this method because we don't need any user input to create a client
        $client = new Client;
        $client->user_id = Auth::user()->id;

        if($client->save()) {
            return response($client->toJson(), 200);
        } else {
            return response('client didn\'t save', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        if(!$client) abort(404);
        
        if($client->user_id == Auth::user()->id) {
            
            $client = $this->getClientData($client);

            return view('client-form', ['client' => $client]);      
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if(!$client) {
            return response('client not found', 400);
        }

        foreach ($request->all() as $key => $value) {
            $model = null;
            switch ($key) {
                case 'executors':
                    $model = new Executors;
                    break;
                case 'powers_of_attorney':
                    $model = new PowersOfAttorney;
                    break;
                case 'will':
                    $model = new Will;
                    break;
                case 'lifetime_gifts':
                    $model = new LifetimeGifts;
                    break;
                case 'gifts':
                    $model = new Gifts;
                    break;
                case 'uk_british_isles':
                    $model = new UKBritishIsles;
                    break;
                case 'tax_havens':
                    $model = new TaxHavens;
                    break;
                case 'nil_rate_band':
                    $model = new NilRateBand;
                    break;
                case 'business_interests':
                    $model = new BusinessInterests;
                    break;
                case 'received_inheritance':
                    $model = new ReceivedInheritance;
                    break;
                case 'trusts':
                    $model = new Trusts;
                    break;
                case 'pensions':
                    $model = new Pensions;
                    break;
                case 'life_assurance':
                    $model = new LifeAssurance;
                    break;
                case 'joint_held_assets':
                    $model = new JointHeldAssets;
                    break;
                case 'stocks_shares':
                    $model = new StocksShares;
                    break;
                case 'banks_savings':
                    $model = new BanksSavings;
                    break;
                case 'personal_belongings':
                    $model = new PersonalBelongings;
                    break;
                case 'assets':
                    $model = new Assets;
                    break;
                case 'liabilities':
                    $model = new Liabilities;
                    break;
                case 'other_information':
                    $model = new OtherInformation;
                    break;
                default:
                    $client->$key = $value;
                    break;
            }

            if($model) {
                $this->insertOrUpdateClientData($client->id, $model, $value);
            }
        }

        if($client->save()) {
            return response($this->getClientData($client));
        } else {
            return response('client didn\'t save', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function insertOrUpdateClientData($client_id, $model, $data) {
        if(!$client_id || !$model || !$data) return;
        
        $record = $model::firstWhere('client_id', $client_id);
        
        if(!$record) {
            $record = new $model;
        }

        $record->client_id = $client_id;
        $record->the_data = $data;

        $record->save();
    }

    private function getClientData($client) {
        if(gettype($client) == 'integer') {
            $client = Client::find($client);
        }

        if(!$client) return false;

        // get client data models
        $client->Executors;
        $client->PowersOfAttorney;
        $client->Will;
        $client->LifetimeGifts;
        $client->Gifts;
        $client->TaxHavens;
        $client->NilRateBand;
        $client->BusinessInterests;
        $client->ReceivedInheritance;
        $client->Trusts;
        $client->Pensions;
        $client->LifeAssurance;
        $client->JointHeldAssets;
        $client->StocksShares;
        $client->BanksSavings;
        $client->PersonalBelongings;
        $client->Assets;
        $client->Liabilities;
        $client->OtherInformation;

        // by default the property name will be u_k_british_isles but I want uk_british_isles
        $client->uk_british_isles = $client->UKBritishIsles;
        unset($client->UKBritishIsles);

        return $client;
    }
}
