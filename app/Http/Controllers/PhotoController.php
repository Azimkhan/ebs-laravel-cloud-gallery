<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Input;
use Storage;

class PhotoController extends Controller
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
        $albumId = Input::get('album_id');
        $choices = \DB::table('albums')->lists('name', 'id');
        return response()->view('photo.create', ['choices' => $choices, 'albumId' => $albumId]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'description' => 'max:255',
                'picture' => 'required|mimes:jpeg,png'
            ]);
        } catch (\Exception $e) {
            return redirect()->back();
        }


        $uploadedFile = Input::file('picture');

        $destinationPath = 'photos'; // upload path
        $extension = $uploadedFile->guessExtension();
        $fileName = uniqid().'.'.$extension;
        $fullPath = $destinationPath . DIRECTORY_SEPARATOR . $fileName;
        Storage::disk('s3')->put($fullPath, file_get_contents($uploadedFile->getRealPath()));

        $photo = new Photo;
        if (($description = Input::get('description'))) {
            $photo->description = $description;
        }
        $photo->mime = $uploadedFile->getClientMimeType();
        $photo->filename = $fullPath;
        $photo->album_id = Input::get('album_id');
        $photo->save();

        return redirect()->route('album.show', [$photo->album_id]);

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        $content = Storage::disk('s3')->get($photo->filename);


        return (new Response($content, 200))
        ->header('Content-Type', $photo->mime);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
