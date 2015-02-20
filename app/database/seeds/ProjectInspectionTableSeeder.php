<?php
use App\Repositories\EloquentProjectRepository;


class ProjectInspectionTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('ProjectInspection')->delete();
        
 
        $projectRepo = new EloquentProjectRepository();
        $projectIDs = $projectRepo->getAllProjectsForSeed();
        $currProj = 0;
        $inspectionsJson = File::get(storage_path() . "/jsondata/hours.json");
        $inspectionsEntries = json_decode($inspectionsJson);
        
        foreach ($inspectionsEntries as $inspection) 
        {
            $project = array_rand($projectIDs);
            echo "Adding Electrical Inspection to Project ID: " . $projectIDs[$currProj] 
                    . ".\n";
                ProjectInspection::create(array(
                    'project_id' => $projectIDs[$currProj],
                    'mandatory' => rand(0,1),
                    'date' => $inspection->date_of_contribution,
                    'type' => "Electrical", 
                    'pass' => rand(0,1)
                ));
            $currProj++;
        }
        
        $currProj = 0;
        shuffle($projectIDs);
        
        foreach ($inspectionsEntries as $inspection) 
        {
            $project = array_rand($projectIDs);
            echo "Adding Plumbing Inspection to Project ID: " . $projectIDs[$currProj] 
                    . ".\n";
                ProjectInspection::create(array(
                    'project_id' => $projectIDs[$currProj],
                    'mandatory' => rand(0,1),
                    'date' => $inspection->date_of_contribution,
                    'type' => "Plumbing", 
                    'pass' => rand(0,1)
                ));
            $currProj++;
        }
        
        $currProj = 0;
        shuffle($projectIDs);
        
        foreach ($inspectionsEntries as $inspection) 
        {
            $project = array_rand($projectIDs);
            echo "Adding Structure Inspection to Project ID: " . $projectIDs[$currProj] 
                    . ".\n";
                ProjectInspection::create(array(
                    'project_id' => $projectIDs[$currProj],
                    'mandatory' => rand(0,1),
                    'date' => $inspection->date_of_contribution,
                    'type' => "Structure", 
                    'pass' => rand(0,1)
                ));
            $currProj++;
        }
        
        $currProj = 0;
        shuffle($projectIDs);
        
        foreach ($inspectionsEntries as $inspection) 
        {
            $project = array_rand($projectIDs);
            echo "Adding Fire Inspection to Project ID: " . $projectIDs[$currProj] 
                    . ".\n";
                ProjectInspection::create(array(
                    'project_id' => $projectIDs[$currProj],
                    'mandatory' => rand(0,1),
                    'date' => $inspection->date_of_contribution,
                    'type' => "Fire", 
                    'pass' => rand(0,1)
                ));
            $currProj++;
        }
        
        $currProj = 0;
        shuffle($projectIDs);
        
        foreach ($inspectionsEntries as $inspection) 
        {
            $project = array_rand($projectIDs);
            echo "Adding Ventilation Inspection to Project ID: " . $projectIDs[$currProj] 
                    . ".\n";
                ProjectInspection::create(array(
                    'project_id' => $projectIDs[$currProj],
                    'mandatory' => rand(0,1),
                    'date' => $inspection->date_of_contribution,
                    'type' => "Ventilation", 
                    'pass' => rand(0,1)
                ));
            $currProj++;
        }
    }    

}

