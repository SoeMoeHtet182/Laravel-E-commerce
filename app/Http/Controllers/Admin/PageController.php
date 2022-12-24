<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\ProductOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $cre = request()->only('email', 'password');

        if (auth()->guard('admin')->attempt($cre)) {
            return redirect('/admin')->with('success', "Log in successfully");
        }
        return redirect()->back()->with('error', "Your email and password do not match");
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function profile($id)
    {
        $admin = Admin::where('id', $id)->first();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);
        $admin = Admin::where('id', $id)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found');
        }

        $image = $request->file('image');
        if (!$image) {
            $image_name = $admin->image;
        } else {
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('images/'), $image_name);
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image_name,
            'address' => $request->address,
            'city' => $request->city,
            'postal code' => $request->postal_code
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function showDashboard()
    {
        //income list dashboard
        $todayIncome = Income::whereDay('created_at', date('d'))->sum('amount');
        $yesterdayIncome = Income::whereDay('created_at', date('d', strtotime('-1 day')))->sum('amount');
        if ($yesterdayIncome !== 0) {
            $incomePercent = ($todayIncome - $yesterdayIncome) / $yesterdayIncome * 100;
            $incomePercent = number_format($incomePercent, 2, '.', '');
        } else {
            $incomePercent = 0;
        }

        //outcome dashboard
        $todayOutcome = Outcome::whereDay('created_at', date('d'))->sum('amount');
        $yesterdayOutCome = Outcome::whereDay('created_at', date('d', strtotime('-1 day')))->sum('amount');
        if ($yesterdayOutCome !== 0) {
            $outcomePercent = ($todayOutcome - $yesterdayOutCome) / $yesterdayOutCome * 100;
            $outcomePercent = number_format($outcomePercent, 2, '.', '');
        } else {
            $outcomePercent = 0;
        }

        // users for current week
        $current_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight", $current_week);
        $end_week = strtotime("next sunday midnight", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);

        $currentWeekUsers = User::whereBetween('created_at', [$start_week, $end_week])->count();
        //end for current week

        //users for last_week
        $last_week = strtotime("-2 week +1 day");
        $start_week_for_last = strtotime("last sunday midnight", $last_week);
        $end_week_for_last = strtotime("next sunday midnight", $start_week_for_last);
        $start_week_for_last = date("Y-m-d", $start_week_for_last);
        $end_week_for_last = date("Y-m-d", $end_week_for_last);

        $lastWeekUsers = User::whereBetween('created_at', [$start_week_for_last, $end_week_for_last])->count();
        //end for last week

        //user list dashboard
        if ($lastWeekUsers !== 0) {
            $usersPercent = ($currentWeekUsers - $lastWeekUsers) / $lastWeekUsers * 100;
        } else {
            $usersPercent = 0;
        }

        //sale dashboard
        $sale = ProductOrder::whereMonth('created_at', date('m'))->sum('total_amount');
        $lastMonthSale = ProductOrder::where('created_at', date('F', strtotime('-1 month')))->sum('total_amount');
        if ($lastMonthSale !== 0) {
            $salePercent = ($sale - $lastMonthSale) / $lastMonthSale * 100;
            $salePercent = number_format($salePercent, 2, '.', '');
        } else {
            $salePercent = 0;
        }

        //charts
        //for sale chart
        $months = [date('F', strtotime("-5 months"))];
        $monthsYear = [
            [
                'year' => date('Y', strtotime("-5 months")),
                'month' => date('m', strtotime('-5 months'))
            ]
        ];

        for ($i = 4; $i >= 0; $i--) {
            $months[] = date('F', strtotime("-$i month"));
            $monthsYear[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month"))
            ];
        };

        //for sale chart data
        $saleData = [];
        foreach ($monthsYear as $my) {
            $saleData[] = ProductOrder::whereYear('created_at', $my['year'])->whereMonth('created_at', $my['month'])->sum('total_amount');
        }

        //for sale chart percent
        $sixMonthsAgo = Carbon::now()->subMonth(5)->startOfMonth();
        $sixMonthsAgoAmount = ProductOrder::where('created_at', '>=', $sixMonthsAgo)->sum('total_amount');

        $lastSixMonthsAgo = Carbon::now()->subMonth(11)->startOfMonth();
        $lastSixMonthsAgoAmount = ProductOrder::where('created_at', '>=', $lastSixMonthsAgo)->sum('total_amount');

        if ($lastSixMonthsAgoAmount == 0) {
            $lastSixMonthsAgoPercent = 0;
        } else {
            $lastSixMonthsAgoPercent = ($sixMonthsAgoAmount - $lastSixMonthsAgoAmount) / $lastSixMonthsAgoAmount * 100;
            $lastSixMonthsAgoPercent = number_format($lastSixMonthsAgoPercent, 2, '.', '');
        }

        //income-outcome chart
        $days = [date('F d', strtotime('-6 days'))];
        $daysMonth = [
            [
                'day' => date('d', strtotime('-6 days')),
                'month' => date('m', strtotime('-6 days'))
            ]
        ];

        for ($i = 5; $i >= 0; $i--) {
            $days[] = date('F d', strtotime("-$i days"));
            $daysMonth[] = [
                'day' => date('d', strtotime("-$i days")),
                'month' => date('m', strtotime("-$i days"))
            ];
        }

        //income-outcome chart data
        $incomeData = [];
        $outcomeData = [];

        foreach ($daysMonth as $dm) {
            $incomeData[] = Income::whereMonth('created_at', $dm['month'])->whereday('created_at', $dm['day'])->sum('amount');
            $outcomeData[] = Outcome::whereMonth('created_at', $dm['month'])->whereday('created_at', $dm['day'])->sum('amount');
        }

        $sixDaysAgo = Carbon::now()->subDay(6)->startOfDay();
        $sixDaysAgoAmount = ProductOrder::where('created_at', '>=', $sixDaysAgo)->get('total_amount');

        //for porduct sales
        $categories = Category::withCount('product')->with('product')->get();

        foreach ($categories as $c) {
            foreach ($c->product as $k => $v) {
                $c->product[$k]->soldAmount = ProductOrder::where('product_id', $v->id)->where('status', 'success')->sum('total_quantity');
            }
        }

        //for product sales chart
        if ($category_id = request()->category_id) {
            $category = Category::find($category_id);
            $products = $category->product;
            foreach ($products as $p) {
                $dataForProducts[] = ProductOrder::where('product_id', $p->id)
                    ->whereMonth('created_at', date('m'))
                    ->sum('total_quantity');
                foreach ($monthsYear as $my) {
                    $productData[] = ProductOrder::where('product_id', $p->id)
                        ->whereYear('created_at', $my['year'])->whereMonth('created_at', $my['month'])
                        ->sum('total_quantity');
                }
            }
            if (!$products->count()) {
                $dataForProducts = [0, 0, 0, 0, 0, 0];
                $productData = [0, 0, 0, 0, 0, 0];
            }
        } else {
            $products = [];
            $dataForProducts = [];
            $productData = [0, 0, 0, 0, 0, 0];
        }

        return view(
            'admin.dashboard',
            compact(
                'todayIncome',
                'incomePercent',
                'todayOutcome',
                'outcomePercent',
                'currentWeekUsers',
                'usersPercent',
                'sale',
                'salePercent',
                'months',
                'saleData',
                'lastSixMonthsAgoPercent',
                'sixDaysAgoAmount',
                'days',
                'incomeData',
                'outcomeData',
                'categories',
                'productData',
                'products',
                'dataForProducts'
            )
        );
    }
}
