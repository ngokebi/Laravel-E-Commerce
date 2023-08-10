<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ShipDivision;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    // Division Functions
    public function ShippingView()
    {
        $shipping = ShipDivision::orderBy('id', 'DESC')->get();

        return view('admin.pages.shipping.shipping', compact('shipping'));
    }

    public function AddShipping()
    {

        return view('admin.pages.shipping.add');
    }

    public function StoreShipping(Request $request)
    {
        $validated = $request->validate(
            [
                'division_name' => 'required',
            ],

            [
                'division_name.required' => 'Please input a Division Name',
            ]

        );

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.shipping')->with('success', 'Division Inserted Successfully');
    }

    public function EditShipping($id)
    {
        $edit_shipping = ShipDivision::findOrFail($id);

        return view('admin.pages.shipping.edit', compact('edit_shipping'));
    }

    public function UpdateShipping(Request $request)
    {
        $division_id = $request->id;

        $validated = $request->validate(
            [
                'division_name' => 'required',
            ],

            [
                'division_name.required' => 'Please input a Division Name',
            ]
        );

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.shipping')->with('success', 'Division Updated Successfully');
    }

    public function DeleteShipping($id)
    {

        ShipDivision::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Division Deleted Successfully');
    }

    // State Functions
    public function StateView()
    {
        $district = State::with('division')->orderBy('id','DESC')->get();

        return view('admin.pages.state.state', compact('district'));
    }

    public function AddState()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();

        return view('admin.pages.state.add', compact('division'));
    }

    public function StoreState(Request $request)
    {
        $validated = $request->validate(
            [
                'division_id' => 'required',
                'state_name' => 'required',
            ],

            [
                'division_id.required' => 'Please input a Division Name',
                'state_name.required' => 'Please input a State',
            ]

        );

        State::insert([
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.state')->with('success', 'State Inserted Successfully');
    }

    public function EditState($id)
    {
        $edit_state = State::findOrFail($id);
        $division = ShipDivision::orderBy('division_name','ASC')->get();

        return view('admin.pages.state.edit', compact('edit_state', 'division'));
    }

    public function UpdateState(Request $request)
    {
        $state_id = $request->id;

        $validated = $request->validate(
            [
                'division_id' => 'required',
                'state_name' => 'required',
            ],

            [
                'division_id.required' => 'Please input a Division Name',
                'state_name.required' => 'Please input a State',
            ]
        );

        State::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.state')->with('success', 'State Updated Successfully');
    }

    public function DeleteState($id)
    {

        State::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'State Deleted Successfully');
    }

     // Area Functions
     public function AreaView()
     {
         $area = Area::with('division', 'state')->orderBy('id','DESC')->get();

         return view('admin.pages.area.area', compact('area'));
     }

     public function AddArea()
     {
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $state = State::orderBy('state_name','ASC')->get();

         return view('admin.pages.area.add', compact('division', 'state'));
     }

     public function Get_State($division_id)
     {
         $get_state = State::where('division_id', $division_id)->orderBy('state_name', 'ASC')->get();

         return json_encode($get_state);
     }

     public function StoreArea(Request $request)
     {
         $validated = $request->validate(
             [
                 'division_id' => 'required',
                 'state_id' => 'required',
                 'area_name' => 'required',
             ],

             [
                 'division_id.required' => 'Please input a Division',
                 'state_id.required' => 'Please input a State',
                 'area_name.required' => 'Please input an Area',
             ]

         );

         Area::insert([
             'division_id' => $request->division_id,
             'state_id' => $request->state_id,
             'area_name' => $request->area_name,
             'created_at' => Carbon::now()
         ]);

         return Redirect()->route('manage.area')->with('success', 'Area Inserted Successfully');
     }

     public function EditArea($id)
     {
         $edit_area = Area::findOrFail($id);
         $division = ShipDivision::orderBy('division_name','ASC')->get();
         $state = State::orderBy('state_name','ASC')->get();

         return view('admin.pages.area.edit', compact('edit_area', 'division', 'state'));
     }

     public function UpdateArea(Request $request)
     {
         $area_id = $request->id;

         $validated = $request->validate(
            [
                'division_id' => 'required',
                'state_id' => 'required',
                'area_name' => 'required',
            ],

            [
                'division_id.required' => 'Please input a Division',
                'state_id.required' => 'Please input a State',
                'area_name.required' => 'Please input an Area',
            ]
         );

         Area::findOrFail($area_id)->update([
            'division_id' => $request->division_id,
            'state_id' => $request->state_id,
            'area_name' => $request->area_name,
            'updated_at' => Carbon::now()
         ]);

         return Redirect()->route('manage.area')->with('success', 'State Updated Successfully');
     }

     public function DeleteArea($id)
     {

         Area::findOrFail($id)->delete();

         return Redirect()->back()->with('success', 'Area Deleted Successfully');
     }
}
