<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours =  DB::table('tours')->paginate(2);

        if (!$tours)
            abort('404');

        return view('public.tour.index', ['tours' => $tours]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  uuid  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.tour.create', ['travel' =>Travel::findOrFail($id) ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'travelId' => 'required',
            'name' => 'required',
            'startingDate' => 'required',
            'endingDate' => 'required',
            'price' => 'required'
        ]);
        

        // TODO check starting date and endingdate with number of nights

        $data = [
            'travel_id' => $request->input('travelId'),
            'name' => $request->input('name'),
            'starting_date' => $request->input('startingDate'),
            'ending_date' => $request->input('endingDate'),
            'price' => (int)$request->input('price')*100,
        ];
        
        try {
            
            Tour::create($data);
            
            
        } catch (\Illuminate\Database\QueryException $exception) {
                
            return view('admin.tour.create', [
                'travel' => Travel::find($request->input('travelId')), 
                'messageKo' => $exception->errorInfo
            ]);
            
        }

        return view('admin.tour.create', [
            'messageOk' => 'Tour created',
            'travel' => Travel::find($request->input('travelId'))
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

        if ( null == $id )
            abort();
        
        $tourData = Tour::find($id);

        return view('public.tour.show', ['tour' => $tourData ]);
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
