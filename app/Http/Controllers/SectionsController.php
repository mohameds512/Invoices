<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections' , compact('sections'));
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
        $request->validate([
            'section_name'=>'required|unique:sections|max:255',
            'description'=>'required',
        ],[
            'section_name.required'=>'اسم القسم مطلوب',
            'section_name.unique'=>'القسم موجود بالفعل',
            'description.required'=>'الوصف مطلوب',
        ]
    );


        $input = $request->all();


        $sec_name = sections::where('section_name','=', $input['section_name'] )->exists();

        if($sec_name){
            session()->flash('Error','القسم موجود بالفعل');
            return redirect('/sections');
        }else{
            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
            ]);

            session()->flash('Add','تم أضافة القسم');

            return redirect('/sections');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sections $sections)
    {
        $id = $request->section_id;

        $this->validate( $request ,[
            'section_name'=>'required|max:255|unique:sections,section_name,'.$id,
            'section_description'=>'required',
            ],
            [
                'section_name.required'=>'اسم القسم مطلوب',
                'section_name.unique'=>'القسم موجود بالفعل',
                'section_description.required'=>'الوصف مطلوب',
            ]
        );


        $section = sections::find($id);
        $section->update([
            'section_name'=> $request->section_name,
            'description'=> $request->section_description,
        ]);
        session()->flash('edit', 'تم التعديل بنجاح');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->section_id;
        $section = sections::find($id)->delete();
        session()->flash('delete','تم الحذف بنجاح');
        return redirect('sections');
    }
}
