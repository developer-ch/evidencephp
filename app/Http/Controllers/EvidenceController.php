<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvidenceResource;
use App\Models\Evidence;
use App\Models\EvidenceFile;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
    use ImageHandler;

    public function index(Request $request)
    {
        $searchEvidence = $request->search_evidence ?? null;
        $evidence = null;
        $evidences = EvidenceResource::collection(Evidence::latest()->orderBy('id', 'DESC')->get());
        $filesEvidence = [];
        if ($searchEvidence) {
            $evidence = Evidence::find($searchEvidence);
            $filesEvidence = EvidenceFile::where('evidence_id', $searchEvidence)->orderBy('id', 'DESC')->get();
        }
        return view('evidence.index', compact(['evidence', 'evidences', 'searchEvidence', 'filesEvidence']));
    }

    public function create()
    {
        return back()->with('success', "SUCCESS");
    }

    public function store(Request $request)
    {
        $inputs['reference'] = date("dmY_", strtotime($request->date_process)) . $request->operation . $request->reference;
        $inputs['created_at'] = $request->date_process;
        try {
            $evidence = Evidence::Create($inputs);
            return redirect()->route('evidence.index', ['search_evidence' => $evidence])->with('success', "SUCESSO: Agrupador $request->reference cadastrado");
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return back()->with('error', "ERRO: Agrupador " . $inputs['reference'] . " Já cadastrado!");
            }
            $message = $th->getMessage();
            return redirect()->route('evidence.index')->with('error', "ERRO: $message");
        }
    }

    public function show(Evidence $evidence)
    {
        return redirect()->route('evidence.index', ['search_evidence' => $evidence->id]);
    }

    public function edit(Evidence $evidence)
    {
        return redirect()->route('evidence.index', ['search_evidence' => $evidence->id]);
    }


    public function update(Request $request, Evidence $evidence)
    {
        $evidenceOld = $evidence->reference;
        $inputs['reference'] = date("dmY_", strtotime($request->date_process)) . $request->reference;
        $inputs['created_at'] = $request->date_process;
        try {
            $evidence->fill($inputs);
            $evidence->save();

            if ($this->renameDir($evidenceOld, $evidence->reference)) {
                $evidencesFiles = EvidenceFile::where('evidence_id', $evidence->id)->where('file', 'LIKE', $evidenceOld . "%")->get();
                foreach ($evidencesFiles as $evidenceFile) {
                    $evidenceFile->file = \Str::replace($evidenceOld, $evidence->reference, $evidenceFile->file);
                    $evidenceFile->save();
                }
            }
            return redirect()->route('evidence.index', ['search_evidence' => $evidence->id])->with('success', "SUCESSO: Agrupador $evidenceOld alterado para $evidence->reference");
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return back()->with('warning', "ATENÇÃO: Alteração não realizada já existe o agrupador " . $inputs['reference']);
            }
            $message = $th->getMessage();
            return redirect()->route('evidence.index')->with('error', "ERRO: $message");
        }
    }

    public function destroy(Evidence $evidence)
    {
        $nameEvidence = $evidence->reference;
        $evidence->delete();
        $this->deleteAllFiles($nameEvidence);
        return redirect()->route('evidence.index')->with('success', "SUCESSO: Agrupador $nameEvidence excluido");
    }

    public function downloadFiles(Evidence $evidence)
    {
        $evidenceFiles = EvidenceFile::where('evidence_id', $evidence->id)->get();
        if ($evidenceFiles) {
            return $this->downloadAll($evidence->reference);
        }
        return redirect()->back()->with('error', "ERRO: Não existe arquivos para dowload");
    }

    public function carousel(Evidence $evidence,EvidenceFile $evidenceFile)
    {
        $evidenceFiles = EvidenceFile::where('evidence_id', $evidence->id)->orderBy('id', 'DESC')->get();
        return view('evidence.carousel',compact('evidenceFiles','evidenceFile','evidence'));
    }
}
