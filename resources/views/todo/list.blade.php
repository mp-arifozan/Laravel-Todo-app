@extends('layouts.master')

@section('content')
    <h1>Yapılacaklar Listesi <a href="{{ url('/todo/create') }}" class="btn btn-primary pull-right btn-sm">Görev Ekle</a></h1>
    <hr/>

    @include('partials.flash_notification')

    @if(count($todoList))
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Görev İsmi</th>
                    <th>Durum</th>
                    <!--<th>Action</th>-->
                </tr>
                </thead>

                <tbody>
                @foreach($todoList as $todo)
                    <tr>
                        <td>{{ $todo->name }}</td>
                        <td>{{ $todo->complete? 'Tamamlandı' : 'Beklemede' }}</td>
                        <td>
                            {!! Form::open(['route' => ['todo.update', $todo->id], 'class' => 'form-inline', 'method' => 'put']) !!}
                                @if($todo->complete)
                                    {!! Form::submit('Geri Al', ['class' => 'btn btn-info btn-xs']) !!}
                                @else
                                    {!! Form::submit('Yapıldı', ['class' => 'btn btn-success btn-xs']) !!}
                                @endif
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['todo.destroy', $todo->id], 'class' => 'form-inline', 'method' => 'delete']) !!}
                                {!! Form::hidden('id', $todo->id) !!}
                                {!! Form::submit('Sil', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $todoList->render() !!}
        </div>
    @else
        <div class="text-center">
            <h3>Henüz görev eklenmedi.</h3>
            <p><a href="{{ url('/todo/create') }}">Yeni görev ekle</a></p>
        </div>
    @endif
@endsection