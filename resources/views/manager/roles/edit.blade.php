@extends('layouts.manager')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
        <h2>Editar Papél de Usuário</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <form action="{{route('roles.update', $role->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nome do Papél</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ex.: Administrador" value="{{$role->name}}">

                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Papél (ROLE_*)</label>
                <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" placeholder="Ex.: ROLE_ADMIN" value="{{$role->role}}">

                @error('role')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-success">Atualizar Papél</button>
            </div>
        </form>
    </div>
</div>

@endsection