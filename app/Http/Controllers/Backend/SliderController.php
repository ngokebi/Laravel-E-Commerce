<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function Slider()
    {
        $sliders = Slider::latest()->get();

        return view('admin.pages.slider.slider', compact('sliders'));
    }

    public function AddSlider()
    {

        return view('admin.pages.slider.add');
    }

    public function StoreSlider(Request $request)
    {
        $validated = $request->validate(
            [
                'slider' => 'required',
            ],

            [
                'slider.required' => 'Please input a Slider Image',

            ]

        );

        $slider_image = $request->file('slider');
        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(870, 370)->save('upload/slider/' . $name_gen);

        $last_img = 'upload/slider/' . $name_gen;

        Slider::insert([
            'slider' => $last_img,
            'caption' => $request->caption,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.slider')->with('success', 'Slider Inserted Successfully');
    }

    public function EditSlider($id)
    {
        $edit_slider = Slider::findOrFail($id);

        return view('admin.pages.slider.edit', compact('edit_slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;

        $old_image = $request->old_image;

        $new_img = $request->file('slider');




        if ($new_img) {
            $new_image = hexdec(uniqid()) . '.' . $new_img->getClientOriginalExtension();
            Image::make($new_img)->resize(870, 370)->save('upload/slider/' . $new_image);

            $slider_img = 'upload/slider/' . $new_image;

            unlink($old_image);
            Slider::findOrFail($slider_id)->update([
                'slider' => $slider_img,
                'caption' => $request->caption,
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);

            return Redirect()->route('manage.slider')->with('success', 'Slider Updated Successfully');
        } else {
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);

            return Redirect()->route('manage.slider')->with('success', 'Slider Updated Successfully');
        }
    }


    public function DeleteSlider($id)
    {

        $image = Slider::findOrFail($id);
        $old_image = $image->slider;
        unlink($old_image);

        Slider::findOrFail($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted Successfully');
    }

    public function Active($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 1,
        ]);

        return Redirect()->back()->with('success', 'Slider Active');
    }

    public function Inactive($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 0,
        ]);

        return Redirect()->back()->with('success', 'Slider Inactive');
    }
}
