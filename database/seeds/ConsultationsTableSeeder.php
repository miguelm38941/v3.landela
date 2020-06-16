<?php

use Illuminate\Database\Seeder;
use \App\Consultation;

class ConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consultation::create(['pvv_id' => 2, 'agent_id' => 3, 
        'medecin_id' => 5,'infirmier_id' => 4
        ]);
        
        Consultation::create(['pvv_id' => 2, 'agent_id' => 3, 
        'medecin_id' => 5,'infirmier_id' => 4
        ]);    
    }
}
