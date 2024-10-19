<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainFolder;
use App\Models\SubFolder;

class DashboardController extends Controller
{
    protected $tables = array('main_folder');
    protected MainFolder $mainFolder;
    public function __construct(
        MainFolder $mainFolder,
        SubFolder $subfolder,
    )
    {
        $this->mainFolder = $mainFolder;
        $this->subFolder = $subfolder;
    }

    public function index(Request $request)
    {
        $data['main'] = $this->mainFolder->get();
        foreach ($data['main'] as $key => $value) {
            $data['main'][$key]->folderSub = $this->subFolder->where('main_folder_id',$value->id)->get();
        }
        // dd($data);
        if($data['main']){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'error',
        ], 400);
    }

    public function create(Request $request)
    {
        // Menyimpan nama folder dari request yg dikirim dari API
        $createFolder = New $this->mainFolder;
        $createFolder->folder_name = $request->nameFolder;
        $createFolder->save();

        $data['main'] = $this->mainFolder->get();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
    }

    public function saveLink(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:main_folder,id',
            'linkFolder' => 'required|string|max:255'
        ]);
        // dd($request->all());
        // update Link untuk Main folder / folder utama
        $updateMainFolder = $this->mainFolder->where('id',$request->id)->update([
            'link_sub_folder' => $request->linkFolder
        ]);
        if($updateMainFolder){
            $data['main'] = $this->mainFolder->get();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
}
