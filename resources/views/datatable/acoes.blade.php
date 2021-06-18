<style>
    .dropdown-item:hover {
        background-color: #cbbcbc8f;
    }
</style>

<div class="dropdown show">
    <a class="btn btn-sm btn-primary dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @foreach ($acoes as $acao)
            @if ($acao["tipo"] == "link")
                <a class="dropdown-item" href="{{ $acao["route"] }}">
                    <i class="{{ $acao["icone"] }}"></i> &nbsp;&nbsp;{{ $acao["titulo"] }}
                </a>
            @else
                <a href="javascript:void(0);" class="dropdown-item" onclick="{{ $acao["onclick"] }}">
                    <i class="{{ $acao["icone"] }}"></i> &nbsp;&nbsp;{{ $acao["titulo"] }}
                </a>
            @endif
        @endforeach
    </div>
</div>
