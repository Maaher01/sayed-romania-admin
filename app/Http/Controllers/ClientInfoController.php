<?php

namespace App\Http\Controllers;

use App\Models\ClientInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ClientInfoController extends Controller
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
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }
        
        $profile = ClientInfo::create([
            '_name' => $request->name,
            '_code' => $request->code,
        ]);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientInfo  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,ClientInfo $clientinfo)
    {
        $limit = $request->limit;
        $profile = ClientInfo::paginate($limit);
        return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientInfo  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientInfo $clientinfo, $id)
    {
        $profile = ClientInfo::where('id',$id)->first();

       return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientInfo  $clientinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientInfo $clientinfo , $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }

        $profile = ClientInfo::where('id', '=', $id)->update([
            '_name' => $request->name,
            '_code' => $request->code,
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

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientStatusInfo() 
    {
        $result = DB::table('client_infos')
            ->join('client_statuses', 'client_infos._code', '=', 'client_statuses._clientcode')
            ->select('client_infos._name', 'client_infos._code', 'client_statuses._date', 'client_statuses._status')
            ->get();

            return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientStatusInfoByCode($code) 
    {
        $result = DB::table('client_infos')
            ->join('client_statuses', 'client_infos._code', '=', 'client_statuses._clientcode')
            ->where('client_infos._code', $code)
            ->select('client_infos._name', 'client_infos._code', 'client_statuses._date', 'client_statuses._status')
            ->get();

        if ($result->isEmpty()) {
            return response()->json(['status' => false, 'message' => "This Code Doesn't exist."]);
        }

        return response()->json(['status' => true, 'data' => $result]);
    }
}
