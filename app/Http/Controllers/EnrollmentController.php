<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $enrollments = Enrollment::query()
            ->with(['student', 'classroom'])
            ->when($q, function ($query) use ($q) {
                $query->whereHas('student', fn ($s) =>
                    $s->where('name', 'ilike', "%{$q}%")
                      ->orWhere('email', 'ilike', "%{$q}%")
                )->orWhereHas('classroom', fn ($c) =>
                    $c->where('name', 'ilike', "%{$q}%")
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $students = Student::orderBy('name')->get(['id', 'name', 'email']);
        $classrooms = Classroom::where('active', true)->orderBy('name')->get(['id', 'name', 'year']);

        return view('app.matriculas.index', compact('enrollments', 'students', 'classrooms', 'q'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'enrolled_at' => ['nullable', 'date'],
            'active' => ['nullable', 'boolean'],
        ]);

        $data['active'] = $request->boolean('active');

        Enrollment::updateOrCreate(
            ['student_id' => $data['student_id'], 'classroom_id' => $data['classroom_id']],
            ['enrolled_at' => $data['enrolled_at'] ?? now()->toDateString(), 'active' => $data['active']]
        );

        return redirect()->route('app.matriculas.index')->with('success', 'Matrícula registrada com sucesso!');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('app.matriculas.index')->with('success', 'Matrícula removida com sucesso!');
    }
}
