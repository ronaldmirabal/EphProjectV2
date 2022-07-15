@extends('layouts.app')

@section('template_title')
    {{ $typePerson->name ?? 'Show Type Person' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Type Person</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('type-people.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $typePerson->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
