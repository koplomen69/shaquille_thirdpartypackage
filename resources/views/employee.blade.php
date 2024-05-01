<table class="table table-bordered table-hover table-striped mb-0 bg-white">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Position</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->firstname }}</td>
                <td>{{ $employee->lastname }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->position_name }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('employees.show', ['employee' => $employee->employee_id]) }}"
                            class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                        <a href="{{ route('employees.edit', ['employee' => $employee->employee_id]) }}"
                            class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                        <div>
                            <form action="{{ route('employees.destroy', ['employee' => $employee->employee_id]) }}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i
                                        class="bi-trash"></i></button>
                            </form>
                            <div class="col-md-12 mb-3">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="form-select">
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                            {{ old('position') == $position->id ? 'selected' : '' }}>
                                            {{ $position->code .
                                                ' -
                                                                            ' .
                                                $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
