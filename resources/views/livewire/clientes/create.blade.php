    @section('title', 'Cadastrar cliente')
    <form method="POST" wire:submit.prevent="store" class="form-control" enctype="multipart/form-data" wire:ignore.self>
        @csrf

        <div class="row">
            <div class="col-md-12">
                <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;"> Dados Pessoais do Cliente </h2>
            </div>
            <div class="col-md-8">
                <label class=""> Nome Completo</label>
                <input
                    wire:model="client.name" required
                    class="form-control"
                    id="nome" type="text" placeholder="Nome completo">
                @error('client.name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">
                <label class=""> CPF</label>
                <input
                    wire:model="client.cpf" required
                    class=" form-control"
                    id="CPF" type="text" placeholder="CPF">
                @error('client.cpf') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">
                <label class="">CNPJ</label>
                <input
                    wire:model="client.cnpj" required
                    class=" form-control"
                    id="CPF" type="text" placeholder="CPF">
                @error('client.cnpj') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class=""> Whatsapp</label>
                <input type="text" name="telefone"
                   wire:model="client.cellphone" required
                    class="form-control"
                    placeholder="84 9 9999-9999" name="telefone">
                @error('client.cellphone') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-8">
                <label for="cep" class="">E-mail</label>
                <input type="text" name="email"
                       wire:model="client.email" required
                    class="form-control"
                    placeholder="email@email.com" name="email">
                    @error('client.email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;"> Endereço do Cliente </h2>
            </div>
            <div class="col-md-3">
                <label>CEP</label>
                <input type="text" id="cep"
                       wire:model="address.cep" required
                    class="form-control"
                    placeholder="Digite aqui" name="cep">
                @error('address.cep') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-7">
                <label for="bairro" class="">Logradouro</label>
                <input id="rua" type="text"
                       wire:model="address.street" required
                    class="form-control"
                    placeholder="Digite aqui" name="logradouro">
                @error('address.street') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">
                <label for="numero" class="">Número</label>
                <input id="numero" type="text"
                       wire:model="address.number" required
                       class="form-control"
                       placeholder="Nº" name="numero">
                @error('address.number') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="uf" class="">Estado</label>
                <select id="uf"
                    wire:model="address.state" required
                    class="form-control"
                    aria-label="Default select example" name="estado">
                    <option selected>Selecione o Estado</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
                @error('address.state') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label>Cidade</label>
                <select id="cidade"
                    {{!$cities ? 'disabled' : ''}}
                    wire:model="address.city_id" required
                    class="form-control"
                    aria-label="Default select example" name="city">
                    @if($cities)
                        <option value="" selected disabled>Selecione a Cidade</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    @endif
                </select>
                @error('address.city_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="bairro" class="">Bairro</label>
                <input id="bairro" type="text"
                       wire:model="address.district" required
                       {{!$cities ? 'disabled' : ''}}
                       class="form-control"
                       name="bairro">
                @error('address.district') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12">
                <div class="col-span-6 mt-4">
                    <label class="">Complemento</label>
                    <textarea
                        wire:model="address.complement" required
                        style="resize: none"
                        class="form-control"
                        placeholder="Informações complementares" rows="2" name="info_complementar"></textarea>
                    @error('address.complement') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="flex-row mt-6 mb-6 pt-2">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;"> Titular da Conta </h2>
                </div>
                <div class="col-md-3">
                    <label>CPF Titular Anterior</label>
                    <input type="text"
                           wire:model="titular.old_titular_cpf"
                           {{$isAlwaysTitular ? 'disabled' : ''}}
                           class="form-control"
                           placeholder="Digite aqui" name="cep">
                    @error('titular.old_titular_cpf') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-2">
                    <label>Conta Contrato Anterior</label>
                    <input type="text"
                           wire:model="titular.old_contact_contract"
                           {{$isAlwaysTitular ? 'disabled' : ''}}
                           class="form-control"
                           placeholder="Digite aqui">
                    @error('titular.old_contact_contract') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label>CPF Titular</label>
                    <input type="text"
                           wire:model="client.cpf"
                           {{$isAlwaysTitular || !isset($client['cpf']) ? 'disabled' : ''}}
                           class="form-control"
                           placeholder="Digite aqui">
                    @error('titular.cpf') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-2">
                    <label>Conta Contrato Atual</label>
                    <input type="text"
                           wire:model="titular.contact_contract"
                           {{$isAlwaysTitular ? 'disabled' : ''}}
                           class="form-control"
                           placeholder="digite aqui">
                    @error('titular.contact_contract') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-2">
                    <label class="">KWH</label>
                    <input type="text"
                           wire:model="titular.kwh"
                           {{$isAlwaysTitular ? 'disabled' : ''}}
                           class="form-control"
                           placeholder="khw" name="">
                    @error('titular.kwh') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <button wire:click.prevent="defineIsAlwaysTitular" type="button" class="btn btn-primary">
                        {{$isAlwaysTitular ? 'Nem sempre' : 'Sempre fui'}}</button>
                </div>
            </div>
        </div>
        <div class="flex-row mt-6 mb-6 pt-2">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;">Dependentes</h2>
                </div>
                @if(count($allDependents) === 0)
                    <div class="col-md-12">
                        <p class="text-center">Sem dependentes</p>
                    </div>
                @endif
                @foreach($allDependents as $index => $dependent)
                    <div class="col-md-3">
                        <label for="cep" class="">CPF</label>
                        <input id="" type="text"
                               wire:model="allDependents.{{$index}}.cpf"
                               class="form-control"
                               placeholder="Digite aqui" name="cep">
                        @error('dependent.cpf') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="cep" class="">CNPJ</label>
                        <input id="" type="text"
                               wire:model="allDependents.{{$index}}.cnpj"
                               class="form-control"
                               placeholder="Digite aqui" name="cep" id="cnpj">
                        @error('dependent.cnpj') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="">Conta Contrato</label>
                        <input type="text"
                               wire:model="allDependents.{{$index}}.contact_contract"
                               class="form-control"
                               placeholder="Digite aqui" name="logradouro" id="logradouro">
                        @error('dependent.contact_contract') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="">Conta Contrato Titular</label>
                        <input type="text"
                               wire:model="allDependents.{{$index}}.contact_contract_titular"
                               class="form-control"
                               placeholder="Digite aqui" name="logradouro">
                        @error('dependent.contact_contract_titular') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-1">
                        <label class="">KWH</label>
                        <input type="text"
                               wire:model="allDependents.{{$index}}.kwh"
                               class="form-control"
                               placeholder="Digite aqui" name="logradouro">
                        @error('dependent.kwh') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-1 row d-flex pt-2 align-items-center">
                        <span class="col-md-12">
                            <button type="button" wire:click.prevent="removeDependent({{$index}})" class="btn btn-danger">X</button>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 mt-3">
                <button type="button" wire:click.prevent="addDependent" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
        <div class="flex-row mt-6 mb-6 pt-2">
            <div class="col-md-12">
                <h2 style="margin-top: 1rem; background-color: aqua; padding: 5px;">Anexos</h2>
            </div>
            <div class="col-md-6 row align-items-center justify-content-center text-center">
                <div class="col-md-4">
                    <label for="attachments">Selecione as imagens</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" type="file" wire:model="attachments" multiple/>
                </div>
            </div>
            <div class="col-md-10">
                @if($attachments)
                    Pré-visualização:
                    <div class="col-md-12">
                        @forelse($attachments as $attachment)
                            <div class="col-md-2">
                                <img style="max-width: 200px; max-height: 200px;" class="w-full h-full object-center object-cover" src="{{ $attachment->temporaryUrl() }}">
                            </div>
                        @empty
                            Sem anexos
                        @endforelse
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <h2 class="mb-6" style="margin-top: 1rem; background-color: aqua; padding: 5px;"> Status da Negociação </h2>
            <div class="col-md-12">
                <label for="status_negotiation" class="">Status da Negociação</label>
                <select id="status_negotiation"
                        wire:model="client.status_negotiation_id" required
                        class="form-control">
                    <option selected>Selecione o Status</option>
                    @foreach($status_negotiations as $status_negotiation)
                        <option value="{{$status_negotiation->id}}">{{$status_negotiation->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit"
                    wire:click.prevent="store"
                    class="btn btn-primary">Cadastrar
            </button>
        </div>
    </form>
