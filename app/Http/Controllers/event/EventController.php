<?php

namespace App\Http\Controllers\event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use File;
use Storage;

class EventController extends Controller
{
    //
    public function index()
    {
        return view('event.index');
    }

    public function data(Request $request)
    {
        // dd($user_id);
        $orderBy='tbl_master_event.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_event.nama';
                break;
        }
        $data = Event::select(['tbl_master_event.*'])
                                ;
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(tbl_master_event.nama) like ?',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        // if($request->input('nama')!=null){
        //     $data = $data->where('tbl_master_event.nama',$request->kecamatan);
        // }

        if($request->input('kecamatan')!=null){
            $data = $data->where('tbl_master_event.kecamatan_id',$request->kecamatan);
        }


        $recordsFiltered = $data->get()->count();

        if ($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));

        $data = $data->orderBy($orderBy, $request->input('order.0.dir'))->get();

        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data

        ]);
    }


    public function store(Request $request)
    {
           $will_insert = $request->except(['_token']);
            $event = Event::create($will_insert);
            // return response()->json(true);
            return redirect()->back();
    }

    public function update(Request $request)
    {
           $will_insert = $request->except(['_token','_method']);
           $event = Event::where('id', $request->input('id'))->update($will_insert);
        //    return response()->json(true);
        return redirect()->back();
    }

    public function hapus(Request $request){
		// hapus data
		Event::where('id',$request->input('id'))->delete();

		return response()->json(true);
    }
}
