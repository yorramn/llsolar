<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Customer\Customer;
use App\Models\Locales\City;
use App\Models\Locales\State;
use App\Models\StatusNegotiation;
use App\Services\CustomerService;
use http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination, WithFileUploads;
    public $showCustomer;
    public bool $edit = false;
    public $allDependents = [];
    public $newAttachments = [];
    public $status_negotiations;
    public $states;
    public $cities;
    public $attachments = [];
    public $data;

//    protected $rules = ['data.customer.name' => 'required'];
//    protected $messages = [
//        'data.customer.name.required' => 'Nome é obrigatório'
//    ];

    public function render()
    {
        $customerService = new CustomerService();
        return view('livewire.clientes.clientes',
         [
             'customers' => $customerService->getAllCustomers(15)
         ]);
    }

    public function mount()
    {
        $this->states = State::query()
            ->where('country_id', 1)
            ->orderBy('name')
            ->get();
        $this->cities = City::query()->orderBy('name')->get();
        $this->status_negotiations = StatusNegotiation::all();
        $this->edit = false;
    }

//    public function updated($propertyName)
//    {
//        $this->validateOnly($propertyName);
//    }


    public function showCustomer($id)
    {
        $this->showCustomer = Customer::query()->findOrFail($id);
        $this->cities = City::query()->whereStateId($this->showCustomer->address->city->state->id)->get();
        $this->data['customer'] = $this->showCustomer;
        $this->allDependents = $this->showCustomer->dependents->toArray();
        $this->attachments = $this->showCustomer->attachments->toArray();
    }

    public function canEditFields()
    {
        $this->edit = !$this->edit;
    }

    public function save()
    {
        //$this->data = $this->validate();
        $this->data['customer']['dependents'] = $this->allDependents;
        $this->attachments = array_merge($this->attachments, Arr::flatten($this->newAttachments));
        $this->data['customer']['attachments'] = $this->newAttachments;
        $customerService = new CustomerService();
        $this->data['client'] = $this->data['customer'];
        $this->data['address'] = $this->data['customer']['address'];
        $this->data['titular'] = $this->data['customer']['titular'] ?? null;
        $this->data['attachments'] = $this->data['customer']['attachments'] ?? null;
        $this->data['dependents'] = $this->data['customer']['dependents'] ?? null;
        unset($this->data['customer']);
        $customer = $customerService->updateOrCreateCustomer($this->data);
        if(!$customer){
            session()->flash('message', 'Erro ao cadastrar Cliente!');
            session()->flash('class', 'danger');
            return redirect()->to("/clientes");
        }
        session()->flash('message', 'Cliente cadastrado com sucesso!');
        session()->flash('class', 'success');
        return redirect()->to("/clientes");
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


    public function removeNewAttachment($index)
    {
        unset($this->newAttachments[$index]);
        $this->newAttachments = array_values($this->newAttachments);
    }
}
