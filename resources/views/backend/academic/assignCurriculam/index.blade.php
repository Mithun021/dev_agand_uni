@extends('backend.partial.master')
@section('title', 'Assign Curriculam')
@section('backend-content')

    <div class="row">
        <div class="row">

            {{-- ADD CURRICULAM FORM SECTION (TOP) --}}
            @can('add-curriculam')
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Add Curriculam</h4>
                        </div>

                        <form class="form theme-form" method="post" action="{{ route('assign-curriculams.store') }}">
                            @csrf
                            <div class="card-body">

                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
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

                                    {{-- Semester checkbox (hidden by default) --}}
                                    <div class="col-md-3 form-group mb-3" id="semester_row" style="display: none;">
                                        <label class="form-label">Semester<span class="text-danger">*</span></label>
                                        <div
                                            style="border:1px solid #ccc; padding:10px; border-radius:6px; height:100px; overflow-y:auto;">
                                            @foreach ($semesters as $semester)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="semester_id[]"
                                                        value="{{ $semester->id }}"
                                                        {{ is_array(old('semester_id')) && in_array($semester->id, old('semester_id')) ? 'checked' : '' }}>
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
                                        <div
                                            style="border:1px solid #ccc; padding:10px; border-radius:6px; height:100px; overflow-y:auto;">
                                            @foreach ($annuals as $annual)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="annual_id[]"
                                                        value="{{ $annual->id }}"
                                                        {{ is_array(old('annual_id')) && in_array($annual->id, old('annual_id')) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $annual->year }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('annual_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Session Multi-Select --}}
                                    <div class="col-md-3 form-group mb-3">
                                        <label class="form-label">Session <span class="text-danger">*</span></label>
                                        <div
                                            style="border:1px solid #ccc; padding:10px; border-radius:6px; height:100px; overflow-y:auto;">
                                            @foreach ($sessions as $session)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="session_id[]"
                                                        value="{{ $session->id }}"
                                                        {{ is_array(old('session_id')) && in_array($session->id, old('session_id')) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $session->session }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('session_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Scheme Multi-Select --}}
                                    <div class="col-md-3 form-group mb-3">
                                        <label class="form-label">Scheme <span class="text-danger">*</span></label>
                                        <div
                                            style="border:1px solid #ccc; padding:10px; border-radius:6px; height:100px; overflow-y:auto;">
                                            @foreach ($schemes as $scheme)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="scheme_id[]"
                                                        value="{{ $scheme->id }}"
                                                        {{ is_array(old('scheme_id')) && in_array($scheme->id, old('scheme_id')) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $scheme->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('scheme_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Institute Multi-Select --}}
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Institute <span class="text-danger">*</span></label>

                                    <div
                                        style="border:1px solid #ccc; padding:10px; border-radius:6px; height:220px; overflow-y:auto;">
                                        @foreach ($institutes as $institute)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="institute_id[]"
                                                    value="{{ $institute->id }}"
                                                    {{ is_array(old('institute_id')) && in_array($institute->id, old('institute_id')) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $institute->institute }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('institute_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>





                                <div class="card-footer text-end py-2">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            @endcan



            {{-- BRANCH LIST SECTION (BOTTOM) --}}
            @can('show-curriculam')
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Curriculam List</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Branch</th>
                                            <th>Course Type</th>
                                            <th>Session</th>
                                            <th>Scheme</th>
                                            <th>Institute </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($assignCurriculams as $assign)
                                            <tr>
                                                {{-- Course --}}
                                                <td>{{ $assign->course->course ?? 'N/A' }}</td>

                                                {{-- Branch --}}
                                                <td>{{ $assign->branch->branch_name ?? 'N/A' }}</td>

                                                {{-- Course Type --}}
                                                <td>{{ ucfirst($assign->course_type) }}</td>

                                                {{-- Sessions --}}
                                                <td>

                                                    @php
                                                        $sessions = is_array($assign->session_id)
                                                            ? $assign->session_id
                                                            : json_decode($assign->session_id, true);
                                                    @endphp

                                                    @if (is_array($sessions))
                                                        @foreach ($sessions as $id)
                                                            {{ \App\Models\academic\session\Session::find($id)?->session ?? 'N/A' }}<br>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                {{-- Schemes --}}
                                                <td>

                                                    @php
                                                        $schemes = is_array($assign->scheme_id)
                                                            ? $assign->scheme_id
                                                            : json_decode($assign->scheme_id, true);
                                                    @endphp

                                                    @foreach ($schemes ?? [] as $id)
                                                        {{ \App\Models\academic\scheme\Scheme::find($id)?->name ?? 'N/A' }}<br>
                                                    @endforeach

                                                </td>

                                                {{-- Institutes --}}
                                                <td>
                                                    @php
                                                        $institutes = is_array($assign->institute_id)
                                                            ? $assign->institute_id
                                                            : json_decode($assign->institute_id, true);
                                                    @endphp

                                                    @foreach ($institutes ?? [] as $id)
                                                        {{ \App\Models\academic\institute\Institute::find($id)?->institute ?? 'N/A' }}<br>
                                                    @endforeach

                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <a href="{{ route('assign-curriculams.edit', $assign->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('assign-curriculams.destroy', $assign->id) }}"
                                                        method="POST" style="display:inline-block"
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">
                                                            Delete
                                                        </button>
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


                        document.querySelectorAll('input[name="semester_id[]"]').forEach(cb => cb.checked = false);

                    } else {
                        semesterRow.style.display = 'none';
                        annualRow.style.display = 'none';


                        document.querySelectorAll('input[name="semester_id[]"]').forEach(cb => cb.checked = false);
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
