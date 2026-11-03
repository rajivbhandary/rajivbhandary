<?php

namespace App\Exports;

use App\Enquiry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnquiriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Enquiry::withoutTrashed()->where('model', '=', App\Property::class)->select(['name', 'email', 'phone_number', 'city', 'state', 'message', 'created_at'])->get();

        // $result =  Enquiry::withoutTrashed()->leftJoin('properties', function($join) {
        //     $join->on('enquiries.model_id', '=', 'properties.id')
        //         ->where('enquiries.model', '=', "App\Property");
        //     })
        //     ->leftJoin('fre', function($join) {
        //         $join->on('enquiries.model_id', '=', 'fre.id')
        //             ->where('enquiries.model', '=', "App\FRE");
        //     })
        //     ->leftJoin('locations AS property_locations', 'properties.location_id', '=', 'property_locations.id')
        //     ->leftJoin('locations AS fre_locations', 'fre.location_id', '=', 'fre_locations.id')
        //     ->select('enquiries.name', 'enquiries.email', 'enquiries.phone_number', 'enquiries.model', DB::raw("CONCAT(property_locations.building_name, ', ', property_locations.street, ', ', IFNULL(property_locations.landmark, ''), ', ', property_locations.locality, ', ', property_locations.town, ', ', property_locations.city, ' - ', property_locations.pincode, ', ', property_locations.state, ', ', property_locations.country) AS property_address"), DB::raw("CONCAT(fre_locations.building_name, ', ', fre_locations.street, ', ', IFNULL(fre_locations.landmark, ''), ', ', fre_locations.locality, ', ', fre_locations.town, ', ', fre_locations.city, ' - ', fre_locations.pincode, ', ', fre_locations.state, ', ', fre_locations.country) AS fre_address"), 'enquiries.city', 'enquiries.state', 'enquiries.message', 'enquiries.created_at', )->get();
    
        // dd($result);

        $resultArray = array();
        $enquiries = Enquiry::withoutTrashed()->get();
        foreach($enquiries as $enquiryObj)
        {
            $location = $enquiryObj->isProperty() ? $enquiryObj->enquiry->address : ($enquiryObj->isFre() ? $enquiryObj->enquiry->address : "");
            $resultArray[] = [$enquiryObj->name, 
                            $enquiryObj->email, 
                            $enquiryObj->phone_number, 
                            $enquiryObj->source, 
                            $location, 
                            $enquiryObj->city, 
                            $enquiryObj->state, 
                            $enquiryObj->message,   
                            $enquiryObj->created_at];
        }

        $result = collect($resultArray);
        return $result;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone Number',
            'Source',
            'Location',
            'City',
            'State',
            'Message',
            'Date of Enquiry',
        ];
    }
}
