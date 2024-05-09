<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

trait FileHandler
{
    private function getDirStorage(string $disk = 'public'): Filesystem
    {
        return Storage::disk($disk);
    }

    public function singleUpload(UploadedFile $file, string $folder): string
    {
        return $this->getDirStorage()->put($folder, $file);
    }

    public function multipleUpload(array $files, string $folder, string $key = "files"): array
    {
        $uploadedFiles = [];
        foreach ($files as $file) {
            $uploadedFiles[] = [$key => $this->singleUpload($file, $folder)];
        }
        return $uploadedFiles;
    }

    public function download(string $directoryName): BinaryFileResponse
    {
        return response()->download($this->getDirStorage()->path($directoryName));
    }

    public function downloadAll(string $directoryName): BinaryFileResponse
    {
        $pack = new ZipArchive;
        $directoryBase = $this->getDirStorage();
        $packName = $directoryName . ".zip";
        if ($pack->open($packName, ZipArchive::CREATE)) {
            $files = $directoryBase->Files($directoryName);
            foreach ($files as $file) {
                $nameFileInPack = basename($file);
                $pack->addFile($directoryBase->path($file), $nameFileInPack);
            }
            $packName = $pack->filename;
            $pack->close();
        }
        return response()->download($packName)->deleteFileAfterSend(true);
    }

    public function deleteFile(string $pathFile): bool
    {
        return $this->getDirStorage()->delete($pathFile);
    }

    public function deleteAllFiles(string $directoryName): bool
    {
        return $this->getDirStorage()->deleteDirectory($directoryName);
    }

    public function renameDir(string $oldDir, string $newDir)
    {
        if (!$this->getDirStorage()->exists($oldDir)) 
            return;
        return rename($this->getDirStorage()->path($oldDir), $this->getDirStorage()->path($newDir));
    }
}
