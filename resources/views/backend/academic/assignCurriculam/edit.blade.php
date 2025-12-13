@extends('backend.partial.master')
@section('title', 'Edit Curriculam')
@section('backend-content')

@php
    // Normalize JSON → array (CRITICAL)
    $sessionIds   = is_array($assignCurriculam->session_id)   ? $assignCurriculam->session_id   : json_decode($assignCurriculam->session_id, true)   ?? [];
    $schemeIds    = is_array($assignCurriculam->scheme_id)    ? $assignCurriculam->scheme_id    : json_decode($assignCurriculam->scheme_id, true)    ?? [];
    $instituteIds = is_array($assignCurriculam->institute_id) ? $assignCurriculam->institute_id : json_decode($assignCurriculam->institute_id, true) ?? [];
    $semesterIds  = is_array($assignCurriculam->semester_id)  ? $assignCurriculam->semester_id  : json_decode($assignCurriculam->semester_id, true)  ?? [];
    $annualIds    = is_array($assignCurriculam->annual_id)    ? $assignCurriculam->annual_id    : json_decode($assignCurriculam->annual_id, true)    ?? [];
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-header pb-0">
                <h4>Edit Curriculam</h4>
            </div>

            <form method="POST"
                  action="{{ route('assign-curriculams.update', $assignCurriculam->id) }}"
                  class="form theme-form">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Course --}}
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-control" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $assignCurriculam->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->course }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Branch --}}
                    <div class="mb-3">
                        <label class="form-label">Branch</label>
                        <select name="branch_id" class="form-control" required>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $assignCurriculam->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Course Type --}}
                    <div class="mb-3">
                        <label class="form-label">Course Type</label>
                        <select name="course_type" id="course_type" class="form-control" required>
                            <option value="semester" {{ $assignCurriculam->course_type === 'semester' ? 'selected' : '' }}>
                                Semester
                            </option>
                            <option value="annual" {{ $assignCurriculam->course_type === 'annual' ? 'selected' : '' }}>
                                Annual
                            </option>
                        </select>
                    </div>

                    {{-- Semester --}}
                    <div class="mb-3" id="semester_row">
                        <label class="form-label">Semester</label>
                        <div style="border:1px solid #ccc;padding:10px;height:120px;overflow-y:auto;">
                            @foreach ($semesters as $semester)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="semester_id[]"
                                           value="{{ $semester->id }}"
                                           {{ in_array($semester->id, $semesterIds) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $semester->semester }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Annual --}}
                    <div class="mb-3" id="annual_row">
                        <label class="form-label">Annual</label>
                        <div style="border:1px solid #ccc;padding:10px;height:120px;overflow-y:auto;">
                            @foreach ($annuals as $annual)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="annual_id[]"
                                           value="{{ $annual->id }}"
                                           {{ in_array($annual->id, $annualIds) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $annual->year }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sessions --}}
                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <div style="border:1px solid #ccc;padding:10px;height:120px;overflow-y:auto;">
                            @foreach ($sessions as $session)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="session_id[]"
                                           value="{{ $session->id }}"
                                           {{ in_array($session->id, $sessionIds) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $session->session }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Schemes --}}
                    <div class="mb-3">
                        <label class="form-label">Scheme</label>
                        <div style="border:1px solid #ccc;padding:10px;height:120px;overflow-y:auto;">
                            @foreach ($schemes as $scheme)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="scheme_id[]"
                                           value="{{ $scheme->id }}"
                                           {{ in_array($scheme->id, $schemeIds) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $scheme->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Institutes --}}
                    <div class="mb-3">
                        <label class="form-label">Institute</label>
                        <div style="border:1px solid #ccc;padding:10px;height:200px;overflow-y:auto;">
                            @foreach ($institutes as $institute)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="institute_id[]"
                                           value="{{ $institute->id }}"
                                           {{ in_array($institute->id, $instituteIds) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $institute->institute }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('assign-curriculams.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Toggle Semester / Annual --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const courseType = document.getElementById('course_type');
    const semesterRow = document.getElementById('semester_row');
    const annualRow = document.getElementById('annual_row');

    function toggle() {
        if (courseType.value === 'semester') {
            semesterRow.style.display = 'block';
            annualRow.style.display = 'none';
        } else {
            semesterRow.style.display = 'none';
            annualRow.style.display = 'block';
        }
    }

    toggle();
    courseType.addEventListener('change', toggle);
});
</script>

@endsection
