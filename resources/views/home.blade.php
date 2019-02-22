@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary">Dashboard</div>
    <div class="card-body">
	
	@if (auth()->user()->is_support)
    	<div class="card">
		    <div class="card-header bg-success">Insidencias asignadas para mí</div>
		    <div class="card-body">
		    	<table class="table table-bordered">
		    		<thead>
		    			<tr>
			    			<th>Código</th>
			    			<th>Categoría</th>
			    			<th>Severidad</th>
			    			<th>Estado</th>
			    			<th>Fecha de creación</th>
			    			<th>Título</th>
		    			</tr>
		    		</thead>
		    		<tbody id="dashboard_my_incidents">
		    			@foreach ($my_incidents as $incident)
		    				<tr>
		    					<td>
		    						<a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>
		    					</td>
		    					<td>{{ $incident->category->name }}</td>
		    					<td>{{ $incident->severity_full }}</td>
		    					<td>{{ $incident->state }}</td>
		    					<td>{{ $incident->created_at }}</td>
		    					<td>{{ $incident->title_short }}</td>
		    				</tr>
		    			@endforeach
		    		</tbody>
		    	</table>
		    </div>
		</div>

		<div class="card mt-3">
		    <div class="card-header bg-success">Insidencias sin asignar</div>
		    <div class="card-body">
		    	<table class="table table-bordered">
		    		<thead>
		    			<tr>
			    			<th>Código</th>
			    			<th>Categoría</th>
			    			<th>Severidad</th>
			    			<th>Estado</th>
			    			<th>Fecha de creación</th>
			    			<th>Título</th>
			    			<th>Opción</th>
		    			</tr>
		    		</thead>
		    		<tbody id="dashboard_pending_incidents">
		    			@foreach ($pending_incidents as $incident)
		    				<tr>
		    					<td>
		    						<a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>
		    					</td>
		    					<td>{{ $incident->category->name }}</td>
		    					<td>{{ $incident->severity_full }}</td>
		    					<td>{{ $incident->state }}</td>
		    					<td>{{ $incident->created_at }}</td>
		    					<td>{{ $incident->title_short }}</td>
		    					<td>
		    						<a href="" class="btn btn-primary btn-sm">Atender</a>
		    					</th>
		    				</tr>
		    			@endforeach
		    		</tbody>
		    	</table>
		    </div>
		</div>
	@endif

		<div class="card mt-3">
		    <div class="card-header bg-success">Insidencias reportadas por mí</div>
		    <div class="card-body">
		    	<table class="table table-bordered">
		    		<thead>
		    			<tr>
			    			<th>Código</th>
			    			<th>Categoría</th>
			    			<th>Severidad</th>
			    			<th>Estado</th>
			    			<th>Fecha de creación</th>
			    			<th>Título</th>
			    			<th>Responsable</th>
		    			</tr>
		    		</thead>
		    		<tbody id="dashboard_by_me">
		    			@foreach ($incidents_by_me as $incident)
		    				<tr>
		    					<td>
		    						<a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>
		    					</td>
		    					<td>{{ $incident->category_name }}</td>
		    					<td>{{ $incident->severity_full }}</td>
		    					<td>{{ $incident->state }}</td>
		    					<td>{{ $incident->created_at }}</td>
		    					<td>{{ $incident->title_short }}</td>
		    					<td>{{ $incident->support_id ?: 'Sin asignar'}}</th>
		    				</tr>
		    			@endforeach
		    		</tbody>
		    	</table>
		    </div>
		</div>

    </div>
</div>
@endsection
