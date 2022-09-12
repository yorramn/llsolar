@section('title', 'Registrando novo Funcionário')
<form action="" class="form-group" wire:submit.prevent="save">
    @csrf
    @method("POST")
    <div class="row">
        <div class="col-md-12">
            <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;">Cadastrar novo funcionário</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" wire:model="data.cpf" id="cpf">
        </div>
        <div class="col-md-6">
            <label for="name">Nome Completo</label>
            <input type="text" class="form-control" wire:model="data.name" id="name">
        </div>
        <div class="col-md-3">
            <label for="">Setor de atuação</label>
            <select wire:model="data.role" class="form-control">
                <option selected>Selecione o Setor de Atuação</option>
                @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="">Email para acesso</label>
            <input type="text" class="form-control" placeholder="exemplo@email.com" wire:model="data.email">
        </div>
        <div class="col-md-3">
            <label for="">Whatsapp para contato</label>
            <input type="text" class="form-control" placeholder="11555555555" wire:model="data.cellphone">
        </div>
        <div class="col-md-3">
            <label for="">Cadastre uma senha</label>
            <input type="password" class="form-control" wire:model="data.password">
        </div>
        <div class="col-md-3">
            <label for="">Repita a senha</label>
            <input type="password" class="form-control" wire:model="data.password_confirmation">
        </div>
    </div>
    <div class="row mt-2 align-items-center">
        <div class="col-md-12">
            <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;">Permissões de acesso</h2>
        </div>
{{--        <div class="col-md-8">--}}
{{--            <div class="form-check form-switch col-md-3 mt-2">--}}
{{--                <input class="form-check-input" type="checkbox" wire:model="allPermissionsTo" {{!$permissionsIsAvaliable ? "disabled" : ""}}>--}}
{{--                <label class="form-check-label">Selecionar todos</label>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12">
            <span class="notify-text">
                <p class="text-center text-muted">Escolha o que os seus funcionários poderão acessar na aplicação</p>
            </span>
        </div>
    </div>
    <div class="row mb-3">
        <section class="col-md-12">
            <div class="row container">
                @foreach($permissions as $index => $permission)
                    <div class="form-check form-switch col-md-3 mt-2">
                        <input class="form-check-input" value="{{$permission->name}}" type="checkbox" wire:model="data.permissions.{{$permission->id}}" {{!$permissionsIsAvaliable ? "disabled" : ""}} checked>
                        <label class="form-check-label">{{$permission->name}}</label>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <input type="submit" value="Cadastrar" class="btn btn-success">
        </div>
    </div>
</form>


