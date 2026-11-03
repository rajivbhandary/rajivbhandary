<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Visit::class);
        return view('admin.visits.index');
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
     * Display the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visit = Visit::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $visit);
        $visit->forceDelete();
        session()->flash('success', 'Visit was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Visit $visit){
        $this->authorize('delete', $visit);
        $visit->delete();
        session()->flash('success', 'Visit was trashed Successfully');
        return redirect(route('visits.index'));
    }

    public function trashed(){
        $trashed = Visit::onlyTrashed()->paginate(10);
        return view('admin.visits.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedVisit = Visit::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedVisit);
        $trashedVisit->restore();
        session()->flash('success', 'Visit was restored Successfully!');
        return redirect(route('visits.index'));
    }

    public function trashAll(){
        if(Visit::withoutTrashed()->count() > 0){
            $visits = Visit::withoutTrashed()->get();
            $this->authorize('delete', $visits->first());
            foreach ($visits as $visit){
                $visit->delete();
            }
            session()->flash('success', 'Visits were trashed Successfully');
            return redirect(route('visits.trashed'));
        } else{
            session()->flash('error', 'No data found for trashing');
            return redirect(route('visits.index'));
        }
    }

    public function deleteAll(){
        if(Visit::onlyTrashed()->count() > 0){
            $visits = Visit::onlyTrashed()->get();
            $this->authorize('forceDelete', $visits->first());
            foreach ($visits as $visit){
                $visit->forceDelete();
            }
            session()->flash('success', 'Visits were deleted Successfully');
            return redirect(route('visits.trashed'));
        } else{
            session()->flash('error', 'No data found for deleting');
            return redirect(route('visits.trashed'));
        }
    }

    public function restoreAll(){
        if(Visit::onlyTrashed()->count() > 0){
            $visits = Visit::onlyTrashed()->get();
            $this->authorize('restore', $visits->first());
            foreach ($visits as $visit){
                $visit->restore();
            }
            session()->flash('success', 'Visits were restored Successfully');
            return redirect(route('visits.index'));
        } else{
            session()->flash('error', 'No data found for restoring');
            return redirect(route('visits.trashed'));
        }
    }
}
