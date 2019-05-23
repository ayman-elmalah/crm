<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CompaniesDatatable;
use App\Http\Requests\Admin\Companies\StoreRequest;
use App\Http\Requests\Admin\Companies\UpdateRequest;
use App\Mail\Company\SendWelcomeMessage;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CompaniesController extends Controller
{
    /**
     * Slug
     *
     * @return string
     */
    public $slug = 'companies';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompaniesDatatable $dataTable)
    {
        $slug = $this->slug;
        $title = __('lang.'.$slug);

        return $dataTable->render('admin.companies.index', compact('slug', 'title'));
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

        return view('admin.companies.create', compact('slug','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->hasFile('logo') ? array_merge($request->all(), ['logo' => upload_file('companies', $request->logo)]) : $request->all();
        Company::create($data);

        if ($request->email != null) {
            Mail::to($request->email)->send(new SendWelcomeMessage());
        }

        return redirect()->back()->with(['success' => __('lang.created_successfully')]);
    }


    /**
     * Edit existing resource in storage.
     *
     * @return response
     */
    public function edit($id) {
        $company = Company::find($id);

        if ($company) {
            $slug = $this->slug;
            $title = __('lang.edit') . ' ' . $company->name;
            $company->logo = $company->logo != null ? uploded_file('companies', $company->logo) : null;
        }

        return $company ? view('admin.companies.edit', compact('company', 'slug', 'title')) : redirect()->back()->with(['error' => __('lang.not_found_item')]);
    }

    /**
     * Update existing resource in storage.
     *
     * @return response
     */
    public function update($id, UpdateRequest $request) {
        $company = Company::find($id);

        if (! $company) {
            return redirect()->back()->with(['error' => __('lang.some_thing_went_wrong')]);
        }

        $data = $request->hasFile('logo') ? array_merge($request->all(), ['logo' => upload_file('companies', $request->logo)]) : $request->all();
        $company->fill($data)->save();

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
        $company = Company::find($id);

        if (! $company) {
            return redirect()->back()->with(['error' => __('lang.not_found_item')]);
        }
        $company->delete();

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

        Company::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with(['success' => __('lang.deleted_successfully')]);
    }
}
