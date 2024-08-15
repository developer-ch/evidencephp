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
    private const QTY_LAST_DAYS = 1;

    public function index(Request $request)
    {
        $searchEvidence = $request->search_evidence ?? null;
        $lastDays = $request->last_days ?? self::QTY_LAST_DAYS;
        $lastDays = !is_numeric($lastDays) || $lastDays < 1 ? self::QTY_LAST_DAYS : $lastDays;

        $operation = $request->operation??"";
        $reference = $request->reference??"";

        $evidence = null;
        $evidences = EvidenceResource::collection(Evidence::latest()->where('reference','like','%'.$operation.'%'.$reference.'%')->where('created_at', '>', now()->subDays($lastDays)->endOfDay())->orderBy('id', 'DESC')->get());
        $searchEvidence = $searchEvidence??$evidences->count() == 1;
        $filesEvidence = [];
        if ($searchEvidence) {
            $evidence = Evidence::find($searchEvidence);
            $filesEvidence = EvidenceFile::where('evidence_id', $searchEvidence)->orderBy('id', 'DESC')->get();
        }
        return view('evidence.index', compact(['evidence', 'evidences', 'searchEvidence', 'filesEvidence','lastDays','operation','reference']));
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
            $message = $th->getMessage();
            if ($th->getCode() == 23000) {
                $message = "Agrupador " . $inputs['reference'] . " Já cadastrado!";
            }
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

    public function carousel(Evidence $evidence, EvidenceFile $evidenceFile)
    {
        $evidenceFiles = EvidenceFile::where('evidence_id', $evidence->id)->orderBy('id', 'DESC')->get();
        return view('evidence.carousel', compact('evidenceFiles', 'evidenceFile', 'evidence'));
    }
}
