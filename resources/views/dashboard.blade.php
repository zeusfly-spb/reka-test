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
                        <div class="p-6 border-b border-gray-200">
                            <div class="d-flex justify-content-between mb-2">
                                <strong>Свой список ToDo</strong>
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#itemModal"
                                    data-bs-mode="add"
                                    class="btn btn-primary"
                                    title="Добавить элемент"
                                >
                                    <strong>+</strong>
                                </button>
                            </div>

                            <ul class="list-group" id="own-items">
{{--                                @foreach($list as $item)--}}
{{--                                    <li class="list-group-item">{{ $item->content }}</li>--}}
{{--                                @endforeach--}}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="itemModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemModalLabel"></h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Закрыть"
                            onclick="clearInput()"
                        />
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="todo-input" class="col-form-label">
                                Значение:
                            </label>
                            <input class="form-control" id="todo-input"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            id="cancel-button"
                        >
                            Отмена
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            id="save-button"
                        >
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('js/engine.js')}}"></script>

        <script>
            const create = content => {
                $.ajax({
                    type: 'POST',
                    url: '/create',
                    data: { "content": content, "_token": "{{ csrf_token() }}" },
                    success: res => {
                        prependOwnItem(res.data)
                    },
                    error: (xhr, e) => {
                        console.log('Query error ' + e)
                    }
                })
            }
        </script>

    </div>
@endsection
