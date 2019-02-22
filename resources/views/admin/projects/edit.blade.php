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
             <label for="name">Nombre</label>
             <input type="text" name="name" class="form-control" value="{{ old('name', $project->name) }}">
          </div>
          <div class="form-group">
             <label for="description">Descripción</label>
             <textarea type="text" name="description" class="form-control">
              {{ old('description', $project->description) }}
             </textarea>
          </div>
          <div class="form-group">
             <label for="start">Fecha de inicio</label>
             <input type="date" name="start" class="form-control" value="{{ $project->start }}">
          </div>
          <div class="form-group">
             <button class="btn btn-primary">Guardar proyecto</button>
          </div>
      </form>

      <br>
      <div class="row">
        <div class="col-md-6">
          <p>Categorías</p>
          <form action="/categorias" method="POST" class="form-inline">
            {{ csrf_field() }}
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="form-group">
              <input type="text" name="name" placeholder="Ingrese el nombre" class="form-control"> 
            </div>
              <button class="btn btn-primary ml-2">Añadir</button>
          </form>
          <table class="table table-bordered mt-1">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach($categories as $category)
              <tr>
                <td>{{$category->name}}</td>
                <td>
                  <button type="button" class="btn btn-primary" title="Editar" data-category="{{$category->id}}"> 
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <a href="/categoria/{{$category->id}}/eliminar" class="btn btn-danger" title="Dar de baja">
                    <i class="far fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="col-md-6">
          <p>Niveles</p>
          <form action="/niveles" method="POST" class="form-inline">
            {{ csrf_field() }}
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="form-group">
              <input type="text" name="name" placeholder="Ingrese el nombre" class="form-control"> 
            </div>
            <div class="form-group">
              <button class="btn btn-primary ml-2">Añadir</button>
            </div>
          </form>
          <table class="table table-bordered mt-1">
            <thead>
              <tr>
                <th>#</th>
                <th>Nivel</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach($levels as $key => $level)
              <tr>
                <td>N{{$key+1}}</td>
                <td>{{$level->name}}</td>
                <td>
                  <button type="button" class="btn btn-primary" title="Editar" data-level="{{$level->id}}">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <a href="/nivel/{{$level->id}}/eliminar" class="btn btn-danger" title="Dar de baja">
                    <i class="far fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div> 
      </div>
      
      
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalEditCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/categoria/editar" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" name="category_id" value="" id="category_id">
          <div class="form-group">
            <label for="name">Nombre de la categoría</label>
            <input type="text" name="name" class="form-control" value="" id="category_name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalEditLevel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar nivel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/nivel/editar" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" name="level_id" value="" id="level_id">
          <div class="form-group">
            <label for="name">Nombre del nivel</label>
            <input type="text" name="name" class="form-control" value="" id="level_name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection 

@section('scripts')
  <script type="text/javascript" src="/js/admin/projects/edit.js"></script>
@endsection