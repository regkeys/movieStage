<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//(2) Bring in your Model to use that was created - thereby you have access to the DataBase
use \App\Models\Upload;

//(3) Can use regular SQL with DB library
use DB;

//(4) To bring in the Files & Storage library for deleting the image and Directory
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

//bring in the gates to use them
use Gate;


class UploadsController extends Controller
{


    /**   NEW*********************************
     * Create a new controller instance.
     *
     * @return void
     *
     * This protects all the pages below - you can't see any unless you log in -if you do not write any exeptions
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /** **********************************************************************************************
     * (1) INDEX - Display a listing of the resources n the DB on the INDEX page upload
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //Get Info
        $dataUploaded = Upload::orderBy('name', 'asc')->paginate(30);                        //Pagination based on varialbes in database - also add variable + links() function to page = {{$dataUploaded->links()}}  - paginate will not work witn all() function
        //load view
        return view('uploading.index')->with('dataUploaded', $dataUploaded);           //Note reference to variable 2x's

    }



    /** **********************************************************************************************
     * (3) CREATE - the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Direct to create page     ***make internal***
        return view('uploading.create');
    }



    /** **********************************************************************************************
     * (4) STORE - a newly created resource in storage.
     * Remember: VERY IMPORTANT TO CREATE SYMLINK WITH ARTISAN COMMAND BELLOW:
     * php artisan storage:link
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'length' => 'required',
            'start' => 'required',
            'description' => 'required',
            'tickets' => 'required',
            'rating' => '',
            'poster' => 'image|nullable|max:1999'
        ]);

        $name = $request->name;               // name to store from input

        //$imagePaths = mkdir('poster-files/'.$name, 0777);      //make the directory

        // ###################  1. file upload  - poster
        if($request->hasFile('poster')){
            $extension = $request->file('poster')->getClientOriginalExtension();                 //get just file extention
            $fileNameToStore = "poster"."-".time().".".$extension;                                   //new fileName
            $request->poster->storeAs('public/poster-files/'.$name, $fileNameToStore);            //upload image - give directory to store the image
        }
        else{
            $fileNameToStore = '';
        }

        //get current date
        $date=@now();
        $dateNow = date_format($date,"Y-m-d H:i:s");


        //Create Upload submit - move all info to the database
        $upload = new Upload;
        $upload->name = $request->input('name');
        $upload->title = $request->input('title');
        $upload->length = $request->input('length');
        $upload->start = $request->input('start');
        $upload->description = $request->input('description');
        $upload->tickets = $request->input('tickets');
        $upload->rating = $request->input('rating');
        $upload->poster = $fileNameToStore;
        $upload->created_at = $dateNow;
        $upload->updated_at = $dateNow;
        $upload->user_id = auth()->user()->id;   //get the user id an put in this field when creating a new upload
        $upload->save();

        //redirect on success
        return redirect('/DASHBOARD')->with('success', 'Thank You for building a movie package');
    }



    /** **********************************************************************************************
     * (2) SHOW -Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find all the info by ID from Model   - if id does not exist =  findorFail($id);
        $findInfo = Upload::findorFail($id);
        //load view
        return view('uploading.show')->with('findInfo', $findInfo);
    }



    /** **********************************************************************************************
     * (5) EDIT the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find all the info by ID from Model   - if id does not exist =  findorFail($id);
        // Same as SHOW
        $findInfo = Upload::findorFail($id);

        //check User

        //load view
        return view('uploading.edit')->with('findInfo', $findInfo);
    }




    /** **********************************************************************************************
     * (6) UPDATE -  the specified resource in storage.
     *   Copy everything from stor and change from new upload to Find ID
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request, [
           // 'name' => '',
            'title' => '',
            'length' => '',
            'start' => '',
            'description' => '',
            'tickets' => '',
            'rating' => '',
            'poster' => 'image|nullable|max:1999'
        ]);

        //find the name of the folder
        $findInfo = Upload::findorFail($id);
        $name = $findInfo->name;

        // ###################  1. file upload  - poster
        if($request->hasFile('poster')){
            $extension = $request->file('poster')->getClientOriginalExtension();                //get just file extention
            $fileNameToStore = "poster"."-".time().".".$extension;                                  //new fileName
            $request->poster->storeAs('public/poster-files/'.$name, $fileNameToStore);
        }
        else{
            $fileNameToStore = '';
        }

        //get current date
        $date=@now();
        $dateNow = date_format($date,"Y-m-d H:i:s");

        //Create Upload movie submit - move all info to the database
        $upload = Upload::find($id);
       // $upload->name = $request->input('name');
        $upload->title = $request->input('title');
        $upload->length = $request->input('length');
        $upload->start = $request->input('start');
        $upload->description = $request->input('description');
        $upload->tickets = $request->input('tickets');
        $upload->rating = $request->input('rating');
        $upload->poster = $fileNameToStore;
        $upload->created_at = $dateNow;
        $upload->updated_at = $dateNow;
        $upload->user_id = auth()->user()->id;   //get the user id an put in this field
        //test if image exist
        if($request->hasFile('poster')){
            $upload->poster = $fileNameToStore;
        }
        //$upload->updated_at = $dateUpdate;
        $upload->save();

        //redirect on success
        return redirect('/DASHBOARD')->with('success', 'Your movie has been Updated - Thank You');
    }




    /** **********************************************************************************************
     * (7) DESTROY - Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //use the GATE - can use denies or allows
       /* if(Gate::denies('delete-users')){
            return  redirect(route('admin.users.index'))->with('error', 'You do not have authorization to DELETE');
        }*/


        //find user info with the ID
        $findInfo = Upload::find($id);

        //get path to files
        $pathName = $findInfo->name;

        $folderPath = 'public/poster-files/'.$pathName;
        //dd($folderPath);

        //Delete folder and all files inside with this command - will destroy other images also
        //Storage::deleteDirectory($folderPath);

        //Delete Client object in the database
        $findInfo->delete();


        //redirect on success
        return redirect('/DASHBOARD')->with('success', 'Movie Information has been Deleted - Thank You');
    }

}
