<?php

namespace App\Http\Controllers\Api\V1\Contracts;

use App\Http\Controllers\Controller;
use Facades\App\Libraries\System\CustomID;
use App\Models\Contracts\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::customerContracts()->get();

        return $contracts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'customerID' => 'required'
        ]);

        $contract = new Contract();
        $contract->type = 3;
        $fillables = ['customerID', 'description', 'name', 'value'];
        foreach ($request->only($fillables) as $key => $value) {
            $contract->{$key} = !empty($value) ? $value : NULL;
        }

        $contract->customID = !empty($request->autoID) && $request->autoID ? CustomID::next(110) : ((!empty($request->customID) ? (is_numeric($request->customID) ? (int)$request->customID : $request->customID) : CustomID::next(110)));
        $contract->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $contract->risk = $request->risk ?? 3;
        $contract->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $contract->save();

        return $contract;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::findOrFail($id);

        return $contract;
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
        //
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
}
