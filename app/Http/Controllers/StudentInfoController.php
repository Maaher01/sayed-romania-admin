<?php

namespace App\Http\Controllers;

use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StudentInfoController extends Controller
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'mobile' => ['required', 'string'],
            'district' => ['required', 'string'],
            'location' => ['required', 'string'],
            'eventdate' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }
        
        $profile = StudentInfo::create([
            '_name' => $request->name,
            '_email' => $request->email,
            '_mobile' => $request->mobile,
            '_district' => $request->district,
            '_location' => $request->location,
            '_eventdate' => $request->eventdate,
            '_totalbill' => $request->totalbill,
            '_transactionid' => $request->transactionid,
            '_paymentstatus' => $request->paymentstatus
        ]);

        session(['profile_id' => $profile->id]);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    // public function storeInSession(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => ['required', 'string'],
    //         'email' => ['required', 'string'],
    //         'mobile' => ['required', 'string'],
    //         'district' => ['required', 'string'],
    //         'location' => ['required', 'string'],
    //         'eventdate' => ['required', 'string'],
    //         'eventtime' => ['required', 'string'],
    //         'totalbill' => ['required', 'string'],
    //         'transactionid' => ['required', 'string'],
    //     ]);

    //     if($validator->fails()) {
    //         return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
    //     }
        
    //     $request->session()->put('name', $request->input('name'));
    //     $request->session()->put('email', $request->input('email'));
    //     $request->session()->put('mobile', $request->input('mobile'));
    //     $request->session()->put('district', $request->input('district'));
    //     $request->session()->put('location', $request->input('location'));
    //     $request->session()->put('eventdate', $request->input('eventdate'));
    //     $request->session()->put('eventtime', $request->input('eventtime'));
    //     $request->session()->put('totalbill', $request->input('totalbill'));
    //     $request->session()->put('transactionid', $request->input('transactionid'));

    // return response()->json(['status' => true, 'message' => 'Data stored in session successfully'], 200);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentInfo  $studentinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentInfo $studentinfo)
    {
        $limit = $request->limit;
        $profile = StudentInfo::paginate($limit);
        return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentInfo  $studentinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentInfo $studentinfo, $id)
    {
        $profile = StudentInfo::where('id',$id)->first();

       return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentInfo  $studentinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentInfo $studentinfo , $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'mobile' => ['required', 'string'],
            'district' => ['required', 'string'],
            'location' => ['required', 'string'],
            'eventdate' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }
        
            $profile = StudentInfo::where('id', '=', $id)->update([
                '_name' => $request->name,
                '_email' => $request->email,
                '_mobile' => $request->mobile,
                '_district' => $request->district,
                '_location' => $request->location,
                '_eventdate' => $request->eventdate,
                '_totalbill' => $request->totalbill,
                '_transactionid' => $request->transactionid,
                '_paymentstatus' => $request->paymentstatus
            ]);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentInfo  $studentinfo
     * @return \Illuminate\Http\Response
     */
    public function updatePayment(Request $request, $id)
    {
        $profile = StudentInfo::where('id', '=', $id)->update([
            '_totalbill' => $request->totalbill,
            '_paymentstatus' => $request->paymentstatus,
            '_transactionid' => $request->transactionid
        ]);

    $updatedProfile = StudentInfo::find($id);

    // Check if the student information was successfully updated
    if ($profile && $updatedProfile) {
        // Return the updated student information as a JSON response
        return response()->json(['status' => true, 'profile' => $updatedProfile]);
    } else {
        // Return an error response if the update operation failed
        return response()->json(['status' => false, 'message' => 'Failed to update student information'], 500);
    }

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentInfo  $studentinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentInfo $studentinfo)
    {
        //
    }
}
