<?php

use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\EvidenceFileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',fn  () => redirect()->route('evidence.index'));
Route::resource('/evidence', EvidenceController::class)->except(['destroy'])->names('evidence');
Route::middleware('auth')->resource('/evidence', EvidenceController::class)->only(['destroy'])->names('evidence');
Route::post('evidence/filter',[EvidenceController::class,'index'])->name('evidence.filter');

Route::post('ajustar_imagem_para_email/{evidence}', [EvidenceController::class,'resizeImageToMail'])->name('evidence.resizeImageToMail');
Route::get('download/{evidence}', [EvidenceController::class,'downloadFiles'])->middleware('auth')->name('evidence.downloadFiles');
Route::post('evidence_file/{evidence}',[EvidenceFileController::class,'store'])->name('file.evidence.storage');
Route::middleware('auth')->delete('evidencefile/{evidenceFile}',[EvidenceFileController::class,'destroy'])->name('file.evidence.delete');
Route::get('evidencefile/{evidenceFile}/{angle?}',[EvidenceFileController::class,'rotate'])->name('file.evidence.rotate');
Route::get('evidence_file/dowload/{evidenceFile}',[EvidenceFileController::class,'dowloadFile'])->middleware('auth')->name('file.evidence.dowloadFile');

Route::get('/evidence_files/{evidence}/{evidenceFile}',[EvidenceController::class,'carousel'])->name('file.evidence.carousel');
Route::post('evidence_file/description/{evidenceFile}',[EvidenceFileController::class,'updateDescription'])->name('file.evidence.description');
Route::middleware('auth')->post('evidencefile/move_file/{evidenceFile}',[EvidenceFileController::class,'moveFile'])->name('file.evidence.move');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';