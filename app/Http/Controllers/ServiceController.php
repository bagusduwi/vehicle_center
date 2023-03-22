<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $menu = 'service';

    public function index()
    {
        $submenu = 'list_service';

        $service = Service::select('services.*', 'vehicles.name as vehicle_name')->join('vehicles', 'vehicles.id', 'services.vehicle_id')->get();

        return view('backend.service.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'service' => $service
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submenu = 'create_service';
        $vehicle = Vehicle::all();
        return view('backend.service.create', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'vehicle' => $vehicle
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
            'vehicle_id' => 'required',
            'date' => 'required',
        ]);

        try {
            Service::create($validate);
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
        $submenu = 'create_service';
        $service = Service::select('services.*', 'vehicles.name as vehicle_name')->join('vehicles', 'vehicles.id', 'services.vehicle_id')->where('services.id', $id)->first();
        $vehicle = Vehicle::all();
        return view('backend.service.edit', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'service' => $service,
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
            'vehicle_id' => 'required',
            'date' => 'required',
        ]);

        try {
            Service::where('id', $id)->update($validate);
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
            Service::where('id', $id)->delete();
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been delete.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }
}
