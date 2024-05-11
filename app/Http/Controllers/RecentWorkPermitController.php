<?php

namespace App\Http\Controllers;
use App\Models\RecentWorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RecentWorkPermitController extends Controller
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
            'image' => ['required']
        ]);

        if($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validator->errors()], 202);
        }

        $path = "";
        if($request->hasFile('image')){  
            $image = $request->file('image');
            $path = $image->store('recentworkpermitimage', 'public'); // Store the image in the "public/recentworkpermitimage" directory
        } 
        
        $profile = RecentWorkPermit::create([
            '_status' => $request->status,
            '_image' => asset("/uploads")."/".$path
        ]);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecentWorkPermit  $recentworkpermit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,RecentWorkPermit $recentworkpermit)
    {
        $limit = $request->limit;
        $recentworkpermitprofile = RecentWorkPermit::paginate($limit);
        return response()->json(['status' => true, 'data' => $recentworkpermitprofile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecentWorkPermit  $recentworkpermit
     * @return \Illuminate\Http\Response
     */
    public function edit(RecentWorkPermit $recentworkpermit,$id)
    {
        $profile = RecentWorkPermit::where('id',$id)->first();

        return response()->json(['status' => true, 'data' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecentWorkPermit  $recentworkpermit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecentWorkPermit $recentworkpermit,$id)
    {   
        $path = "";
        if($request->hasFile('image')){  
            $image = $request->file('image');
            $path = $image->store('recentworkpermitimage', 'public'); // Store the image in the "public/recentworkpermitimage" directory
        } 
        
        if($request->hasFile('image')){  
            
            $profile = RecentWorkPermit::where('id', '=', $id)->update([
                '_image' => asset("/uploads")."/".$path,
                '_status' => $request->status,
            ]);
        }else{
            $profile = RecentWorkPermit::where('id', '=', $id)->update([
                '_status' => $request->status,
            ]);
        }
        
        

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecentWorkPermit  $recentworkpermit
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecentWorkPermit $recentworkpermit)
    {
        //
    }
}

