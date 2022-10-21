<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentPanelController extends Controller
{
    public function paymentsPanel()
    {
        $payments = DB::table('payments')->paginate(10);
        return view('admin.payments.index', ['payments'=>$payments]);
    }
}

