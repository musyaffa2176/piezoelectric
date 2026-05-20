<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseController extends Controller
{
    public function index()
    {
        // Cek login admin
        if (!Session::has('admin')) {
            return redirect('/login');
        }

        // Ambil data dari Firebase node "sensor"
        $database = Firebase::database();
        $data = $database->getReference('sensor')->getValue();

        // Kirim ke view dashboard
        return view('dashboard', compact('data'));
    }
}