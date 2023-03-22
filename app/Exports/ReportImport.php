<?php

namespace App\Exports;

use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportImport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
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
            if ($value->status == 1) {
                $value->status = "Approved";
            }
            if ($value->status == 2) {
                $value->status = "Rejected";
            }
            unset($value['id']);
            unset($value['vehicle_id']);
            unset($value['driver_id']);
            unset($value['created_at']);
            unset($value['updated_at']);
            array_push($bookingArr, $value);
        }


        return collect($bookingArr);
    }

    public function headings(): array
    {
        return ["Vehicle", "Driver", "Start", "Finish", "Status", "Information"];
    }
}
