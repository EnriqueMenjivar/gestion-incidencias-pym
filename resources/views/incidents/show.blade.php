@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header bg-primary">Información sobre la incidencia</div>
  <div class="card-body">

    @if (session('notification'))
      <div class="alert alert-success">
        <ul>
          {{session('notification')}}
        </ul>
      </div>
    @endif
    
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Código</th>
          <th>Proyecto</th>
          <th>Categoría</th>
          <th>Fecha de envio</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td id="incident_key">{{ $incident->id}}</td>
          <td id="incident_project">{{ $incident->project->name}}</td>
          <td id="incident_category">{{ $incident->category_name}}</td>
          <td id="incident_created_at">{{ $incident->created_at}}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <th>Asignada a</th>
          <th>Nivel</th>
          <th>Estado</th>
          <th>Severidad</th>
        </tr>
      </thead>
      <tbody>
        <td id="incident_responsible">{{ $incident->support_name}}</td>
        <td id="incident">{{ $incident->level->name }}</td>
        <td id="incident_state">{{ $incident->state}}</td>
        <td id="incident_severity">{{ $incident->severity_full}}</td>
      </tbody>
    </table>

    <table class="table table-bordered">
      <tbody>
        <tr>
          <th>Título</th>
          <td>{{ $incident->title }}</td>
        </tr>
        <tr>
          <th>Descripción</th>
          <td>{{ $incident->description }}</td>
        </tr>
        <tr>
          <th>Adjuntos</th>
          <td>No se han adjuntado archivos</td>
        </tr>
      </tbody>
    </table>
    
    
    @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
      <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm">Atender incidencia</a>
    @endif

    @if (auth()->user()->id == $incident->client_id)

      @if($incident->active)
        <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm">Marcar como resuelto</a>
        <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm">Editar incidencia</a>
      @else
        <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm">Volver a abrir incidencia</a>
      @endif

    @endif

    @if (auth()->user()->id == $incident->support_id && $incident->active)
      <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm">Derivar al siguiente nivel</a>
    @endif
    

  </div>
</div>

<br>
@include('layouts.chat')
@endsection 