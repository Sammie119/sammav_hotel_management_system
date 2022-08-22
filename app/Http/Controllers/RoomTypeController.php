<?php

namespace App\Http\Controllers;

use App\Models\GallaryImages;
use App\Models\RoomType;
use App\Models\ServicePrice;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('admin.room-types', ['roomTypes' => $roomTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->has('id')){
            $roomType = RoomType::find($request->id);

            ServicePrice::where('service', $roomType->name)->update(['service' => $request->name]);
        }
        else {
            $roomType = new RoomType;
        }

        $roomType->name = $request->name;
        $roomType->description = $request->description;

        if($request->has('id')){
            $roomType->update();

            return redirect('room_types')->with('success', 'Room Type Updated Successfully!!');
        }
        else {

            $this->servicePricing($roomType->name, 'Room Type', 0);

            $roomType->save();

            return redirect('room_types')->with('success', 'Room Type Created Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy($roomType)
    {
        $roomType = RoomType::find($roomType);

        ServicePrice::where('service', $roomType->name)->delete();

        $roomType->delete();

        return redirect('room_types')->with('success', 'Room Type Deleted Successfully!!');
    }

    public function galleryIndex()
    {
        $images = GallaryImages::orderByDesc('image_id')->get();
        return view('admin.gallery_images', ['images' => $images]);
    }

    public function galleryStore(Request $request)
    {
        request()->validate([
            'room_type_id' => 'required',
            'images_src.*' => 'required|mimes:jpeg,png,jpg,gif',
            
        ]);

        if($request->has('id')){
            // dd($request->all());
            $images = GallaryImages::find($request->id);

            if($request->has('image_src')){
                
                if(file_exists(storage_path($images->image_src))){
                    unlink(storage_path($images->image_src));
                }

                $destinationPath = 'storage/gallery_images/';
                $gal_image = date('YmdHis') . "0." . $request->image_src->getClientOriginalExtension();
                $request->image_src->move($destinationPath, $gal_image);

                $images->image_src = 'gallery_images/'.$gal_image;
            }
            
            $images->room_type_id = $request->room_type_id;
            $images->image_alt = $request->image_alt;
            $images->updated_by = Auth()->user()->user_id;

            $images->update();

            return redirect('setup_image')->with('success', 'Image Changed Successfully!!');

        }
        else {
            // $request->file('image_src')
            foreach ($request->file('image_src') as $key => $image_src) {
                $images = new GallaryImages;

                $destinationPath = 'storage/gallery_images/';
                $gal_image = date('YmdHis') . $key . "." . $image_src->getClientOriginalExtension();
                $image_src->move($destinationPath, $gal_image);
                
                $images->room_type_id = $request->room_type_id;
                $images->image_src = 'gallery_images/'.$gal_image;
                $images->image_alt = $request->image_alt."_".$key;
                $images->created_by = Auth()->user()->user_id;
                $images->updated_by = Auth()->user()->user_id;
                
                $images->save();
            }
            
            return redirect('setup_image')->with('success', 'Image(s) Inserted Successfully!!');
        }
    }


    public function galleryDestroy($id)
    {
        $image = GallaryImages::find($id);

        $image->delete();

        return redirect('setup_image')->with('success', 'Image Deleted Successfully!!');
    }
}
