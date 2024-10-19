<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainFolder;
use App\Models\SubFolder;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class MainFolderController extends Controller
{
    protected $tables = array('main_folder');
    protected MainFolder $mainFolder;
    protected SubFolder $subFolder;
    public function __construct(
        MainFolder $mainFolder,
        SubFolder $subFolder,
    )
    {
        $this->mainFolder = $mainFolder;
        $this->subFolder = $subFolder;
    }

    public function index()
    {
        return view('main-folder.index');
    }

    public function getsubFolderData(Request $request, $main, $id)
    {
        $data['main'] = $this->mainFolder->find($id);
        if($data['main']){
            $data['subFolder'] = $this->subFolder->where('main_folder_id',$id)->get();
            $data['typeFolderLevel'] = "MainFolder";
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        }
        // dd($data);
        return response()->json([
            'status' => 'error',
        ], 400);
    }

    public function createSub(Request $request)
    {
         // Validasi data yang masuk
        $request->validate([
            'nameSub' => 'required|string|max:255',
            'subFolderPic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);
        // dd($request->all());
        // Mulai menyimpan data sub folder
        $subFolder = new $this->subFolder;
        $subFolder->sub_folder_name = $request->nameSub;
        if ($request->typeFolder == "SubFolder") {
            // dd('1');
            $subFolder->main_folder_id = $request->idMainFolder;
            $subFolder->parent_folder = $request->subFolderId;
        } else {
            // dd('2');
            $subFolder->main_folder_id = $request->idMainFolder;
            $subFolder->parent_folder = 0;
        }

        // Jika ada file yang diupload, simpan filenya
        if ($request->hasFile('subFolderPic')) {
            // Simpan file di storage/public/subfolders
            $filePath = $request->file('subFolderPic')->store('subfolders', 'public');
            
            // Simpan URL yang dapat diakses
            $subFolder->sub_folder_image = $filePath; // Menyimpan path file di database
        }

        // Simpan sub folder ke database
        if ($subFolder->save()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'subFolderName' => $subFolder->sub_folder_name,
                    'mainFolderName' => $subFolder->getMain->folder_name,
                    'imageUrl' => Storage::url($subFolder->sub_folder_image), // URL gambar yang bisa diakses
                    $subFolder
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create sub folder.'
            ], 500);
        }
    }
}
