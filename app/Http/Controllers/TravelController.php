<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Travel;
use App\Models\Tour;

use Auth;

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
        return view('admin.travel.create');
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
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'numberOfDays' => 'required|numeric',
            'nature' => 'required|numeric|between:0,100',
            'relax' => 'required|numeric|between:0,100',
            'history' => 'required|numeric|between:0,100',
            'culture' => 'required|numeric|between:0,100',
            'party' => 'required|numeric|between:0,100',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'numberOfDays' => $request->input('numberOfDays'),
            'moods' => json_encode ([
                'nature' => $request->input('nature'),
                'relax' => $request->input('relax'),
                'history' => $request->input('history'),
                'culture' => $request->input('culture'),
                'party' => $request->input('party'),
            ]),
        ];

        try {
            Travel::create($data);
        } catch (\Illuminate\Database\QueryException $exception) {
                   
            return view('admin.travel.create', ['messageKo' => $exception->errorInfo]);
        }

        return view('admin.travel.create', ['messageOk' => 'Travel created']);
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
        $tours = Tour::where('travelId', $travel->id)->orderBy('startingDate')->paginate( $this->paginationValue );

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
        $request->flash();
        
        $validated = $request->validate([
            'travelId' => 'required'
        ]);

        $travel = Travel::where('id',$request->travelId)->firstOrFail();
        $travel->moods = json_decode($travel->moods);

        $tours = Tour::where('travelId', $travel->id);
        if (isset($request->priceFrom))
            $tours->where('price', '>=', $request->priceFrom);
        if (isset($request->priceTo))
            $tours->where( 'price', '<=', $request->priceTo);
        if (isset($request->startingDate)){
            $tours->where( 'startingDate', '>=', $request->startingDate);
        }
        if (isset($request->endingDate)){
            $tours->where( 'endingDate', '<=', $request->endingDate);
        }
        if (isset($request->sortingPrice)){
            $tours->orderBy('price', $request->sortingPrice);
        }
           
        $tours = $tours->paginate( $this->paginationValue );

        
        $sortedResult = $tours->getCollection()->sortBy('startingDate')->values();
        $tours->setCollection($sortedResult);
        
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
        
        $travel->moods = json_decode($travel->moods);
    
        $tours = Tour::where('travelId', $travel->id)->paginate( $this->paginationValue );

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

        $travel = Travel::find($id);

        $travel->moods = json_decode($travel->moods);

        if (Gate::allows('edit-travel')) {
            return view('admin.travel.edit',['travel' => $travel]);
        } else {
            abort(403);
        }
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Gate::allows('update-travel')) {
            $validated = $request->validate([
                'id' => 'required',
                'name' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'numberOfDays' => 'required|numeric',
                'nature' => 'required|numeric|between:0,100',
                'relax' => 'required|numeric|between:0,100',
                'history' => 'required|numeric|between:0,100',
                'culture' => 'required|numeric|between:0,100',
                'party' => 'required|numeric|between:0,100',
            ]);

            $data = [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'numberOfDays' => $request->input('numberOfDays'),
                'moods' => json_encode ([
                    'nature' => $request->input('nature'),
                    'relax' => $request->input('relax'),
                    'history' => $request->input('history'),
                    'culture' => $request->input('culture'),
                    'party' => $request->input('party'),
                ]),
            ];

            try {
                $id = Travel::where('id', $request->input('id'))->update($data);
                $travel = Travel::find($request->input('id'));
                $travel->moods = json_decode($travel->moods);
                return view('admin.travel.edit', [
                    $request->input('id'),
                    'travel' => $travel,
                    'messageOk' => 'Travel Updated'
                ]);
                
            } catch (\Illuminate\Database\QueryException $exception) {
                return view('admin.travel.edit',[$request->input('id'),'messageKo' => $exception->errorInfo]);
            }       
        } else {
            abort(403);
        }
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
