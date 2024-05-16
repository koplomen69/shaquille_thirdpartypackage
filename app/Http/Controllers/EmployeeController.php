<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Employee List';

        confirmDelete();
        $positions = Position::all();
        return view('employee.index', compact('pageTitle', 'positions'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Employee';
        // ELOQUENT
        $positions = Position::all();
        return view('employee.create', compact('pageTitle', 'positions'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Get File
        $file = $request->file('cv');
        if ($file != null) {
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            // Store File
            $file->store('public/files');
        }
        // ELOQUENT
        $employee = new Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        if ($file != null) {
            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }
        $employee->save();

        Alert::success('Added Successfully', 'Employee Data Added Successfully.');
        return redirect()->route('employees.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        $employee = DB::table('employees')
            ->select('employees.*', 'positions.name as position_name', 'employees.id as employee_id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->where('employees.id', $id)
            ->first();

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        $employee = DB::table('employees')
            ->select('employees.*', 'positions.name as position_name', 'employees.id as employee_id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->where('employees.id', $id)
            ->first();

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        Alert::success('Changed Successfully', 'Employee Data Changed Successfully.');


        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // ELOQUENT
        $employee = Employee::find($id);
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();
        return redirect()->route('employees.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT

        Employee::find($id)->delete();

        Alert::success('Deleted Successfully', 'Employee Data Deleted Successfully.');
        return redirect()->route('employees.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function downloadFile($employeeId)
    {
        $employee = Employee::find($employeeId);
        $encryptedFilename = 'public/files/' . $employee->encrypted_filename;
        $downloadFilename =
            Str::lower($employee->firstname . '_' . $employee->lastname . '_cv.pdf');
        if (Storage::exists($encryptedFilename)) {
            return Storage::download($encryptedFilename, $downloadFilename);
        }
    }

    public function deleteFile($employeeId)
    {
        // Temukan data karyawan berdasarkan ID
        $employee = Employee::find($employeeId);

        // Pastikan karyawan ditemukan
        if ($employee) {
            // Buat nama file yang akan dihapus
            $filename = 'public/files/' . $employee->encrypted_filename;

            // Periksa apakah file ada dalam penyimpanan
            if (Storage::exists($filename)) {
                // Hapus file dari penyimpanan
                Storage::delete($filename);

                // Update kolom original_filename menjadi null (opsional, tergantung kebutuhan)
                $employee->original_filename = null;
                $employee->save();

                // Berikan pesan sukses atau tindakan lanjutan sesuai kebutuhan
                return redirect()->back()->with('success', 'File berhasil dihapus.');
            } else {
                // Jika file tidak ditemukan, berikan pesan error atau tindakan lanjutan sesuai kebutuhan
                return redirect()->back()->with('error', 'File tidak ditemukan.');
            }
        } else {
            // Jika karyawan tidak ditemukan, berikan pesan error atau tindakan lanjutan sesuai kebutuhan
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }
        return redirect()->route('employees.index');
    }

    public function getData(Request $request)
    {
        $employees = Employee::with('position');

        if ($request->ajax()) {
            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('actions', function ($employee) {
                    return view('employee.actions', compact('employee'));
                })
                ->toJson();
        }
    }



    public function exportExcel()
    {
        // Fetch employee data from your database
        $employees = Employee::all(); // Assuming you have an Employee model

        // Create a new PhpSpreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Age');
        $sheet->setCellValue('F1', 'Position');

        // Populate data
        $row = 2;
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee->id);
            $sheet->setCellValue('B' . $row, $employee->firstname);
            $sheet->setCellValue('C' . $row, $employee->lastname);
            $sheet->setCellValue('D' . $row, $employee->email);
            $sheet->setCellValue('E' . $row, $employee->age);
            $sheet->setCellValue('F' . $row, $employee->position->name);
            $row++;
        }

        // Create a new Excel writer object
        $writer = new Xlsx($spreadsheet);

        // Set headers to force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="employees.xlsx"');
        header('Cache-Control: max-age=0');

        // Save the Excel file to output
        $writer->save('php://output');
    }


    public function exportPdf()
    {
        $employees = Employee::all();

        $pdf = PDF::loadView('employee.export_pdf', compact('employees'));

        return $pdf->download('employees.pdf');
    }
}
