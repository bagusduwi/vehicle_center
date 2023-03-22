<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $menu = 'driver';

    public function index()
    {
        $submenu = 'list_driver';

        $driver = Driver::all();
        return view('backend.driver.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'driver' => $driver
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submenu = 'create_driver';
        return view('backend.driver.create', [
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
            'license' => 'required',
            'status' => 'required',
        ]);

        try {
            Driver::create($validate);
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
        $driver = Driver::find($id);
        $submenu = 'create_driver';
        return view('backend.driver.edit', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'driver' => $driver
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
            'license' => 'required',
            'status' => 'required',
        ]);

        try {
            Driver::where('id', $id)->update($validate);
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
            Driver::where('id', $id)->delete();
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been delete.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }
}
