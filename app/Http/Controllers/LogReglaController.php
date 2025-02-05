<?php

namespace App\Http\Controllers;

use App\Models\LogRegla;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogReglaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('logs.listar_logs');
    }

    public function dataLogs()
    {
        $logs = LogRegla::logsAll();
        return Datatables::of($logs)->toJson();
    }

    
}
