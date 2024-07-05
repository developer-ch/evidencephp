<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\EvidenceFile;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EvidenceFileController extends Controller
{
    use ImageHandler;

    public function store(Request $request, Evidence $evidence)
    {
        if ($request->evidence_file) {
            $namesFile = $this->multipleUpload($request->evidence_file, $evidence->reference);
            foreach ($namesFile as $nameFile) {
                EvidenceFile::Create(['evidence_id' => $evidence->id, 'file' => $nameFile['files']]);
                if ($request->adjust_img)
                    $this->resize($nameFile['files']);

                if ($request->stamp_to_date)
                    $this->insertDateTime($nameFile['files']);
            }
        }
        return redirect()->route('evidence.index', ['search_evidence' => $evidence->id]);
    }

    public function destroy(EvidenceFile $evidenceFile)
    {
        $this->deleteFile($evidenceFile->file);
        $evidenceFile->delete();
        return Redirect::route('evidence.index', ['search_evidence' => $evidenceFile->evidence_id])->with('success', "Excluido com sucesso!");
    }

    public function rotate(EvidenceFile $evidenceFile, $angle = 0)
    {
        $this->rotatet($evidenceFile->file, $angle);
        return back();
    }

    public function dowloadFile(EvidenceFile $evidenceFile)
    {
        return $this->download($evidenceFile->file);
    }

    public function updateDescription(Request $request, EvidenceFile $evidenceFile)
    {
        try {
            $evidenceFile->update(['description'=>$request->description]);
            $evidenceFile->save();

            return redirect()->back();
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            return back()->with('error', "ERRO: $message");
        }
    }

    public function moveFile(Request $request, EvidenceFile $evidenceFile) 
    {
        try{
            $evidenceFile->update(['evidence_id'=>$request->new_evidence]);
            $evidenceFile->save();
            return redirect()->back()->with('success', "Movido");
        }catch (\Throwable $th) {
            $message = $th->getMessage();
            return back()->with('error', "ERRO: $message");
        }
    }
}
