<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class ChartController extends Controller
{
    public function chartBaoanstore()
    {
        $users = User::count();

        $totalOrder = Order::count();

        $income = Order::sum('total');

        $orderSuccess = Order::where('status_order', '!=', 'Placed')
            ->where('status_order', '!=', 'Cancelled')
            ->count();

        $chartInCome = Order::groupByRaw('YEAR (created_at), MONTH(created_at), DAY(created_at)')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, SUM(total) as total')
        ->get();

        $chartInComeMonthly = Order::groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total')
            ->get();

        $chartInComeYearly = Order::groupByRaw('YEAR(created_at), MONTH(created_at)')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
        ->get();

        return view('admin.chart.chart-baoanstore', 
        compact('users', 'totalOrder', 'income', 'orderSuccess', 'chartInCome', 'chartInComeMonthly', 'chartInComeYearly'));
    }
}
