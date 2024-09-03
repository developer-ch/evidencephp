<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvidenceResource;
use App\Models\Evidence;
use App\Models\EvidenceFile;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EvidenceResource::collection(Evidence::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs['reference'] = date("dmY_", strtotime($request->date_process)) . $request->operation . $request->reference;
        $inputs['created_at'] = $request->date_process;
        return Evidence::Create($inputs);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evidence $evidence)
    {
        return $evidence;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evidence $evidence)
    {
        $evidenceOld = $evidence->reference;
        $inputs['reference'] = date("dmY_", strtotime($request->date_process)) . $request->reference;
        $inputs['created_at'] = $request->date_process;

        $evidence->fill($inputs);
        $evidence->save();

        try {
            if ($this->renameDir($evidenceOld, $evidence->reference)) {
                $evidencesFiles = EvidenceFile::where('evidence_id', $evidence->id)->where('file', 'LIKE', $evidenceOld . "%")->get();
                foreach ($evidencesFiles as $evidenceFile) {
                    $evidenceFile->file = \Str::replace($evidenceOld, $evidence->reference, $evidenceFile->file);
                    $evidenceFile->save();
                }
            }
        } finally{
            return $evidence;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evidence $evidence)
    {
        $nameEvidence = $evidence->reference;
        $evidence->delete();
    }
}