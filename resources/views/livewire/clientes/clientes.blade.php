<div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Clientes</h1>
            <a href="{{route('customer.create')}}" class="btn btn-primary"> + Adicionar</a>
        </div>
        <div class="col-md-12">
            <table class="table table-responsive " id="no-more-tables" style="overflow-y-scroll;">
                <thead class="">
                <tr>
                    <th data-title="nome">Nome</th>
                    <th data-title="cpf">CPF/CNPJ</th>
                    <th data-title="whats">WhatsApp</th>
                    <th data-title="dependentes">Situação da Negociação</th>
                    <th data-title="acoes">Ações</th>
                    <th data-title="none"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td class="">
                        {{$customer->name}}
{{--                            <a class="">{{$customer->name}}</a>--}}
                            {{--                                <p class="">Organization</p>--}}
                        </td>
                        <td class="">
                            <p class="">{{$customer->cnpj ?? $customer->cpf}}</p>
                        </td>
                        <td class="">
                            {{--                                <span class="bg-gradient-lime px-3.6-em-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Online</span>--}}
                            {{$customer->cellphone}}
                        </td>
                        <td>
                            {{$customer->statusNegotiation->name}}
                        </td>
{{--                        @if(!$customer->dependents->count())--}}
{{--                            <td class="">--}}
{{--                                <p><b>Sem dependentes</b></p>--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td class="">--}}
{{--                                <select id="uf"--}}
{{--                                        class=""--}}
{{--                                        aria-label="Default select example" name="estado">--}}
{{--                                    @foreach($customer->dependents as $dependent)--}}
{{--                                        <option value="{{$dependent->id}}">{{$dependent->contact_contract}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </td>--}}
{{--                        @endif--}}
                        <td class="">
                            <button
                                wire:click="showCustomer({{$customer->id}})"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#showCustomer"
                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg></button>

                            <a href="https://api.whatsapp.com/send/?phone=55{{$customer->cellphone}}&text&type=phone_number&app_absent=0" target="_blank"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                            </svg></button></a>

                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @can('Editar Registros')<a class="font-semibold leading-tight text-slate-400"> Edit </a>@endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">
                            Sem dados
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    <div wire:loading class="loading loading--full-height"></div>
    <div wire:ignore.self class="modal left fade" id="showCustomer" tabindex="-1" aria-labelledby="showCustomer" aria-hidden="true">
        <div class="modal-dialog">
                @isset($showCustomer)
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editando dados de <span class="text-success">{{$showCustomer->name}}</span></h5> &nbsp;
                            <div class="modal-title">
                                @if(!$edit)
                                    <button type="button" wire:click.prevent="canEditFields" class="btn btn-warning btn-sm waves-effect waves-light">Editar</button>
                                @else
                                    <button wire:click.prevent="save" type="submit" class="btn btn-success btn-sm waves-effect waves-light">Salvar</button>
                                @endif
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" class="form-group">
                                @csrf
                                <div class="accordion" id="showCustomer">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Dados do cliente
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="nome">Nome</label>
                                                        <input wire:model="data.customer.name" type="email" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                        @error('data.customer.name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Email</label>
                                                        <input wire:model="data.customer.email" type="email" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="exampleInputEmail1">CPF</label>
                                                        <input wire:model="data.customer.cpf" type="email" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CPF">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="exampleInputEmail1">CNPJ</label>
                                                        <input wire:model="data.customer.cnpj" type="email" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="exampleInputEmail1">Número de Telefone</label>
                                                        <input wire:model="data.customer.cellphone" type="email" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ">
                                                        {{--                                        <a target="_blank" wire:model="data.customer.cellphone" href="https://api.whatsapp.com/send/?phone=55{{$showCustomer->cellphone}}&text&type=phone_number&app_absent=0">{{$customer->cellphone}}</a>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#endereco" aria-expanded="true" aria-controls="endereco">
                                                Endereço do Cliente
                                            </button>
                                        </h2>
                                        <div id="endereco" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="nome">CEP</label>
                                                        <input type="email" wire:model="data.customer.address.cep" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Logradouro</label>
                                                        <input type="email" wire:model="data.customer.address.street" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Número</label>
                                                        <input type="email" wire:model="data.customer.address.number" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Estado</label>
                                                        <select class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{$showCustomer->address->city->state->id === $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Cidade</label>
                                                        <select class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" {{$showCustomer->address->city->id === $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="nome">Bairro</label>
                                                        <input type="email" wire:model="data.customer.address.district" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="Nome">
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="complemento">Complemento</label>
                                                        <textarea id="complemento" {{!$edit ? 'disabled' : ''}} class="form-control" id="inp-type-5" wire:model="data.customer.address.complement" placeholder="Write your meassage">
                                                            {{$showCustomer->address->complement}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#statusNegotiation" aria-expanded="true" aria-controls="collapseOne">
                                                Status da Negociação
                                            </button>
                                        </h2>
                                        <div id="statusNegotiation" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <select id="status_negotiation"
                                                                {{!$edit ? 'disabled' : ''}}
                                                                wire:model="data.customer.status_negotiation_id" required
                                                                class="form-control">
                                                            @foreach($status_negotiations as $status_negotiation)
                                                                <option value="{{$status_negotiation->id}}">{{$status_negotiation->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#titularidade" aria-expanded="true" aria-controls="collapseOne">
                                                Titularidade
                                            </button>
                                        </h2>
                                        <div id="titularidade" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <h3 class="title text-capitalize text-center mb-2 pb-2"></h3>
                                                    @if(!$showCustomer->contracts)
                                                        <h5 class="title text-center text-danger mb-2 pb-2">Cliente sempre foi o titular</h5>
                                                    @else
                                                        <div class="col-md-12">
                                                            <label for="exampleInputEmail1">CPF Titular Anterior</label>
                                                            <input type="email" wire:model="data.customer.contracts.old_titular_cpf" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ" value="{{$showCustomer->contracts->old_titular_cpf}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="exampleInputEmail1">Conta Contrato Anterior</label>
                                                            <input type="email" wire:model="data.customer.contracts.old_contact_contract"  class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ" value="{{$showCustomer->contracts->old_contact_contract}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="exampleInputEmail1">CPF Titular</label>
                                                            <input type="email" wire:model="data.customer.contracts.cpf"  class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ" value="{{$showCustomer->contracts->cpf}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="exampleInputEmail1">Conta Contrato Atual</label>
                                                            <input type="email" wire:model="data.customer.contracts.contact_contract"  class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ" value="{{$showCustomer->contracts->contact_contract}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="exampleInputEmail1">KWH</label>
                                                            <input type="email" wire:model="data.customer.contracts.kwh" class="form-control" id="exampleInputEmail1" {{!$edit ? 'disabled' : ''}} placeholder="CNPJ" value="{{$showCustomer->contracts->kwh}}">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dependentes" aria-expanded="true" aria-controls="collapseOne">
                                                Dependentes
                                            </button>
                                        </h2>
                                        <div id="dependentes" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @forelse($allDependents as $index =>  $dependent)
                                                        <div class="col-md-12">
                                                            <label for="nome">CPF</label>
                                                            <input wire:model="allDependents.{{$index}}.cpf" type="email" class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="nome">CNPJ</label>
                                                            <input wire:model="allDependents.{{$index}}.cnpj" type="email" class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="nome">Conta Contrato Dependente</label>
                                                            <input wire:model="allDependents.{{$index}}.contact_contract" type="email" class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="nome">Conta Contrato Titular</label>
                                                            <input wire:model="allDependents.{{$index}}.contact_contract_titular" type="email" class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="nome">KWH</label>
                                                            <input wire:model="allDependents.{{$index}}.kwh" type="email" class="form-control" {{!$edit ? 'disabled' : ''}}>
                                                        </div>
                                                        @if($edit)
                                                            <div class="col-md-12">
                                                                <button wire:click.prevent="removeDependent({{$index}})" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Remover</button>
                                                            </div>
                                                        @endif
                                                    @empty
                                                        <h5 class="title text-center text-danger mb-2 pb-2">Sem dependentes</h5>
                                                    @endforelse
                                                    @if($edit && count($allDependents) >= 1)
                                                        <div class="col-md-12">
                                                            <button wire:click.prevent="addDependent" type="submit" class="btn btn-success btn-sm waves-effect waves-light">Adicionar</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-2">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#anexos" aria-expanded="true" aria-controls="collapseOne">
                                                Anexos
                                            </button>
                                        </h2>
                                        <div id="anexos" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#showCustomer">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @foreach($attachments as $indexAttachment => $attachment)
                                                        <div class="col-md-12 mb-2">
                                                            <figure class="figure">
                                                                <img class="figure-img img-fluid rounded" src="{{ url("storage/".$attachment['link'])}}" alt="...">
                                                                <figcaption class="figure-caption text-end">{{$attachment['created_at']}}</figcaption>
                                                            </figure>
                                                        </div>
                                                    @endforeach
                                                    @if(isset($newAttachments) && count($newAttachments) >= 1)
                                                        @foreach($newAttachments as $indexNewAttachment => $newAttachment)
                                                            <div class="col-md-3 mt-3 text-center">
                                                                <img style="max-width: 250px; max-height: 200px;" class="w-full h-full object-center object-cover" src="{{ $newAttachment->temporaryUrl()}}">
                                                                <button wire:click.prevent="removeNewAttachment({{$indexNewAttachment}})" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Remover</button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @if(((!isset($newAttachments) && count($attachments) === 0) || (count($newAttachments) === 0 && count($attachments) === 0)) && !$edit)
                                                        <h5 class="title text-center text-danger mb-2 pb-2">Sem anexos</h5>
                                                    @endif
                                                    @if(($edit && count($attachments) >= 1) || ($edit && (count($newAttachments) === 0 || count($attachments) === 0)))
                                                        <div class="col-span-2">
                                                            <!-- component -->
                                                            <div class="flex w-full h-screen items-center justify-center bg-grey-lighter">
                                                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                                                                    <span class="mt-2 text-base leading-normal">Select a file</span>
                                                                    <input type="file" wire:model="newAttachments" multiple class="hidden" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('buttons.close')}}</button>
                            <button wire:click.prevent="save" type="submit" class="btn btn-success btn-sm waves-effect waves-light">
                                {{__('buttons.save')}}</button>
                        </div>
                    </div>
                @endisset
            </div>
    </div>
</div>
