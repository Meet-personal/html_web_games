<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="{{$icon?? 'bi bi-house'}} lh-1 pe-3 me-3 border-end border-dark"></i>
            <a href="{{route('admin.dashboard')}}" class="text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item text-secondary" aria-current="page">
            {{$model ?? 'Dashboard'}}
        </li>


    </ol>
</div>
