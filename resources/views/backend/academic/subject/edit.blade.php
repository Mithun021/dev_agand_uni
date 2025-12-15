@extends('backend.partial.master')
@section('title', 'Edit Subject')
@section('backend-content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header pb-0">
                <h4>Edit Subject</h4>
            </div>

            <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Course --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Course <span class="text-danger">*</span></label>
                            <select name="course_id" id="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $subject->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->course }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Branch --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" id="branch-dropdown" class="form-control">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $subject->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Course Type --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Course Type <span class="text-danger">*</span></label>
                            <select name="course_type" id="course_type" class="form-control" required>
                                <option value="semester" {{ $subject->course_type == 'semester' ? 'selected' : '' }}>
                                    Semester
                                </option>
                                <option value="annual" {{ $subject->course_type == 'annual' ? 'selected' : '' }}>
                                    Annual
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Semester --}}
                    <div class="row">
                        <div class="col-md-3 mb-3" id="semester_row">
                            <label class="form-label">Semester</label>
                            <div style="border:1px solid #ccc; padding:10px; height:150px; overflow-y:auto;">
                                @foreach($semesters as $semester)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input"
                                            name="semester_id"
                                            value="{{ $semester->id }}"
                                            {{ $subject->semester_id == $semester->id ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $semester->semester }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Annual --}}
                        <div class="col-md-3 mb-3" id="annual_row">
                            <label class="form-label">Annual</label>
                            <select name="annual_id" class="form-control">
                                <option value="">Select Annual</option>
                                @foreach($annuals as $annual)
                                    <option value="{{ $annual->id }}"
                                        {{ $subject->annual_id == $annual->id ? 'selected' : '' }}>
                                        {{ $annual->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Session --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Session <span class="text-danger">*</span></label>
                            <div style="border:1px solid #ccc; padding:10px; height:150px; overflow-y:auto;">
                                @foreach($sessions as $session)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input"
                                            name="session_id"
                                            value="{{ $session->id }}"
                                            {{ $subject->session_id == $session->id ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $session->session }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Scheme --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Scheme <span class="text-danger">*</span></label>
                            <div style="border:1px solid #ccc; padding:10px; height:150px; overflow-y:auto;">
                                @foreach($schemes as $scheme)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input"
                                            name="scheme_id"
                                            value="{{ $scheme->id }}"
                                            {{ $subject->scheme_id == $scheme->id ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $scheme->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Subject Details --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subject Name</label>
                            <input type="text" name="subject_name" class="form-control"
                                   value="{{ $subject->subject_name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subject Code</label>
                            <input type="text" name="subject_code" class="form-control"
                                   value="{{ $subject->subject_code }}" required>
                        </div>
                    </div>

                    {{-- Theory / Practical --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type</label>
                            <div style="border:1px solid #ccc; padding:10px;">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        name="subject_type" value="theory"
                                        {{ $subject->subject_type == 'theory' ? 'checked' : '' }}>
                                    <label class="form-check-label">Theory</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        name="subject_type" value="practical"
                                        {{ $subject->subject_type == 'practical' ? 'checked' : '' }}>
                                    <label class="form-check-label">Practical</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Marks --}}
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Credit</label>
                            <input type="number" name="credit" class="form-control" value="{{ $subject->credit }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Internal Marks</label>
                            <input type="number" name="internal_marks" class="form-control"
                                   value="{{ $subject->internal_marks }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">External Marks</label>
                            <input type="number" name="external_marks" class="form-control"
                                   value="{{ $subject->external_marks }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" class="form-control" value="{{ $subject->total }}">
                        </div>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Toggle semester / annual --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const type = document.getElementById('course_type');
    const semester = document.getElementById('semester_row');
    const annual = document.getElementById('annual_row');

    function toggle() {
        if (type.value === 'semester') {
            semester.style.display = 'block';
            annual.style.display = 'none';
        } else {
            semester.style.display = 'none';
            annual.style.display = 'block';
        }
    }

    toggle();
    type.addEventListener('change', toggle);
});
</script>

@endsection
