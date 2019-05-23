<?php

namespace App\DataTables\Admin;

use App\Models\Company;
use Yajra\DataTables\Services\DataTable;

class CompaniesDatatable extends DataTable
{
    /**
     * Custom page to print
     *
     * @var string
     */
    protected $printPreview = 'admin.layouts.datatable.print';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query = Company::withCount('employees')->get();
        foreach($query as $q) {
            $q->logo = $q->logo != null ? uploded_file('companies', $q->logo) : null;
        }

        return datatables($query)
            ->escapeColumns([])
            ->addColumn('id', function ($q) {
                return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" name="ids[]" class="checkboxes checkbox" value="'.$q->id.'" form="bulk_delete_modal"/><span></span></label>';
            })
            ->addColumn('employees_count', function ($q) {
                return $q->employees_count;
            })
            ->addColumn('logo', function ($q) {
                return $q->logo != null ? '<img src="'.$q->logo.'" class="thumb-image">' : '-';
            })
            ->addColumn('created_at', function ($q) {
                return '<span class="ltr-direction block text-right">'.$q->created_at.'</span>';
            })
            ->addColumn('actions', function ($q) {
                $return = '<div class="btn-group">'.
                    '<button class="btn btn-xs btn-actions dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">'. __('lang.actions') . '<i class="fa fa-angle-down"></i></button>'.
                    '<ul class="dropdown-menu" role="menu">'.
                    '<li><a href="'. route('companies.edit', $q->id) .'"><i class="fa fa-edit fa-fw"></i>'. ' '  . __('lang.edit') .'</a></li>'.
                    '<li><a href="#" class="delete_confirmation" data-toggle="modal" data-target="#deleteModal" data-action="'. route('companies.destroy', $q->id) .'"><i class="fa fa-trash fa-fw"></i>'. ' ' . __('lang.delete') .'</a></li>'.
                    '</ul>'.
                    '</div>';
                return $return;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
    {
        return $model->newQuery()->select();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'          => 'Blfrtip',
                'lengthMenu'   => [[10, 25, 50, -1], [10, 25, 50, __('lang.all_records')]],
                'buttons'      => [
                    ['extend' => 'reload', 'className' => 'btn btn-danger btn-reload', 'text' => __('lang.reload')],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-print', 'text' => __('lang.print'), 'autoPrint' => true],
                    ['extend' => 'excel', 'className' => 'btn btn-success btn-excel', 'text' => __('lang.excel')],
                ],
                'initComplete' => "function () {
                                    this.api().columns([1, 3, 4, 5, 6]).every(function () {
                                        var column = this;
                                        var input = document.createElement(\"input\");
                                        $(input).appendTo($(column.footer()).empty())
                                        .on('blur', function () {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    });
                                }",
                'language' => [
                    'url' => url('datatable/'.config('app.locale').'/datatable.json'),
                ],
                'order' => [
                    0, 'desc'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" id="check_all"/><span></span></label>', 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => __('lang.name')],
            ['name' => 'logo', 'data' => 'logo', 'title' => __('lang.logo')],
            ['name' => 'email', 'data' => 'email', 'title' => __('lang.email')],
            ['name' => 'website', 'data' => 'website', 'title' => __('lang.website')],
            ['name' => 'employees_count', 'data' => 'employees_count', 'title' => __('lang.employees_count')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => __('lang.created_at')],
            ['name' => 'actions', 'data' => 'actions', 'title' => __('lang.actions'), 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Companies_' . date('YmdHis');
    }
}
