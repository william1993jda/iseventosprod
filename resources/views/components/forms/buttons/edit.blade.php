@props(['route', 'id'])
@can($route)
    <a class="flex items-center mr-3" href="{{ route($route, $id) }}">
        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
    </a>
@endcan
