@extends('backend.partial.master')
@section('title', 'Assign Subject')
@section('backend-content')

    <div class="row">
        <div class="row">

            {{-- ADD SUBJECT FORM SECTION (TOP) --}}
            @can('add-curriculam')
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Add Subject</h4>
                        </div>

                        <form class="form theme-form" method="post" action="{{ route('subjects.store') }}">
                            @csrf
                            <div class="card-body">

                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                 @if (session('error'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                 @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @endif
                                <div class="row">
                                    {{-- Select Course --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Course<span class="text-danger">*</span></label>
                                            <select name="course_id" id="course_id"
                                                class="form-control @error('course_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->course }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('course_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Branch Name --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Branch Name (If no branch, select blank)</label>
                                            <select name="branch_id" id="branch-dropdown"
                                                class="form-control @error('branch_id') is-invalid @enderror">
                                                <option value="">Select Branch</option>
                                                {{-- Options will be filled dynamically --}}
                                            </select>
                                            <span class="text-danger">
                                                @error('branch_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>



                                    {{-- Course Type --}}
                                    <div class="col-md-4">
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Course Type (Semester/Annual)<span
                                                    class="text-danger">*</span></label>
                                            <select name="course_type" id="course_type"
                                                class="form-control @error('course_type') is-invalid @enderror" required>
                                                <option value="" disabled {{ old('course_type') ? '' : 'selected' }}>
                                                    Select Course
                                                    Type</option>
                                                <option value="semester"
                                                    {{ old('course_type') == 'semester' ? 'selected' : '' }}>
                                                    Semester based exam</option>
                                                <option value="annual" {{ old('course_type') == 'annual' ? 'selected' : '' }}>
                                                    Annual (yearly) based exam
                                                </option>
                                            </select>
                                            @error('course_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    {{-- Semester dropdown (hidden by default) --}}
                                    <div class="col-md-3 form-group mb-3" id="semester_row" style="display: none;">
                                        <label class="form-label">Semester<span class="text-danger">*</span></label>
                                        <div style="border:1px solid #ccc; padding:10px; border-radius:6px; height:150px; overflow-y:auto;">
                                            @foreach ($semesters as $semester)
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="semester_id" value="{{ $semester->id }}" 
                                                        {{ old('semester_id') == $semester->id ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $semester->semester }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('semester_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- Annual dropdown --}}
                                    <div class="col-md-3 form-group mb-3" id="annual_row" style="display: none;">
                                        <label class="form-label">Annual<span class="text-danger">*</span></label>
                                        <select name="annual_id" id="annual_id" class="form-control @error('annual_id') is-invalid @enderror">
                                            <option value="">Select Annual</option>
                                            @foreach ($annuals as $annual)
                                                <option value="{{ $annual->id }}" {{ old('annual_id') == $annual->id ? 'selected' : '' }}>
                                                    {{ $annual->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('annual_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Session Dropdown --}}
                                    <div class="col-md-3 form-group mb-3">
                                        <label class="form-label">Session <span class="text-danger">*</span></label>
                                        <div style="border:1px solid #ccc; padding:10px; border-radius:6px; height:150px; overflow-y:auto;">
                                            @foreach ($sessions as $session)
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="session_id" value="{{ $session->id }}" 
                                                        {{ old('session_id') == $session->id ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $session->session }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('session_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Scheme Dropdown --}}
                                    <div class="col-md-3 form-group mb-3">
                                        <label class="form-label">Scheme <span class="text-danger">*</span></label>
                                        <div style="border:1px solid #ccc; padding:10px; border-radius:6px; height:150px; overflow-y:auto;">
                                            @foreach ($schemes as $scheme)
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="scheme_id" value="{{ $scheme->id }}" 
                                                        {{ old('scheme_id') == $scheme->id ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $scheme->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('scheme_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                               

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Subject Name<span class="text-danger">*</span></label>
                                            <input type="text" name="subject_name" class="form-control @error('subject_name') is-invalid @enderror" 
                                                value="{{ old('subject_name') }}" placeholder="Enter Subject Name" required>
                                            @error('subject_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Theory/Practical --}}
                                    <div class="row">
                                        {{-- Theory/Practical --}}
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Type (Theory/Practical)<span class="text-danger">*</span></label>
                                                <div style="border:1px solid #ccc; padding:10px; border-radius:6px;">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="subject_type" id="theory" value="theory" 
                                                            {{ old('subject_type') == 'theory' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="theory">Theory</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="subject_type" id="practical" value="practical" 
                                                            {{ old('subject_type') == 'practical' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="practical">Practical</label>
                                                    </div>
                                                </div>
                                                @error('subject_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Subject Code<span class="text-danger">*</span></label>
                                                <input type="text" name="subject_code" class="form-control @error('subject_code') is-invalid @enderror" 
                                                    value="{{ old('subject_code') }}" placeholder="Enter Subject Code" required>
                                                @error('subject_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Credit<span class="text-danger">*</span></label>
                                                <input type="number" name="credit" class="form-control @error('credit') is-invalid @enderror" 
                                                    value="{{ old('credit') }}" placeholder="Enter Credit" required>
                                                @error('credit')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Internal Marks<span class="text-danger">*</span></label>
                                                <input type="number" name="internal_marks" class="form-control @error('internal_marks') is-invalid @enderror" 
                                                    value="{{ old('internal_marks') }}" placeholder="Enter Internal Marks" required>
                                                @error('internal_marks')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">External Marks<span class="text-danger">*</span></label>
                                                <input type="number" name="external_marks" class="form-control @error('external_marks') is-invalid @enderror" 
                                                    value="{{ old('external_marks') }}" placeholder="Enter External Marks" required>
                                                @error('external_marks')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Total<span class="text-danger">*</span></label>
                                                <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" 
                                                    value="{{ old('total') }}" placeholder="Enter Total" required>
                                                @error('total')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                <div class="card-footer text-end py-2">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            @endcan



            {{-- SUBJECT LIST SECTION (BOTTOM) --}}
            @can('show-subject')
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Subject List</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Branch</th>
                                            <th>Course Type</th>
                                            <th>Session</th>
                                            <th>Scheme</th>
                                            <th>Subject Name </th>
                                            <th>Type</th>
                                            <th>Subject Code</th>
                                            <th>Credit</th>
                                            <th>Internal Marks</th>
                                            <th>External Marks</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                   <tbody>
@foreach ($subjects as $subject)
<tr>
    <td>{{ $subject->course->course ?? 'N/A' }}</td>
    <td>{{ $subject->branch->branch_name ?? 'N/A' }}</td>
    <td>{{ ucfirst($subject->course_type) }}</td>
    <td>{{ $subject->session->session ?? 'N/A' }}</td>
    <td>{{ $subject->scheme->name ?? 'N/A' }}</td>
    <td>{{ $subject->subject_name }}</td>
    <td>{{ ucfirst($subject->subject_type) }}</td>
    <td>{{ $subject->subject_code }}</td>
    <td>{{ $subject->credit }}</td>
    <td>{{ $subject->internal_marks }}</td>
    <td>{{ $subject->external_marks }}</td>
    <td>{{ $subject->total }}</td>

    <td>
        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-primary">
            Edit
        </a>

        <form action="{{ route('subjects.destroy', $subject->id) }}"
              method="POST"
              style="display:inline-block"
              onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>



                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            @endcan

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const courseType = document.getElementById('course_type');
                const semesterRow = document.getElementById('semester_row');
                const annualRow = document.getElementById('annual_row');

                function toggleFields() {
                    console.log("Selected:", courseType.value);

                    if (courseType.value === 'semester') {
                        semesterRow.style.display = 'block';
                        annualRow.style.display = 'none';


                        const annualSelect = document.querySelector('select[name="annual_id"]');
                        if (annualSelect) annualSelect.value = "";

                    } else if (courseType.value === 'annual') {
                        semesterRow.style.display = 'none';
                        annualRow.style.display = 'block';


                        document.querySelectorAll('input[name="semester_id"]').forEach(cb => cb.checked = false);

                    } else {
                        semesterRow.style.display = 'none';
                        annualRow.style.display = 'none';


                        document.querySelectorAll('input[name="semester_id"]').forEach(cb => cb.checked = false);
                        const annualSelect = document.querySelector('select[name="annual_id"]');
                        if (annualSelect) annualSelect.value = "";
                    }
                }

                toggleFields();
                courseType.addEventListener('change', toggleFields);
            });
        </script>


        <script>
            const getBranchesUrl = "{{ route('assign-curriculam.getBranches', ':course_id') }}";
            document.addEventListener('DOMContentLoaded', function() {
                let courseSelect = document.getElementById('course_id');
                let branchSelect = document.getElementById('branch-dropdown');

                courseSelect.addEventListener('change', function() {
                    let courseId = this.value;
                    console.log("Selected Course ID:", courseId);
                    if (courseId === '') {
                        branchSelect.innerHTML = '<option value="">Select Branch</option>';
                        return;
                    }

                    let url = getBranchesUrl.replace(':course_id', courseId);

                    fetch(url)


                        .then(response => response.json())
                        .then(data => {
                            branchSelect.innerHTML = '<option value="">Select Branch</option>';
                            data.forEach(branch => {
                                let option = document.createElement('option');
                                option.value = branch.id;
                                option.textContent = branch.branch_name;
                                branchSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching branches:', error);
                            branchSelect.innerHTML = '<option value="">Error loading branches</option>';
                        });
                });
            });
        </script>

    @endsection
