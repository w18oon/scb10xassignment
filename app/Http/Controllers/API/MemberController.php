<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Party;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = Member::where([
            'party_id' => $request->party_id,
            'user_id' => $request->user_id,
        ])->get();
        if ($member->count() > 0) {
            $message = 'คุณอยู่ในปาร์ตี้อยู่แล้ว';
        } else {
            $party = Party::find($request->party_id);
            $member = $party->members()->create($request->only('user_id'));
            $message = 'คุณเข้าร่วมปาร์ตี้เรียบร้อยแล้ว';
        }
        
        return response()->json([
            'message' => $message,
            'member' => $member
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
