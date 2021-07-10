<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        return view('dashboard');
    }
}
