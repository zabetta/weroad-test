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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tours =  DB::table('tours')->paginate(2);

        if (null == $tours) {
            abort(404);
        }

        return view('public.tour.index', ['tours' => $tours]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        return view('admin.tour.create', ['travel' =>Travel::findOrFail($id) ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
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
            'travelId' => $request->input('travelId'),
            'name' => $request->input('name'),
            'startingDate' => $request->input('startingDate'),
            'endingDate' => $request->input('endingDate'),
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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if (null == $id) {
            abort(404);
        }

        $tourData = Tour::find($id);
        $travelData = $tourData->getTravel()->first();
        $travelData->moods = json_decode($travelData->moods);

        return view('public.tour.show', [
            'tour' => $tourData,
            'travel' => $travelData
        ]);
    }
}
