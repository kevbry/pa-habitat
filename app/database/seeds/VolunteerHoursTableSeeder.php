<?php
use App\Repositories\EloquentVolunteerRepository;
use App\Repositories\EloquentFamilyRepository;
use App\Repositories\EloquentProjectRepository;


class VolunteerHoursTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('VolunteerHours')->delete();
        
 
        $volunteerRepo = new EloquentVolunteerRepository();
        $volunteerIDs = $volunteerRepo->getAllVolunteersForSeed();
        $projectRepo = new EloquentProjectRepository();
        $projectIDs = $projectRepo->getAllProjectsForSeed();
        $familyRepo = new EloquentFamilyRepository();    
        $familyIDs = $familyRepo->getAllFamiliesForSeed();
        $hoursJson = File::get(storage_path() . "/jsondata/hours.json");
		$hoursEntries = json_decode($hoursJson);
		foreach ($hoursEntries as $entry) {
                     $volunteer = array_rand($volunteerIDs);
                     $family = array_rand($familyIDs);
                     $project = array_rand($projectIDs);
                    echo "Adding Hour Entry for VolunteerID: " . $volunteerIDs[$volunteer] . 
                            ", on ProjectID: ". $projectIDs[$project]. ", for FamilyID: ". 
                            $familyIDs[$family]. ".\n";
			VolunteerHours::create(array(
				'volunteer_id' => $volunteerIDs[$volunteer], 
                                'project_id' => $projectIDs[$project], 
                                'family_id' => $familyIDs[$family],
                                'date_of_contribution' => $entry->date_of_contribution,
                                'paid_hours' => rand(0,1),
                                'hours' => rand(0,12)
			));
		}
                foreach ($hoursEntries as $entry) {
                     $volunteer = array_rand($volunteerIDs);
                     $family = array_rand($familyIDs);
                     $project = array_rand($projectIDs);
                    echo "Adding Hour Entry for VolunteerID: " . $volunteerIDs[$volunteer] . 
                            ", on ProjectID: ". $projectIDs[$project]. ", for FamilyID: ". 
                            $familyIDs[$family]. ".\n";
			VolunteerHours::create(array(
				'volunteer_id' => $volunteerIDs[$volunteer], 
                                'project_id' => $projectIDs[$project], 
                                'family_id' => $familyIDs[$family],
                                'date_of_contribution' => $entry->date_of_contribution,
                                'paid_hours' => rand(0,1),
                                'hours' => rand(0,12)
			));
		}
                foreach ($hoursEntries as $entry) {
                     $volunteer = array_rand($volunteerIDs);
                     $family = array_rand($familyIDs);
                     $project = array_rand($projectIDs);
                    echo "Adding Hour Entry for VolunteerID: " . $volunteerIDs[$volunteer] . 
                            ", on ProjectID: ". $projectIDs[$project]. ".\n";
			VolunteerHours::create(array(
				'volunteer_id' => $volunteerIDs[$volunteer], 
                                'project_id' => $projectIDs[$project], 
                                'family_id' => null,
                                'date_of_contribution' => $entry->date_of_contribution,
                                'paid_hours' => rand(0,1),
                                'hours' => rand(1,12)
			));
		}
                
    }    

}