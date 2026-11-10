<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();

    //     return view('students.index', compact('students'));
    // }

    // public function index()
    // {
    //     $students = Student::latest()->paginate(10);

    //     return view('students.index', compact('students'));
    // }

    public function index()
    {
        $search = request('search');
        $gender = request('gender');
        $status = request('status');

        // Search and filters
        $students = Student::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($gender, function ($query) use ($gender) {
                $query->where('gender', $gender);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Dashboard cards
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'Active')->count();
        $inactiveStudents = Student::where('status', 'Inactive')->count();

        // Gender chart data
        $genderStats = Student::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total', 'gender');

        // Monthly registration chart data
        $monthlyStats = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthLabels = [];
        $monthData = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthLabels[] = date('M', mktime(0, 0, 0, $month, 1));
            $monthData[] = $monthlyStats[$month] ?? 0;
        }

        // Recent students
        $recentStudents = Student::latest()->take(5)->get();

        return view('students.index', compact(
            'students',
            'totalStudents',
            'activeStudents',
            'inactiveStudents',
            'genderStats',
            'monthLabels',
            'monthData',
            'recentStudents'
        ));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable|in:Male,Female,Other',
            'status' => 'required|in:Active,Inactive',
        ]);

       
        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully!');

        
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable|in:Male,Female,Other',
            'status' => 'required|in:Active,Inactive',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'status' => $request->status,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }

        public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function dashboard()
{
    $totalStudents = Student::count();

    $activeStudents = Student::where('status', 'Active')->count();

    $inactiveStudents = Student::where('status', 'Inactive')->count();

    $genderStats = Student::selectRaw('gender, COUNT(*) as total')
        ->groupBy('gender')
        ->pluck('total', 'gender');

    $monthlyStats = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->pluck('total', 'month');

    $monthLabels = [];
    $monthData = [];

    for ($month = 1; $month <= 12; $month++) {
        $monthLabels[] = date('M', mktime(0, 0, 0, $month, 1));
        $monthData[] = $monthlyStats[$month] ?? 0;
    }

    $recentStudents = Student::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalStudents',
        'activeStudents',
        'inactiveStudents',
        'genderStats',
        'monthLabels',
        'monthData',
        'recentStudents'
    ));
}
}