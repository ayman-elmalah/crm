<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\EmployeesDatatable;
use App\Http\Requests\Admin\Employees\StoreRequest;
use App\Http\Requests\Admin\Employees\UpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    /**
     * Slug
     *
     * @return string
     */
    public $slug = 'employees';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeesDatatable $dataTable)
    {
        $slug = $this->slug;
        $title = __('lang.'.$slug);

        return $dataTable->render('admin.employees.index', compact('slug', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slug = $this->slug;
        $title = __('lang.create') . ' ' . __('lang.'.$slug);
        $companies = Company::get();

        return view('admin.employees.create', compact('slug','title', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Employee::create($request->all());

        return redirect()->back()->with(['success' => __('lang.created_successfully')]);
    }


    /**
     * Edit existing resource in storage.
     *
     * @return response
     */
    public function edit($id) {
        $employee = Employee::find($id);

        if ($employee) {
            $slug = $this->slug;
            $title = __('lang.edit') . ' ' . $employee->first_name . ' ' . $employee->first_name;
            $companies = Company::get();
        }

        return $employee ? view('admin.employees.edit', compact('employee', 'slug', 'title', 'companies')) : redirect()->back()->with(['error' => __('lang.not_found_item')]);
    }

    /**
     * Update existing resource in storage.
     *
     * @return response
     */
    public function update($id, UpdateRequest $request) {
        $employee = Employee::find($id);

        if (! $employee) {
            return redirect()->back()->with(['error' => __('lang.some_thing_went_wrong')]);
        }

        $employee->fill($request->all())->save();

        return redirect()->back()->with(['success' => __('lang.updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (! $employee) {
            return redirect()->back()->with(['error' => __('lang.not_found_item')]);
        }
        $employee->delete();

        return redirect()->back()->with(['success' => __('lang.deleted_successfully')]);
    }

    /**
     * Bulk delete
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request) {
        if (! $request->ids) {
            return redirect()->back()->with(['error' => __('lang.bulk_delete_cant_be_empty')]);
        }

        Employee::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with(['success' => __('lang.deleted_successfully')]);
    }
}
