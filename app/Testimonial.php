<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 
        'city',
        'testimonial',
        'image',
        'additional_info'
    ];

    /**
     * HELPER METHODS
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    /*
     * The below method will give all the image names used in the testimonial body
     */
    public function getAllTestimonialDetailImageNames()
    {
        $imageNames = array();
        $result = array();
        preg_match_all('/<img[^>]+>/i', $this->testimonial, $result);
        $result = $result[0];
        foreach($result as $img_tag)
        {
            preg_match_all('/(src)=("[^"]*")/i',$img_tag, $src);
            $imagePath = $src[2][0];
            $imagePath = substr($imagePath, 1, strlen($imagePath)-2);
            $imageName = explode('/', $imagePath);
            $imageName = $imageName[sizeof($imageName)-1];
            $imageNames[] = $imageName;
        }
        return $imageNames;
    }

    /*
     * The below method will give all the image names present in the 'storage/testimonial-detail-images' directory
     */
    public static function getAllUploadedTestimonialDetailImageNames(){
        $imagesInFolder = File::files("storage/testimonial-detail-images");
        $allImageNames = array();
        foreach($imagesInFolder as $path) {
            $image = pathinfo($path);
            $allImageNames[] = $image["basename"];
        }
        return $allImageNames;
    }

    public static function deleteOrphanImages(){
        $existingImages = Testimonial::getAllUploadedTestimonialDetailImageNames();
        $requiredImages = array();
        $testimonials = Testimonial::all();
        foreach ($testimonials as $testimonial){
            $requiredImages = array_merge($requiredImages, $testimonial->getAllTestimonialDetailImageNames());
        }
        foreach ($existingImages as $image){
            if(!in_array($image, $requiredImages)){
                Storage::delete("testimonial-detail-images/$image");
            }
        }
    }

    /**
     * ACCESSORS
     */

    public function getTruncatedTestimonialAttribute()
    {
        return Str::limit($this->testimonial, 200);
    }

    /**
     * SCOPE QUERIES
     */

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('name', 'like', "%{$searchValue}%")
                ->orWhere('city', 'like', "%{$searchValue}%")
                ->orWhere('testimonial', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "image", "name", "city", "testimonial", "actions"];
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
