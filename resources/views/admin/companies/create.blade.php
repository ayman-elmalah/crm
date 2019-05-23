@extends('admin.layouts.layout')
@section('title', $title)

@section('content')
    <section class="content-header">
        <h1 style="margin-bottom:30px;"></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ __('lang.dashboard') }}</a>
            </li>
            <li><a href="{{ route('companies.index') }}"><i class="fa fa-build"></i> {{ __('lang.companies') }}
                </a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $title }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('admin.companies.form')
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
