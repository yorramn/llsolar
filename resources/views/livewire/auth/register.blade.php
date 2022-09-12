@section('title', 'Registrar nova conta')



    <div class="container-sm-4 bg-white justify-content-center">


        <div class="" style="padding: 20px;">
            <form wire:submit.prevent="register">
                    <h3 class="">
                       Cadastre-se agora
                    </h3>
                    @if (Route::has('login'))
                        <p class="">
                            Ou
                            <a href="{{ route('login') }}" class="" style="color: blue;">
                                entre com sua conta
                            </a>
                        </p>
                    @endif

                <div>
                    <label for="name" class="">
                        Nome
                    </label>

                    <div class="">
                        <input wire:model.lazy="name" id="name" type="text" required autofocus class="form-control text-center @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label for="email" class="">
                        Email
                    </label>

                    <div class="">
                        <input wire:model.lazy="email" id="email" type="email" required class="form-control text-center @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label for="password" class="">
                        Senha
                    </label>

                    <div class="">
                        <input wire:model.lazy="password" id="password" type="password" required class="form-control text-center @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label for="password_confirmation" class="">
                        Confirme a senha
                    </label>

                    <div class="">
                        <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required class="form-control text-center" />
                    </div>
                </div>

                <div class=""><br>
                    <span class="">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Registrar
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

</div>