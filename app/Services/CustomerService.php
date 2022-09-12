<?php

namespace App\Services;

use App\Models\Customer\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerService implements \App\Repositories\CustomerRepository
{

    public function getAllCustomers(?int $paginate): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Customer::query()
            ->paginate($paginate ?? 30);
    }

    /**
     * @throws \Exception
     */
    public function updateOrCreateCustomer($data)
    {
        $customer = Customer::query()->updateOrCreate(
                [
                    'email' => $data['client']['email']
                ],
                $data['client']
        );
        if(!$customer){
            throw new \Exception('Erro ao criar cliente!');
        }
        $customer->address()->updateOrCreate(
            [
                'cep' => $data['address']['cep']
            ],
            $data['address']
        );
        if(isset($data['titular'])){
            $data_validation = [
                'cpf' => $data['titular']['cpf'],
                isset($data['titular']['old_titular_cpf']) ?
                    $data_validation[] = ['old_titular_cpf' => $data['titular']['old_titular_cpf']] : ''
            ];
            $customer->contracts()->updateOrCreate(
                $data_validation,
                $data['titular']
            );
        }
        if(count($data['dependents']) >= 1){
            $this->updateOrCreateCustomerDependents($customer, $data['dependents']);
        }
        $this->storeTemporary($data['attachments'], $customer->name, $customer);
        return $customer;
    }

    public function updateOrCreateCustomerDependents($customer, array $dependents)
    {
        foreach ($dependents as $dependent) {
            if($customer->dependents()->count() > count($dependents)){
                $customer
                    ->dependents()
                    ->whereNot('id', '=', $dependent['id'])
                    ->delete();
            }
            $customer->dependents()
                ->updateOrCreate(
                    [
                      //  'cpf' => $dependent['cpf'],
                        'customer_id' => $customer->id
                    ],
                    $dependent
                );
        }
        if(!$customer->dependents()->count()){
            throw new \Exception('Erro ao criar dependente!');
        }
    }

    public function storeTemporary($photos, string $name, $customer)
    {
        $name = str_replace([' ', '/', '-'], '_', strtolower($name));
        $basePath = "customers/attachments/${name}";
        foreach ($photos as $photo)
        {
            shell_exec("chmod 777 -R /var/www/storage");
            $link = $photo->storeAs($basePath, str_replace([' ', '/', '-'], '_', strtolower($photo->getClientOriginalName())), 'public');
           // chmod(storage_path('app/public/').$link, 775);
            $customer
                ->attachments()
                ->updateOrCreate(
                    [
                        'link' => $link,
                        'customer_id' => $customer->id
                    ],
                    [
                        'link' => $link,
                        'customer_id' => $customer->id
                    ]
                );
        }
    }
}
