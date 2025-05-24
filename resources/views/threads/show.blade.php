@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>{{$thread->title}}</h2>
        <hr>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <small>Criado por {{$thread->user->name}} a {{$thread->created_at->diffForHumans()}}</small>
            </div>
            <div class="card-body">
                {{$thread->body}}
            </div>
            <div class="card-footer">
                <a href="{{route('threads.edit', $thread->slug)}}" class="btn tbn-sm btn-primary">Editar</a>
                <a href="3" class="btn tbn-sm btn-danger" onclick="event.preventDefault(); document.querySelector('form.thread-rm').submit();">Remover</a>

                <form action="{{route('threads.destroy', $thread->slug)}}" method="post" class="thread-rm" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="col-12">
        <h5>Respostas</h5>
        <hr>
        {{dd($thread->replies)}}
    </div>

    <div class="col-12">
        <hr>
        <form action="{{route('replies.store')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="thread_id" value="{{$thread->id}}">
                <label for="">Responder</label>
                <textarea class="form-control" name="reply" id="" cols="30" rows="3"></textarea>
            </div>
            <button type="submit">Responder</button>
        </form>
    </div>
</div>
@endsection