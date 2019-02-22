@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary">Registrar usuario</div>
  <div class="card-body">

    @if (session('notification'))
      <div class="alert alert-success">
        <ul>
          {{session('notification')}}
        </ul>
      </div>
    @endif

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

      <form action="" method="POST">
        {{ csrf_field() }}

          <div class="form-group">
             <label for="name">Nombre</label>
             <input type="text" name="name" class="form-control" value="{{ old('name') }}">
          </div>
          <div class="form-group">
             <label for="description">Descripción</label>
             <textarea type="text" name="description" class="form-control">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
             <label for="start">Fecha de inicio</label>
             <input type="date" name="start" class="form-control" value="{{ old('start', date('Y-m-d')) }}">
          </div>
          <div class="form-group">
             <button class="btn btn-primary">Registrar proyecto</button>
          </div>
      </form>

      <br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de inicio</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          @foreach($projects as $project)
          <tr>
            <td>{{$project->name}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->star ?: 'No se ha indicado'}}</td>
            <td>

              @if($project->trashed())
              <a href="/proyecto/{{$project->id}}/restaurar" class="btn btn-success btn-block" title="Restaurar">
                <i class="fas fa-trash-restore"></i>
              </a>
              @else
              <a href="/proyecto/{{$project->id}}" class="btn btn-primary" title="Editar">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a href="/proyecto/{{$project->id}}/eliminar" class="btn btn-danger" title="Dar de baja">
                <i class="far fa-trash-alt"></i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

  </div>
</div>
@endsection 