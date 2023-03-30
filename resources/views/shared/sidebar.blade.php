<div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
    <a href="{{ url('/home') }}"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none
        {{request()->is('home') ? 'active': 'link-dark'}}">
        <i class="bi bi-gear-wide-connected fs-3"></i>
        <span class="fs-4 ms-2">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        @if(Auth::user()->administrador)
            <li class="nav-item">
                <a href="{{ url('capacitaciones') }}"
                   class="nav-link {{request()->is('capacitaciones') || request()->is('capacitaciones/*') ? 'active': 'link-dark'}}">
                    <i class="bi bi-buildings-fill"></i><span class="ms-2">Capacitaciones</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="{{ url('inscripciones') }}"
               class="nav-link {{request()->is('inscripciones') || request()->is('inscripciones/*') ? 'active': 'link-dark'}}">
                <i class="bi bi-buildings-fill"></i><span class="ms-2">Inscripciones</span>
            </a>
        </li>
    </ul>
</div>
