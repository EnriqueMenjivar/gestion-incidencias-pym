<div class="card">
    <div class="card-header bg-primary">Menú</div>

    <div class="card-body">
      	<div class="list-group">
      	@if(auth()->check())
		  <a href="/home" class="list-group-item list-group-item-action 
		  	@if(request()->is('home')) active @endif">Dashboard
		  </a>

		  @if(!auth()->user()->is_client)
			  <a href="/ver" class="list-group-item list-group-item-action
			  	@if(request()->is('ver')) active @endif">Ver incidencias
			  </a>
		  @endif
		  
		  <a href="/reportar" class="list-group-item list-group-item-action
		  	@if(request()->is('reportar')) active @endif">Reportar incidencia
		  </a>

		  @if(auth()->user()->is_admin)
			  <a href="#" class="dropdown-toggle list-group-item list-group-item-action" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  	Administración <span class="caret"></span>
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
	    		<a href="/usuarios" class="dropdown-item">Usuario</a>
	    		<a href="/proyectos" class="dropdown-item">Proyectos</a>
	    		<a href="/config" class="dropdown-item">Configuración</a>
	  		  </div>
  		  @endif

		@else
		  <a href="#" class="list-group-item list-group-item-action">Bienvenido</a>
		  <a href="#" class="list-group-item list-group-item-action">Instrucciones</a>
		  <a href="#" class="list-group-item list-group-item-action">Créditos</a>
		@endif
		</div>  
    </div>
</div>