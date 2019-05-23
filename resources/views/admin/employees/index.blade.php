@extends('admin.layouts.layout')

@section('title', $title)

@include('admin.layouts.datatable.datatable')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a class="btn btn-primary" href="{{ route('employees.create') }}">{{ __('lang.create') . ' ' . __('lang.employee') }}</a>
            <a href="#" class="bulk_delete_confirmation btn btn-danger" id="sample_editable_1_new" data-toggle="modal" data-target="#bulkDeleteModal" data-action="{{ route('employees.bulk-delete') }}">{{ __('lang.bulk_delete') }}</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ __('lang.dashboard') }}</a>
            </li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    @include('components.flash')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        {!!
                            $dataTable->table([
                                'class' => 'dataTable table table-striped table-bordered table-hover w-100',
                            ], true)
                        !!}
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    @include('components.delete_modal')
    @include('components.bulk_delete_modal')
@endsection
