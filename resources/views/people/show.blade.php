@extends('layouts.app')

@section('template_title')
    {{ $people->name ?? 'Show People' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show People</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('people.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>First Name:</strong>
                            {{ $people->first_name }}
                        </div>
                        <div class="form-group">
                            <strong>Last Name:</strong>
                            {{ $people->last_name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $people->email }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $people->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Active:</strong>
                            {{ $people->active }}
                        </div>
                        <div class="form-group">
                            <strong>Type People Id:</strong>
                            {{ $people->type_people_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
