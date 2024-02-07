<?php

namespace App\Http\Controllers;
use App\Models\Userdetails;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $student = Userdetails::all();
        return view('student.index',compact('student'));
        // return response()->json([
        //     'status'=>200,
        //     'student'=>$student,
        //     ]);
    }
    public function store(Request $request){
        
        // $validator = Validator::make($request->all(),[
        //     'name'=>'required|max:191',
        //     'mobile'=>'required|max:191',
        //     'email'=>'required|max:191',
        //     'address'=>'required|max:191',
        //     'gender'=>'required|max:191',

        //     'files.*' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        // if($validator->fails()){
        //     return response()->json([
        //         'status'=>400,
        //         'errors'=>$validator->messages()
        //     ]);
        // }
        // else{
            // if ($request->hasFile('files')) {
            //     $file = $request->file('files');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $file->move(public_path('uploads'), $fileName);
            // }
            $student = new Userdetails;
            $student->name = $request->input('name');
            $student->mobile = $request->input('mobile');
            $student->email = $request->input('email');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            // $student->image = $request->input('image');
            if($image=$request->file('files')){
                $destinationPath='images/';
                $profileImage=date('YmdHis').".".$image->getClientOriginalExtension();
                $image->move($destinationPath,$profileImage);
                $student->image=$profileImage;
            }
            // if($request->hasFile('files')){
            //     $student->image = $fileName;
            // }
            $student->save();
         
            
               

            // return response()->json([
            //         'status'=>200,
            //         'message'=>'User Added Successfully'
            //     ]);
            // return redirect()->back()->with('status','Student Added Successfully');
        // }
       
        return redirect()->back()->with('status','User Details Added Successfully');
    }
    // }
    public function edit($id){
        $student = Userdetails::find($id);
        return response()->json([
            'status'=>200,
            'student'=>$student,
            ]);
    }
    public function update(Request $request){
        $stud_id=$request->input('stud_id');
        $student = Userdetails::find($stud_id);
        $student->name = $request->input('name');
        $student->mobile = $request->input('mobile');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->gender = $request->input('gender');
        if($image=$request->file('files')){
            $destinationPath='images/';
            $profileImage=date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $student->image=$profileImage;
        }
        
        $student->update();
        return redirect()->back()->with('status','User Details Updated Successfully');
    }
    public function destroy(Request $request){
        $stud_id=$request->input('delete_stud_id');
        $student=Userdetails::find($stud_id);
        $student->delete();
        return redirect()->back()->with('status','User Details Deleted Successfully');
    }
}