<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomController extends Controller
{   
   
    public function index()
        {   
            //this condition to check if user not login but they know about url can't login 
            if (session('user') == null) {
                 return redirect('login');
            }
            $perPage = 3;
            $roomlist = DB::table('rooms')
                ->join('room_types', 'rooms.room_type_id', '=', 'room_types.room_type_id')
                ->select('rooms.*', 'room_types.room_type_name', 'room_types.price')
                ->where('active','1')
                ->paginate($perPage);
                $data['q_search'] = '';
            return view('backend.room.room', compact('roomlist'));
        }
        public function search(Request $req)
        {
            $key_search = $req->q_search;
            $perPage = 3;
        
            $roomlist = DB::table('rooms')
                ->join('room_types', 'rooms.room_type_id', '=', 'room_types.room_type_id')
                ->select('rooms.*', 'room_types.room_type_name', 'room_types.price')
                ->where('rooms.active', '1')
                ->where(function ($q) use ($key_search) {
                    $q->orWhere('rooms.room_name', 'LIKE', "%{$key_search}%")
                        ->orWhere('rooms.room_desc', 'LIKE', "%{$key_search}%");
                })
                ->paginate($perPage);
                $data['q_search'] = $key_search;
            return view('backend.room.room', compact('roomlist','data'));
        }
        

    public function create(){
        if (session('user') == null) {
            return redirect('login');
       }
        // dd($room_name['roomname']);#to test before map data
        $room_type = DB::table('room_types')
        //->select('room_types.*');
        ->get();    
        return view('backend.room.create',compact('room_type'));
    }

    public function save(Request $req)
{
    $req->validate([
        'room_name' => 'required|string|max:255',
        'room_desc' => 'required',
        'room_status' => 'required',
        'room_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max size 2MB
        'room_type_id' => 'required',
    ]);

    try {
        $data = [
            'room_name' => $req->room_name,
            'room_desc' => $req->room_desc,
            'room_status' => $req->room_status,
            'room_type_id' => $req->room_type_id,
        ];

        if ($req->room_photo) {
            $data['room_photo'] = $req->file('room_photo')->store('upload/rooms/', 'public');
           
        }

        DB::table('rooms')->insert($data);

        return redirect('addnew')->with('success', 'Room created successfully');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Failed to create room: ' . $e->getMessage());
    }
}


    public function edit($id){
        $room_type = DB::table('room_types')->get();
        $room = DB::table('rooms')
        ->where('room_id',$id)
        ->first();
        return view('backend.room.edit',compact('room','room_type'));
        // dd($id);
    }
    public function update(Request $req){
        $req->validate([
            'room_name' => 'required|string|max:255',
            'room_desc' => 'required',
            'room_status' => 'required',
            'room_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max size 2MB
            'room_type_id' => 'required',
        ]);
        $data = $req->except('_token','room_id','room_photo');
        if ($req->room_photo) {
            $data['room_photo'] = $req->file('room_photo')->store('upload/rooms/', 'public');
           
        }
        $i = DB::table('rooms')
        ->where('room_id', $req->room_id)
        ->update($data);
        if($i){
            // return redirect('room/edit/'.$req->room_id) //stay in page edit 
            // ->with('success','Data has been updated!');
            return redirect('room') //redirect to room list page
            ->with('success','Data has been updated!');
        }else{
            return redirect('room/edit/'.$req->room_id)
            ->with('error','Failed Update!');
        }
        
    }
    public function delete($id){
        $i = DB::table('rooms')
            ->where('room_id',$id)
            ->update(['active' => '0']);
    
        return redirect('room') //redirect to room list page
            ->with('success','Data has been Deleted!');
    }
    

    
}
