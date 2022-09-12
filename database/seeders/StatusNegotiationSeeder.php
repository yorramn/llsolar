<?php

namespace Database\Seeders;

use App\Models\StatusNegotiation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusNegotiationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Primeiro contato',
        'Orçamento enviado',
        'Orçamento Aceito',
        'Orçamento recusado',
        'Financiamento em análise',
        'Reprovado no financiamento',
        'Contrato enviado',
        'Contrado assinado',
        'Pagamento efetuado',
        'Aguardando instalação',
        'Instalação em andamento',
        'Instalação concluída',
        'Aguardando agendamento de Reparo',
        'Reparo iniciado',
        'Reparo concluído',
        'Atendimento finalizado',
        'Cancelado',
        'Outros'];
        foreach ($data as $status){
            StatusNegotiation::query()
                ->create(['name' => $status]);
        }
    }
}
