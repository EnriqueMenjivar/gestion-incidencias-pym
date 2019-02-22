@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary">Editar usuario</div>
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
             <label for="email">E-mail</label>
             <input type="text" name="email" class="form-control" readonly="true" value="{{ old('email', $user->email) }}">
          </div>
          <div class="form-group">
             <label for="name">Nombre</label>
             <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
          </div>
          <div class="form-group">
             <label for="password">Contraseña <em>Ingresar solo si se desea modificar</em></label>
             <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>
          <div class="form-group">
             <button class="btn btn-primary">Guardar usuario</button>
          </div>
      </form>

      <form action="/proyecto-usuario" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="row">
          <div class="col-md-4">
            <select class="form-control" name="project_id" id="select-project">
              <option value="">Seleccionar proyecto</option>
              @foreach($projects as $project)
              <option value="{{ $project->id}}">{{ $project->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-control" name="level_id" id="select-level">
              <option value="">Seleccionar nivel</option>
            </select>
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-block">Asignar Proyecto</button>
          </div>
        </div>        
      </form>

      <br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Proyecto</th>
            <th>Nivel</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          @foreach($projects_user as $project_user)
          <tr>
            <td>{{ $project_user->project->name }}</td>
            <td>{{ $project_user->level->name }}</td>
            <td>
              <a href="" class="btn btn-primary" title="Editar">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a href="/proyecto-usuario/{{$project_user->id}}/eliminar" class="btn btn-danger" title="Dar de baja">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      
  </div>
</div>
@endsection 

@section('scripts')
<script type="text/javascript" src="/js/admin/users/edit.js"></script>
@endsection