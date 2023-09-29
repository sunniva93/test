<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\student;

class studentController extends Controller
{
    public function index()
    {
        $students = student::all();
        return view('student', ['students' => $students]);
    }

    public function insert(Request $request)
    {
        $student = new Student;
        $student->stu_name = $request->stu_name;
        $student->age = $request->age;
        $student->grade = $request->grade;
        $student->save();

        return redirect('/students');
    }

    public function delete($id)
    {
        $student = Student::find($id);
        if ($student) {

            $student->delete();
        }

        return redirect('/students');
    }

    public function editForm($id)
    {
        $student = Student::find($id);

        if (!$student) {
            // หากไม่พบรหัสนักศึกษา ให้ redirect หรือทำการจัดการตามที่คุณต้องการ
            return redirect('/students')->with('error', 'Student not found');
        }

        return view('editFormStudents', compact('student'));

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $student = Student::find($id);

        if (!$student) {
            // หากไม่พบรหัสนักศึกษา ให้ redirect 
            return redirect('/students')->with('error', 'Student not found');
        }

        // อัปเดตข้อมูล
        $student->stu_name = $request->input('stu_name');
        $student->age = $request->input('age');
        $student->grade = $request->input('grade');
        $student->save();

        return redirect('/students')->with('success', 'Student updated successfully');
    }
}


