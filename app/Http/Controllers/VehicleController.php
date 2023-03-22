<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $menu = 'vehicle';

    public function index()
    {
        $submenu = 'list_vehicle';

        $vehicle = Vehicle::all();
        return view('backend.vehicle.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submenu = 'create_vehicle';
        return view('backend.vehicle.create', [
            'menu' => $this->menu,
            'submenu'  => $submenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'ownership' => 'required',
            'year' => 'required',
            'vin' => 'required',
            'status' => 'required',
            'information' => ''
        ]);

        try {
            Vehicle::create($validate);
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been saved.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $submenu = 'create_vehicle';
        return view('backend.vehicle.edit', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'ownership' => 'required',
            'year' => 'required',
            'vin' => 'required',
            'status' => 'required',
            'information' => ''
        ]);

        try {
            Vehicle::where('id', $id)->update($validate);
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been saved.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
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
        try {
            Vehicle::where('id', $id)->delete();
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been delete.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }
}
