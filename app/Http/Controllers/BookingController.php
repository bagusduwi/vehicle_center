<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $menu = 'booking';

    public function index()
    {
        $submenu = 'list_booking';

        $booking = Booking::select('bookings.*', 'vehicles.name as vehicle_name', 'drivers.name as driver_name')->join('vehicles', 'vehicles.id', 'bookings.vehicle_id')->join('drivers', 'drivers.id', 'bookings.driver_id')->get();

        return view('backend.booking.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'booking' => $booking
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submenu = 'create_booking';
        $vehicle = Vehicle::all();
        $driver = Driver::all();
        $user = User::select('users.*', 'grades.grade', 'grades.position')->join('grades', 'grades.id', 'users.grades_id')->where('grades_id', '!=', '')->get();

        return view('backend.booking.create', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'vehicle' => $vehicle,
            'driver' => $driver,
            'user' => $user
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
            'driver_id' => 'required',
            'date' => 'required',
            'user_id' => 'required',
        ]);

        try {
            $booking = Booking::create([
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'start' => explode(' to ', $request->date)[0],
                'finish' => explode(' to ', $request->date)[1],
                'information' => $request->information,
            ]);
            foreach ($request->user_id as $key => $value) {
                Approval::create([
                    'booking_id' => $booking->id,
                    'user_id' => $value,
                    'status' => 0
                ]);
            }
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
        $approval = Approval::select('approvals.*', 'users.name', 'grades.position')->join('users', 'users.id', 'approvals.user_id')->join('grades', 'grades.id', 'users.grades_id')->where('booking_id', $id)->get();
        return $approval;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $submenu = 'create_booking';
        $vehicle = Vehicle::all();
        $driver = Driver::all();
        $user = User::select('users.*', 'grades.grade', 'grades.position')->join('grades', 'grades.id', 'users.grades_id')->where('grades_id', '!=', '')->get();
        $booking = Booking::find($id);
        $approval = Approval::where('booking_id', $id)->get();
        $user_approval = [];
        foreach ($approval as $key => $value) {
            array_push($user_approval, $value->user_id);
        }

        return view('backend.booking.edit', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'vehicle' => $vehicle,
            'driver' => $driver,
            'user' => $user,
            'booking' => $booking,
            'approval' => $user_approval
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
            'driver_id' => 'required',
            'date' => 'required',
            'user_id' => 'required',
        ]);

        try {
            $booking = Booking::where('id', $id)->update([
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'start' => explode(' to ', $request->date)[0],
                'finish' => explode(' to ', $request->date)[1],
                'information' => $request->information,
            ]);
            Approval::where('booking_id', $id)->delete();
            foreach ($request->user_id as $key => $value) {
                Approval::create([
                    'booking_id' => $id,
                    'user_id' => $value,
                    'status' => 0
                ]);
            }
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
            Booking::where('id', $id)->delete();
            Approval::where('booking_id', $id)->delete();
            return redirect(url()->previous())->with(['notification' => 'Success, the data has been delete.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }
}
