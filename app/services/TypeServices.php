<?php 

namespace App\Services;

use App\Models\Reason;
use Illuminate\Support\Facades\DB;

class TypeServices
{    
    public function __construct(
        private Reason $reason
    ) {
    }

    public function weight(){
        return collect([
            '0' => 'Kg',
            '1' => 'Gramas'
        ]);
    }
    public function situation() {
        $sql = DB::select("SELECT * FROM hospitalized_situation");

        return ($sql);
    }

    public function reason() {
        return $this->reason->get();
    }
}