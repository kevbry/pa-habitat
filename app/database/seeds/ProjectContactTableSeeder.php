<?php
use App\Repositories\EloquentProjectRepository;


class ProjectContactTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('ProjectContact')->delete();
        
    }    
}

