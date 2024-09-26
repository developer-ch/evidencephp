<?php

namespace App\Http\Controllers;

use App\Models\Traceability;
use Illuminate\Support\Facades\Auth;

class TraceabilityController extends Controller
{
    private $modelTraceability;
    public function __construct(){
        $this->modelTraceability = new Traceability;
    }

    public function index(){
        $traceabilities = $this->modelTraceability->with('user')->get();
        return view("evidence.traceability",compact('traceabilities'));
    }

    public function store(string $type, string $message){
        if(Auth::user()){
            $this->modelTraceability->user_id = Auth::user()->id;
            $this->modelTraceability->type = $type;
            $this->modelTraceability->message = $message;
            return $this->modelTraceability->save();
        }
    }
}
