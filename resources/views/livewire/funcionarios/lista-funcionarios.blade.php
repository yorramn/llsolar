@section('title', 'Listando Funcionários')
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Funcionários</h1><br>
        <a href="{{route('employee.create')}}" class="btn btn-primary"> + Adicionar</a>
    </div>
    <div class="col-md-12">
        <table class="table table-responsive " id="no-more-tables">
            <thead class="">
            <tr>
                <th data-title="nome">Nome</th>
                <th data-title="cpf">CPF</th>
                <th data-title="whats">WhatsApp</th>
                <th data-title="setor">Setor</th>
                <th data-title="acoes">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->user->name}}</td>
                        <td>{{$employee->cpf}}</td>
                        <td>{{$employee->cellphone}}</td>
                        <td>
                            <select class="form-control-sm">
                                @foreach($employee->user->roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button
                                wire:click.prevent="showSelectedEmployee({{$employee->id}})"
                                data-bs-toggle="modal"
                                data-bs-target="#showEmployee"
                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg></button>

                            <a href="https://api.whatsapp.com/send/?phone=55{{$employee->cellphone}}&text&type=phone_number&app_absent=0" target="_blank"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                    </svg></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div wire:loading class="loading loading--full-height"></div>
    <div wire:ignore.self class="modal left fade" onfocusout="" id="showEmployee" tabindex="-1" aria-labelledby="showEmployee" aria-hidden="true">
        <div class="modal-dialog">
            @if($showEmployee && isset($employee))
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editando dados de <span class="text-success">{{$employee->user->name}}</span></h5> &nbsp;
                        @if(!$edit)
                            <button type="button" wire:click.prevent="canEditFields" class="btn btn-warning btn-sm waves-effect waves-light">Editar</button>
                        @else
                            <button wire:click.prevent="save" type="submit" class="btn btn-success btn-sm waves-effect waves-light">Salvar</button>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click.prevent="$set('edit', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" class="form-group">
                            @csrf
                            <div class="accordion" id="showEmployee">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Dados do Funcionário
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showEmployee">
                                        <div class="accordion-body">
                                            <div class="col">
                                                <label for="">Nome Completo</label>
                                                <input type="text" class="form-control" wire:model="data.employee.user.name" {{!$edit ? 'disabled readonly' : ''}}>
                                            </div>
                                            <div class="col">
                                                <label for="">Email para acesso</label>
                                                <input type="text" class="form-control" placeholder="exemplo@email.com" wire:model="data.employee.user.email" {{!$edit ? 'disabled readonly' : ''}}>
                                            </div>
                                            <div class="col">
                                                <label for="">CPF</label>
                                                <input type="text" class="form-control" wire:model="data.employee.cpf" disabled readonly {{!$edit ? 'disabled readonly' : ''}}>
                                            </div>
                                            <div class="col">
                                                <label for="">Whatsapp para contato</label>
                                                <input type="text" class="form-control" placeholder="11555555555" wire:model="data.employee.cellphone" {{!$edit ? 'disabled readonly' : ''}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nivelAcesso" aria-expanded="true" aria-controls="collapseOne">
                                            Nível de Acesso
                                        </button>
                                    </h2>
                                    <div id="nivelAcesso" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showEmployee">
                                        <div class="accordion-body">
                                            <div class="col">
                                                <label for="">Setor de atuação</label>
                                                <select wire:model="data.role" name="" class="form-control">
                                                    @foreach($roles as $index => $role)
                                                        <option value="{{$role->name}}" {{$employee->user->roles->first()->id === $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col mt-3">
                                                <div class="row text-center">
                                                    <div class="col-12">
                                                        <p class="text-muted">Permissões</p>
                                                    </div>
                                                    @foreach($permissions as $index => $permission)
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input"
                                                                   value="{{$permission->name}}"
                                                                   wire:model="selectedPermissions.{{$permission->name}}"
                                                                   type="checkbox">
                                                            <label class="form-check-label">{{$permission->name}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('buttons.close')}}</button>
                        <button type="button" class="btn btn-success">{{__('buttons.save')}}</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
