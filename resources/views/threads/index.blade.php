@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Tópicos</h2>
        <hr>
    </div>
    <div class="col-12">
        @forelse($threads as $thread)
        <div class="list-group mt-3" style="margin-bottom: 15px;">
            <a href="{{route('threads.show', $thread->slug)}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{$thread->title}}</h5>
                    <small>Criado em {{$thread->created_at->diffForHumans()}} por {{$thread->user->name}}</small>
                    <span class="badge badge-primary">{{$thread->channel->slug}}</span>
                </div>
                <span class="badge badge-warning badge-pill">{{$thread->replies_count}}</span>
            </a>
        </div>
        @empty
        <div class="alert alert-warning">
            Nenhum topico encontrado
        </div>
        @endforelse

        <div class="mt-5">
            {{$threads->links()}}
        </div>
    </div>
</div>
@endsection