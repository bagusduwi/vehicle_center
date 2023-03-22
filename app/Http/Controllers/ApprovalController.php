<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApprovalController extends Controller
{
    private $menu = 'approval';

    public function index()
    {
        $submenu = 'list_approval';

        $booking = Approval::select('bookings.*', 'vehicles.name as vehicle_name', 'drivers.name as driver_name')->leftJoin('bookings', 'approvals.booking_id', 'bookings.id')->join('vehicles', 'vehicles.id', 'bookings.vehicle_id')->join('drivers', 'drivers.id', 'bookings.driver_id')->where('approvals.user_id', Auth::user()->id)->get();

        // grades filtering
        foreach ($booking as $key => $data) {
            $apprv = Approval::select('grades.grade', 'approvals.status')->join('users', 'users.id', 'approvals.user_id')->join('grades', 'grades.id', 'users.grades_id')->where('booking_id', $data->id)->get();

            // return Session::get('grades');
            foreach ($apprv as $value) {
                if ($value->grade < Session::get('grades')->grade && $value->status != 1) {
                    unset($booking[$key]);
                }
            }
        }

        // re-arrange $key because the key will not start from [0,1,2,3] [2,4,5]
        $bookingArr = [];
        foreach ($booking as $key => $value) {
            array_push($bookingArr, $value);
        }

        return view('backend.approval.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'booking' => $bookingArr
        ]);
    }

    public function show($id)
    {
        $approval = Approval::select('approvals.*', 'users.name', 'grades.position')->join('users', 'users.id', 'approvals.user_id')->join('grades', 'grades.id', 'users.grades_id')->where('booking_id', $id)->get();
        return $approval;
    }

    public function action($id, $status)
    {
        try {
            Approval::where('booking_id', $id)->where('user_id', Auth::user()->id)->update([
                'status' => $status
            ]);

            return redirect(url()->previous())->with(['notification' => 'Success, the data has been saved.']);
        } catch (QueryException $e) {
            return redirect(url()->previous())->with(['notification' => $e->getMessage()]);
        }
    }
}
