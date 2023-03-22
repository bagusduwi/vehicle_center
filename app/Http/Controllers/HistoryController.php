<?php

namespace App\Http\Controllers;

use App\Exports\ReportImport;
use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    private $menu = 'history';

    public function index()
    {
        $submenu = 'list_history';

        if (Auth::user()->grades_id == '') {
            $booking = Booking::select('bookings.*', 'vehicles.name as vehicle_name', 'drivers.name as driver_name')->join('vehicles', 'vehicles.id', 'bookings.vehicle_id')->join('drivers', 'drivers.id', 'bookings.driver_id')->get();
        } else {
            $booking = Approval::select('bookings.*', 'vehicles.name as vehicle_name', 'drivers.name as driver_name')->leftJoin('bookings', 'approvals.booking_id', 'bookings.id')->join('vehicles', 'vehicles.id', 'bookings.vehicle_id')->join('drivers', 'drivers.id', 'bookings.driver_id')->where('approvals.user_id', Auth::user()->id)->get();
        }

        // approval filtering
        foreach ($booking as $key => $data) {
            $apprv = Approval::select('grades.grade', 'approvals.status')->join('users', 'users.id', 'approvals.user_id')->join('grades', 'grades.id', 'users.grades_id')->where('booking_id', $data->id)->get();

            $status = 1;
            foreach ($apprv as $value) {

                if ($value->status == 0) {
                    unset($booking[$key]);
                } else if ($value->status != 1) {
                    $status = 2;
                }
            }

            if (isset($booking[$key])) {
                $booking[$key]->status = $status;
            }
        }

        // re-arrange $key because the key will not start from [0,1,2,3] [2,4,5]
        $bookingArr = [];
        foreach ($booking as $key => $value) {
            array_push($bookingArr, $value);
        }

        // return $bookingArr;

        return view('backend.history.index', [
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

    public function report()
    {
        return Excel::download(new ReportImport, 'report.xlsx');
    }
}
