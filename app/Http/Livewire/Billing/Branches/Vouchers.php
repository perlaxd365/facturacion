<?php

namespace App\Http\Livewire\Billing\Branches;

use App\Models\Invoice;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Vouchers extends Component
{
    public $company, $branch;
    public $voucher_id = "";
    public $serie, $correlativo;

    public function getVouchersProperty()
    {
        return Voucher::whereDoesntHave('branches', function ($query){
            $query->where('branch_id', $this->branch->id);
        })->get();;
    }

    public function save()
    {

        $this->validate([
            'voucher_id' => 'required',
            'serie' => [
                'required',
                new \App\Rules\SerieFormatRule($this->voucher_id)
            ],
            'correlativo' => 'required'
        ],[],[
            'voucher_id' => 'voucher',
        ]);

        $branches = $this->company->branches()->pluck('id');

        $exists = DB::table('branch_voucher')
            ->whereIn('branch_id', $branches)
            /* ->where('voucher_id', $this->voucher_id) */
            ->where('serie', $this->serie)
            ->exists();

        if($exists){

            $this->emit('sweetAlert', [
                'icon' => 'error',
                'title' => 'Oops...',
                'text' => 'Esta serie ya se encuentra registrada'
            ]);

            return;
        }

        $this->branch->vouchers()->attach($this->voucher_id, [
            'serie' => strtoupper($this->serie),
            'correlativo' => $this->correlativo
        ]);

        $this->reset(['voucher_id', 'serie', 'correlativo']);
        
        $this->emit('sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El serial se ha registrado correctamente.'
        ]);
    }

    public function delete($id){


        $branch_voucher = DB::table('branch_voucher')
            ->where('branch_id', $this->branch->id)
            ->where('voucher_id', $id)
            ->first();

        $invoice = Invoice::where('branch_id', $this->branch->id)
            ->where('serie', $branch_voucher->serie)
            ->exists();

        if($invoice){
            
            $this->emit('sweetAlert', [
                'icon' => 'error',
                'title' => 'Oops...',
                'text' => 'No se puede eliminar este serial porque ya tiene comprobantes emitidos.'
            ]);

            return;
        }

        $this->branch->vouchers()->detach($id);
        
        $this->emit('sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El serial se ha eliminado correctamente.'
        ]);

    }

    public function render()
    {
        return view('livewire.billing.branches.vouchers');
    }
}
