<?php

namespace App\Http\Controllers\admin;

use App\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Enquiry::class);
        return view("admin.enquiries.index");
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
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $enquiry);
        $enquiry->forceDelete();
        session()->flash('success', 'Enquiry was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Enquiry $enquiry){
        $this->authorize('delete', $enquiry);
        $enquiry->delete();
        session()->flash('success', 'Enquiry was trashed Successfully');
        return redirect(route('enquiries.index'));
    }

    public function trashed(){
        $trashed = Enquiry::onlyTrashed()->paginate(10);
        return view('admin.enquiries.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedEnquiry = Enquiry::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedEnquiry);
        $trashedEnquiry->restore();
        session()->flash('success', 'Enquiry was restored Successfully!');
        return redirect(route('enquiries.index'));
    }

    public function trashAll(){
        if(Enquiry::withoutTrashed()->count() > 0){
            $enquiries = Enquiry::withoutTrashed()->get();
            $this->authorize('delete', $enquiries->first());
            foreach ($enquiries as $enquiry){
                $enquiry->delete();
            }
            session()->flash('success', 'Enquiries were trashed Successfully');
            return redirect(route('enquiries.trashed'));
        } else{
            session()->flash('error', 'No data found for trashing');
            return redirect(route('enquiries.index'));
        }
    }

    public function deleteAll(){
        if(Enquiry::onlyTrashed()->count() > 0){
            $enquiries = Enquiry::onlyTrashed()->get();
            $this->authorize('forceDelete', $enquiries->first());
            foreach ($enquiries as $enquiry){
                $enquiry->forceDelete();
            }
            session()->flash('success', 'Enquiries were deleted Successfully');
            return redirect(route('enquiries.trashed'));
        } else{
            session()->flash('error', 'No data found for deleting');
            return redirect(route('enquiries.trashed'));
        }
    }

    public function restoreAll(){
        if(Enquiry::onlyTrashed()->count() > 0){
            $enquiries = Enquiry::onlyTrashed()->get();
            $this->authorize('restore', $enquiries->first());
            foreach ($enquiries as $enquiry){
                $enquiry->restore();
            }
            session()->flash('success', 'Enquiries were restored Successfully');
            return redirect(route('enquiries.index'));
        } else{
            session()->flash('error', 'No data found for restoring');
            return redirect(route('enquiries.trashed'));
        }
    }

}
