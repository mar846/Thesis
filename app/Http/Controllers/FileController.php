<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Auth;
use Storage;

use App\File;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
      $this->authorize('delete',$file);
      echo 'deleted';
    }
    public function deleteFile(Request $request)
    {
      if ($request->ajax()) {
        $file = File::find($request['id']);
        $file_path = storage_path("app/public/".$file['type'].'/'.$file['name']);
        // if(File::exists($file_path)) File::delete($file_path);
        // $file = File::find($request['id']);
        // $filename = substr($file['name'], strpos($file['name'],'/')+1);
        if (File::exists($file_path)) {
          Storage::delete($file_path);
          $delete = File::find($request['id'])->delete();
          echo $delete;
        }
        else {
          echo "3456";
        }
        // Storage::delete();
      }
    }
}
