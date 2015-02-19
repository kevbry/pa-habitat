<?php
use App\Repositories\EloquentFamilyRepository;

class ProjectTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('Project')->delete();
        
        $curFamily = 0;
        $familyRepo = new EloquentFamilyRepository();
        $familyIDs = $familyRepo->getAllFamiliesForSeed();
        shuffle($familyIDs);
        $projectJson = File::get(storage_path() . "/jsondata/project.json");
		$projects = json_decode($projectJson);
		foreach ($projects as $project) {
                    echo "Adding Project: " . $project->name . ".\n";
			Project::create(array(
				'name' => $project->name, 
                                'build_number' => $project->build_number, 
                                'street_number' => $project->street_number,
                                'postal_code' => $project->postal_code,
                                'city' => $project->city, 
                                'province' => $project->province, 
                                'building_permit_number' => $project->building_permit_number,
                                'building_permit_date' => $project->building_permit_date,
                                'blueprint_plan_number' => $project->blueprint_plan_number,
                                'blueprint_designer' => $project->blueprint_designer,
                                'family_id' => $familyIDs[$curFamily]
			));
                        $curFamily++;
		}
    }

}

