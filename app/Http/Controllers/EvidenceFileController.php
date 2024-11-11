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
        if($this->deleteFile($evidenceFile->file)){
            $traceabilityController = new TraceabilityController;
            $traceabilityController->store("DELETE", "Foi excluido o arquivo $evidenceFile->file");
            $evidenceFile->delete();
        }

        return Redirect::route('evidence.index', ['search_evidence' => $evidenceFile->evidence_id])->with('success', "Arquivo removido.");
    }

    public function rotate(EvidenceFile $evidenceFile, $angle = 0)
    {
        $this->rotatet($evidenceFile->file, $angle);
        return back();
    }

    public function dowloadFile(EvidenceFile $evidenceFile)
    {
        $traceabilityController = new TraceabilityController;
        $traceabilityController->store("DOWN", "Foi feito download do arquivo $evidenceFile->file");
        return $this->download($evidenceFile->file);
    }

    public function updateDescription(Request $request, EvidenceFile $evidenceFile)
    {
        try {
            $evidenceFile->update(['description'=>$request->description]);
            $evidenceFile->save();
            return back();
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            return back()->with('error', "ERRO: $message");
        }
    }

    public function moveFile(Request $request, EvidenceFile $evidenceFile) 
    {
        try{
            $fileOld = $evidenceFile->file;
            $evidenceNew = Evidence::findOrFail($request->new_evidence);
            $evidenceOld = Evidence::findOrFail($evidenceFile->evidence_id);
            $fileNew = str_replace($evidenceOld->reference,$evidenceNew->reference,$evidenceFile->file);
            $evidenceFile->update(['evidence_id'=>  $evidenceNew->id, 'file' => $fileNew]);
            $evidenceFile->save();
            $this->renameDir($fileOld,$fileNew);

            $traceabilityController = new TraceabilityController;
            $traceabilityController->store("MOV", "O arquivo $fileOld mudou para $fileNew");
            
            return redirect()->back()->with('success', "MOVIDO<br/>DE:{$evidenceOld->reference}<br/>PARA:{$evidenceNew->reference}");
        }catch (\Throwable $th) {
            $message = $th->getMessage();
            return back()->with('error', "ERRO: $message");
        }
    }
}
