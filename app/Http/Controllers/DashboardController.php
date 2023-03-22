<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $menu = 'dashboard';

    public function index()
    {
        $submenu = 'list_history';

        $res = Booking::select('finish')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->finish)->format('m');
            });

        $dataByMonth = [];
        foreach ($res as $key => $value) {
            $dataByMonth = array_merge($dataByMonth, [(int)$key => count($value)]);
        }

        // return $bookingArr;
        return view('backend.dashboard.index', [
            'menu' => $this->menu,
            'submenu'  => $submenu,
            'booking' => $res,
            'data' => $dataByMonth
        ]);
    }
}
