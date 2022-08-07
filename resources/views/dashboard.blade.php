@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Личный кабинет') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="p-6 bg-blue border-b border-gray-200">
                            Свой список ToDo
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
