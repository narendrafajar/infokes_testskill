<?php

namespace App\Http\Controllers;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use App\Models\MainFolder;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class SubFolderController extends Controller
{
    protected $tables = array('sub_folder');
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sub-folders.index');
    }

    public function getNextsubFolderData(Request $request, $main, $id)
    {
        $data['main'] = $this->subFolder->find($id);
        // dd($data);
        if($data['main']){
            $data['subFolder'] = $this->subFolder->where('parent_folder',$data['main']->id)->get();
            $data['mainFolderName'] = $data['main']->getMain->folder_name;
            $data['typeFolderLevel'] = "SubFolder";
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubFolder $subFolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubFolder $subFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubFolder $subFolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubFolder $subFolder)
    {
        //
    }
}
