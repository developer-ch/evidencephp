<?php

namespace App\Http\Controllers;

use App\Models\Traceability;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TraceabilityController extends Controller
{
    private $modelTraceability;
    public function __construct()
    {
        $this->modelTraceability = new Traceability;
    }

    public function index()
    {
        $traceabilities = $this->modelTraceability->orderByDesc('created_at')->with('user')->get();
        return view("evidence.traceability", compact('traceabilities'));
    }

    public function store(string $type, string $message)
    {
        $this->modelTraceability->user_id = Auth::user()->id ?? User::whereEmail('operacional@email')->first()->id;
        $this->modelTraceability->type = $type;
        $this->modelTraceability->message = $message;
        return $this->modelTraceability->save();
    }
}
