<?php

namespace App\Http\Controllers\admin;

use App\FRE;
use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function uploadPropertyImage(Request $request, $folderName){
        $imageURL = array();
        if($request->has('propertyID')){
            //update property
            $propertyID = $request->get('propertyID');
            $property = Property::findOrFail($propertyID);

            //previousImages
            $imageProperty = $property->image;
            // dd($imageProperty);
            $previousimages = array();
            foreach($imageProperty as $temp)
            {
                $previousimages[] = $temp->image['path'];
            }

            if($request['files'] != null){
                $uppyImage = $request['files'];
                if(! ($request->has('uploadName'))){
                    //new image, store & return URL to insert in db;
                    foreach($uppyImage as $image){
                        $imageURL['uploadURL'] = $image->store("properties");
                    }
                    echo json_encode($imageURL);
                }else{
                    //common image ie match in previous images
                    echo json_encode($imageURL);
                }
            }else{
                abort(404);
            }
        }else{
            //create property
            if($request['files'] != null){
                $images = $request['files'];
                foreach($images as $image){
                    $imageURL['uploadURL'] = $image->store("properties");
                }
                echo json_encode($imageURL);
            }else{
                abort(404);
            }
        }
    }

    public function uploadFREImage(Request $request, $folderName){
        $imageURL = array();
        if($request->has('freID')){
            //update property
            $freID = $request->get('freID');
            $fre = FRE::findOrFail($freID);
            
            //previousImages
            $imageFre = $fre->image;
            // dd($imageProperty);
            $previousimages = array();
            foreach($imageFre as $temp)
            {
                $previousimages[] = $temp->image['path'];
            }

            if($request['files'] != null){
                $uppyImage = $request['files'];
                if(! ($request->has('uploadName'))){
                    //new image, store & return URL to insert in db;
                    foreach($uppyImage as $image){
                        $imageURL['uploadURL'] = $image->store("fres");
                    }
                    echo json_encode($imageURL);
                }else{
                    //common image ie match in previous images
                    echo json_encode($imageURL);
                }
            }else{
                abort(404);
            }
        }else{
            //create property
            if($request['files'] != null){
                $images = $request['files'];
                foreach($images as $image){
                    $imageURL['uploadURL'] = $image->store("fres");
                }
                echo json_encode($imageURL);
            }else{
                abort(404);
            }
        }
    }

    // public function uploadFREImage(Request $request, $folderName){
    //     if($request['files'] != null){
    //         $images = $request['files'];
    //         foreach($images as $image){
    //             $image->store('fres-temp/'.$folderName);
    //         }
    //         echo json_encode(array('uploadURL' => asset("storage/$image")));
    //     }else{
    //         abort(404);
    //     }
    // }
}
