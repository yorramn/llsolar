@section('title', 'Entre com sua conta')
    <section style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center" >
        <div class="container justify-content-center">
            <section class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12 p-3">
                    <div class="registration-form">
                        <form wire:submit.prevent="authenticate" method="post">
                            @method("POST")
                            @csrf
                            <div class="form-icon">
                                <img src="{{asset('img/logo-white.png')}}" class="img-fluid" alt="...">
                            </div>
                            <div class="form-group">
                                <input wire:model.lazy="email" type="text" class="form-control item" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input wire:model.lazy="password" type="password" class="form-control item" id="password" placeholder="Password">
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="col-6 form-check">
                                    <label class="form-check-label" for="remember">Me lembre</label>
                                    <input wire:model.lazy="remember" type="checkbox" class="form-check-input">
                                </div>
                                <div class="col-6" style="text-align: end">
                                    <a class="link-secondary" href="{{ route('password.request') }}"> Perdeu a senha? </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn w-100 btn-block create-account">{{__('buttons.enter')}}</button>
{{--                                <button type="submit" style="border-radius: 50px" class="btn mt-2 w-100 btn-block btn-lg btn-outline-secondary">{{__('buttons.create-account')}}</button>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
