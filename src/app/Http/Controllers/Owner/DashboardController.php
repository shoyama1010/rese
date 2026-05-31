<?php
// app/Http/Controllers/Owner/DashboardController.php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('owner.dashboard');
    }
}
