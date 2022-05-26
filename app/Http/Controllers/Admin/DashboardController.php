<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Customer;
use App\Models\Lender;
use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pages_count = Page::count();
        $customers_count = Customer::count();
        $lenders_count = Lender::count();
        $agreement_count = Agreement::count();
        return view('admin.dashboard', compact(
            'users',
            'pages_count',
            'customers_count',
            'lenders_count',
            'agreement_count',

        ));
    }

}
