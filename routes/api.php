<?php

use App\Http\Controllers\api\EvidenceController;
use Illuminate\Support\Facades\Route;

Route::apiResource("evd",EvidenceController::class);