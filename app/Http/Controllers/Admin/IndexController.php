<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
class IndexController extends Controller
{
    public function index()
    {
        Log::warning('warning');
        return view('admin.index.index');
    }
    
}
