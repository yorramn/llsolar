<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Customer\Customer;
use App\Models\Locales\City;
use App\Models\Locales\State;
use App\Models\StatusNegotiation;
use App\Services\CustomerService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Manny\Manny;

class Cliente extends Component
{
    use WithFileUploads;
    public $client;
    public $address;
    public $count = 0;
    public $status_negotiations;
    public bool $isAlwaysTitular = false;
    public $titular;
    public $allDependents = [];
    public $attachments;
    public $states;
    public $cities;

    protected $rules = [
        'client.name' => 'required|string',
        'client.cellphone' => 'required|string',
        'client.email' => 'required|string|email',

        'address.cep' => 'required',
        'address.street' => 'required',
        'address.district' => 'required',
        'address.city' => 'required',
        'address.state' => 'required',
        'address.number' => 'required',
        'address.complement' => 'sometimes|min:3',

    ];

    protected $messages = [
        'client.name.required' => 'Nome completo do cliente é obrigatório',


        'client.cellphone.required' => 'Número para contato do cliente é obrigatório', // falta a validação do cpf

        'client.email.required' => 'Email do cliente é obrigatório',
        'client.email.email' => 'Email do cliente deve ser válido',

        'address.cep.required' => 'CEP do cliente é obrigatório',

        'address.street.required' => 'Logradouro do cliente é obrigatório',

        'address.district.required' => 'Bairro do cliente é obrigatório',

        'address.city.required' => 'Cidade do cliente é obrigatório',

        'address.state.required' => 'Estado do cliente é obrigatório',

        'address.number.required' => 'Número do Logradouro do cliente é obrigatório',

        'address.complement.min' => 'Complemento do endereço do cliente deve ter no mínimo 3 caractéres.',
    ];


    public function updated($field){
        switch ($field){
            case 'address.cep':
                $this->address['cep'] = Manny::stripper($this->address['cep'], ['num']);
                $this->address['cep'] = Manny::mask($this->address['cep'], '11111111');
                break;
            case 'address.state':
                $this->cities = City::query()
                    ->where('state_id', $this->address['state'])
                    ->orderBy('name')
                    ->get();
                break;
            case 'client.cpf':
                $this->client['cpf'] = Manny::stripper($this->client['cpf'], ['num']);
                $this->client['cpf'] = Manny::mask($this->client['cpf'], '11111111111');
                break;
            case 'client.cnpj':
                $this->client['cnpj'] = Manny::stripper($this->client['cnpj'], ['num']);
                break;
            case 'client.cellphone':
                $this->client['cellphone'] = Manny::stripper($this->client['cellphone'], ['num']);
                $this->client['cellphone'] = Manny::mask($this->client['cellphone'], '11111111111');
                break;
            default:
                break;
        }
    }

    public function mount()
    {
        $this->states = State::query()
            ->where('country_id', 1)
            ->orderBy('name')
            ->get();
        $this->status_negotiations = StatusNegotiation::all();
        $this->allDependents = [[]];
    }

    public function render()
    {
        return view('livewire.clientes.create');
    }

    public function store()
    {
        if(is_null($this->client))
        {
            session()->flash('message', 'Preencha corretamente os dados do cliente!');
            session()->flash('class', 'danger');
            return redirect()->to("/cliente");
        }
        if(!array_key_exists('status_negotiation_id', $this->client))
        {
            session()->flash('message', 'Selecione a etapa da negociação!');
            session()->flash('class', 'danger');
            return redirect()->to("/cliente");
        }
        if(!isset($this->attachments)){
            session()->flash('message', 'Você não anexou os documentos. O anexo é obrigatório!!');
            session()->flash('class', 'danger');
            return redirect()->to("/cliente");
        }
        if(!$this->isAlwaysTitular && isset($this->client['cpf'])){
            $this->titular['cpf'] = $this->client['cpf'];
        }
        $data['address'] = $this->address;
        $cep = explode('-', $this->address['cep']);
        $data['address']['cep'] = implode("", $cep);
        $data['dependents'] = array_filter($this->allDependents);
        $data['titular'] = $this->titular;
        $data['attachments'] = $this->attachments;
        $data['client'] = $this->client;
        $customerService = new CustomerService();
        $customer = $customerService->updateOrCreateCustomer($data);
        if(!$customer){
            session()->flash('message', 'Erro ao atualizar Cliente!');
            session()->flash('class', 'success');
            return redirect()->to("/cliente");
        }
        session()->flash('message', 'Cliente cadastrado com sucesso!');
        session()->flash('class', 'success');
        return redirect()->to("/cliente");
    }

    public function addDependent()
    {
        $this->allDependents[] = [];
    }

    public function removeDependent($index)
    {
        unset($this->allDependents[$index]);
        $this->allDependents = array_values($this->allDependents);
    }

    public function defineIsAlwaysTitular()
    {
        $this->isAlwaysTitular = !$this->isAlwaysTitular;
        if($this->isAlwaysTitular === true){
            $this->titular = null;
        }
    }
}
