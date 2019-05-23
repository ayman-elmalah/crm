<?php

namespace App\DataTables\Admin;

use App\Models\Employee;
use App\User;
use Yajra\DataTables\Services\DataTable;

class EmployeesDatatable extends DataTable
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
        $query = Employee::with('company')->get();

        return datatables($query)
            ->escapeColumns([])
            ->addColumn('id', function ($q) {
                return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" name="ids[]" class="checkboxes checkbox" value="'.$q->id.'" form="bulk_delete_modal"/><span></span></label>';
            })
            ->addColumn('company', function ($q) {
                return $q->company->name;
            })
            ->addColumn('created_at', function ($q) {
                return '<span class="ltr-direction block text-right">'.$q->created_at.'</span>';
            })
            ->addColumn('actions', function ($q) {
                $return = '<div class="btn-group">'.
                    '<button class="btn btn-xs btn-actions dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">'. __('lang.actions') . '<i class="fa fa-angle-down"></i></button>'.
                    '<ul class="dropdown-menu" role="menu">'.
                    '<li><a href="'. route('employees.edit', $q->id) .'"><i class="fa fa-edit fa-fw"></i>'. ' '  . __('lang.edit') .'</a></li>'.
                    '<li><a href="#" class="delete_confirmation" data-toggle="modal" data-target="#deleteModal" data-action="'. route('employees.destroy', $q->id) .'"><i class="fa fa-trash fa-fw"></i>'. ' ' . __('lang.delete') .'</a></li>'.
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
    public function query(Employee $model)
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
                                    this.api().columns([1, 2, 3, 4, 5]).every(function () {
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
            ['name' => 'first_name', 'data' => 'first_name', 'title' => __('lang.first_name')],
            ['name' => 'last_name', 'data' => 'last_name', 'title' => __('lang.last_name')],
            ['name' => 'company', 'data' => 'company', 'title' => __('lang.company')],
            ['name' => 'email', 'data' => 'email', 'title' => __('lang.email')],
            ['name' => 'phone', 'data' => 'phone', 'title' => __('lang.phone')],
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
        return 'Employees_' . date('YmdHis');
    }
}
