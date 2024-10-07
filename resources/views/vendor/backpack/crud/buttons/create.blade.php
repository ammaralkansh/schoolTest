<style>
    .animated-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        transition: transform 0.3s ease, background-color 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        animation: fadeIn 0.5s;
    }

    .animated-button:hover {
        background-color: #0056b3;
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
    }

    .animated-button i {
        margin-right: 5px;
        transition: transform 0.3s ease;
    }

    .animated-button:hover i {
        transform: rotate(20deg);
    }

    .animated-button::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300%;
        height: 300%;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transition: width 0.5s ease, height 0.5s ease, top 0.5s ease, left 0.5s ease;
        z-index: 0;
        transform: translate(-50%, -50%) scale(0);
    }

    .animated-button:hover::after {
        width: 100%;
        height: 100%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1);
    }

    .animated-button span, .animated-button i {
        position: relative;
        z-index: 1;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@if ($crud->hasAccess('create'))
    <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary animated-button" bp-button="create">
        <i class="la la-plus"></i> <span>{{ trans('backpack::crud.add') }} {{ $crud->entity_name }}</span>
    </a>
@endif
