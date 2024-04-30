<?php

namespace App\Http\Controllers;

use App\Models\ClientStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ClientStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clientcode' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }
        
        $profile = ClientStatus::create([
            '_clientcode' => $request->clientcode,
            '_status' => $request->status,
            '_date' => date("Y-m-d ",strtotime($request->date)),
        ]);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientStatus  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,ClientStatus $clientstatus)
    {
        $limit = $request->limit;
        $profile = ClientStatus::paginate($limit);
        return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientStatus  $clientstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientStatus $clientstatus, $id)
    {
        $profile = ClientStatus::where('id',$id)->first();

       return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientStatus  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientStatus $clientstatus , $id)
    {
        $validator = Validator::make($request->all(), [
            'clientcode' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }

        $profile = ClientStatus::where('id', '=', $id)->update([
            '_clientcode' => $request->clientcode,
            '_status' => $request->status,
            '_date' => date("Y-m-d ",strtotime($request->date)),
        ]);    

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientInfo  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientInfo $clientinfo)
    {
        //
    }
}
