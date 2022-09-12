@section('title', 'Dashboard')
<div>
<div class="text-center"><h1>Seja Bem vindo ao LL Solar System!</h1></div><br><br>

<div class="col-sm-4">
   <div class="box-content">
					<div class="statistics-box with-icon" onclick="window.location.href='{{route('customers')}}'" style="cursor:pointer;">
						<i class="ico ti-user text-primary"></i>
						<h2 class="counter text-primary">{{$customers->count()}}</h2>
						<p class="text">Clientes cadastrados</p>
					</div>
					<!-- .statistics-box .with-icon -->
				</div>
         </div>
</div>
