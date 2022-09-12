<section class="container">
    <section class="row">
        <div class="col-md-12">
            <h1 class="text-center">Funcionários</h1><br>
        </div>
        <div class="col-md-12">
            <form class="row container">
                <div class="col-md-5">
                    <label for="">Nome</label>
                    <input type="text" disabled readonly class="form-control" value="{{$user->name}}">
                </div>
                <div class="col-md-5">
                    <label for="">Email</label>
                    <input type="text" disabled readonly class="form-control" value="{{$user->email}}">
                </div>
                <div class="col-md-2">
                    <label for="">Cargo</label>
                    <input type="text" disabled readonly class="form-control" value="{{$user->roles->first()->name}}">
                </div>

            </form>
        </div>
    </section>
</section>
