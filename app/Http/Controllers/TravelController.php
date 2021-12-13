<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Travel;
use App\Models\Tour;

class TravelController extends Controller
{

    protected $paginationValue;

    public function __construct()
    {
        $this->paginationValue = 2;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::paginate( $this->paginationValue );

        return view('public.travel.index', ['travels'=> $travels]);
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
        //
    }

    /**
     * Display the specified resource finding it by slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        $travel = Travel::where('slug',$slug)->firstOrFail();
        $tours = Tour::where('travel_id', $travel->id)->paginate( $this->paginationValue );

        return view('public.travel.show', ['travel'=> $travel, 'tours' =>$tours]);   
    }

    /**
     * Display the specified resource finding it by slug filtered.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function filterTours(Request $request)
    {
        // $validated = $request->validate([
        //     'travelId' => 'required'
        // ]);

        $travel = Travel::where('id',$request->travelId)->firstOrFail();

        $tours = Tour::where('travel_id', $travel->id);
        if (isset($request->priceFrom))
            $tours->where('price', '>=', $request->priceFrom);
        if (isset($request->priceTo))
            $tours->where( 'price', '<=', $request->priceTo);
        if (isset($request->startingDate)){

            
            $start = Carbon::parse( '2021/10/03' );
            // dd( $start );
            
            $tours->where( 'starting_date', '>=', $request->startingDate);
        }
            
                    
        // dd( $tours );

        $tours = $tours->paginate( $this->paginationValue );
        
        return view('public.travel.show', ['travel'=> $travel, 'tours' =>$tours]);   
    }

    /**
     * Display the specified resource finding it by id\.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $travel = Travel::where('id',$id)->firstOrFail();
    
        $tours = Tour::where('travel_id', $travel->id)->paginate( $this->paginateValue );

        return view('public.travel.show', ['travel'=> $travel, 'tours' =>$tours]);
        
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
