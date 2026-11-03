<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Enquiry extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'model',
        'model_id',
        'name',
        'phone_number',
        'email',
        'city',
        'state',
        'message',
        'additional_info'
    ];

    /**
     * Relationships
     */
    public function enquiry()
    {
        return $this->morphTo('model', 'model');
    }

    /**
     * Helper function
     */

    public function isProperty(){
        return $this->model == Property::class;
    }

    public function isFre(){
        return $this->model == FRE::class;
    }

    public function isContactPage(){
        return $this->model == "";
    }

    public function getModelData()
    {
        if($this->isProperty())
        {
            return Property::find($this->model_id);
        }else if($this->isFre()){
            return FRE::find($this->model_id);
        }
    }
    /**
     * ACCESSORS
     */

    public function getSourceAttribute()
    {
        if($this->isProperty())
            return "Property";
        else if($this->isFre())
            return "FRE";
        else if($this->isContactPage())
            return "Contact Page";
    }
    /**
     * SCOPE QUERIES
     */

    public function scopeJoinAllRelatedTables($query)
    {
        return $query->leftJoin('properties', function($join) {
            $join->on('enquiries.model_id', '=', 'properties.id')
                ->where('enquiries.model', '=', "App\Property");
            })
            ->leftJoin('fre', function($join) {
                $join->on('enquiries.model_id', '=', 'fre.id')
                    ->where('enquiries.model', '=', "App\FRE");
            })
            ->leftJoin('locations AS property_locations', 'properties.location_id', '=', 'property_locations.id')
            ->leftJoin('locations AS fre_locations', 'fre.location_id', '=', 'fre_locations.id')
            ->select('enquiries.*', DB::raw("CONCAT(property_locations.building_name, ', ', property_locations.street, ', ', IFNULL(property_locations.landmark, ''), ', ', property_locations.locality, ', ', property_locations.town, ', ', property_locations.city, ' - ', property_locations.pincode, ', ', property_locations.state, ', ', property_locations.country) AS property_address"), DB::raw("CONCAT(fre_locations.building_name, ', ', fre_locations.street, ', ', IFNULL(fre_locations.landmark, ''), ', ', fre_locations.locality, ', ', fre_locations.town, ', ', fre_locations.city, ' - ', fre_locations.pincode, ', ', fre_locations.state, ', ', fre_locations.country) AS fre_address"));
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('enquiries.name', 'like', "%{$searchValue}%")
                ->orWhere('email', 'like', "%{$searchValue}%")
                ->orWhere('phone_number', 'like', "%{$searchValue}%")
                ->orWhere('model', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.building_name', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.street', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.landmark', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.locality', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.town', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.city', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.pincode', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.state', 'like', "%{$searchValue}%")
                ->orWhere('property_locations.country', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.building_name', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.street', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.landmark', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.locality', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.town', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.city', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.pincode', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.state', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.country', 'like', "%{$searchValue}%")
                ->orWhere('message', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "name", "email", "phone_number", "source", "property_address", "fre_address", "message"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
        }
        return $query;
    }

    public function scopeLimitBy($query, $start, $length)
    {
        if ($length != -1) {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }
}
