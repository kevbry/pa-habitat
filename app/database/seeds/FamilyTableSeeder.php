<?php
use App\Repositories\EloquentVolunteerRepository;
use App\Repositories\EloquentFamilyRepository;

class FamilyTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('Family')->delete();
        
 
        $volunteerRepo = new EloquentVolunteerRepository();
        $volunteerIDs = $volunteerRepo->getAllVolunteersForSeed();
        $familyRepo = new EloquentFamilyRepository();        
        $familyJson = File::get(storage_path() . "/jsondata/family.json");
		$families = json_decode($familyJson);
		foreach ($families as $family) {
                    echo "Adding Family: " . $family->name . ".\n";
			Family::create(array(
				'name' => $family->name, 
                                'status' => $family->status, 
                                'comments' => $family->comments
			));
		}
                
        $familyIDs = $familyRepo->getAllFamiliesForSeed();
            foreach($familyIDs as $familyID)
            {
                echo "Adding contacts to FamilyID: ". $familyID . ".\n";
                shuffle($volunteerIDs);
//                echo "Adding volunteer to FamilyID: ". $familyID . ", ". 
//                        $volunteerIDs[0] . ".\n";
                FamilyContact::create(array(
                    'family_id' => $familyID,
                    'primary' => 1,
                    'currently_active' => 1,
                    'contact_id' => $volunteerIDs[0]
                ));
                
//                echo "Adding volunteer to FamilyID: ". $familyID . ", ". 
//                        $volunteerIDs[1] . ".\n";
                FamilyContact::create(array(
                    'family_id' => $familyID,
                    'primary' => 1,
                    'currently_active' => 1,
                    'contact_id' => $volunteerIDs[1]
                ));
                
//                echo "Adding volunteer to FamilyID: ". $familyID . ", ". 
//                        $volunteerIDs[2] . ".\n";
                FamilyContact::create(array(
                    'family_id' => $familyID,
                    'primary' => 0,
                    'currently_active' => rand(0, 1),
                    'contact_id' => $volunteerIDs[2]
                ));
                
//                echo "Adding volunteer to FamilyID: ". $familyID . ", ". 
//                        $volunteerIDs[3] . ".\n";
                FamilyContact::create(array(
                    'family_id' => $familyID,
                    'primary' => 0,
                    'currently_active' => rand(0, 1),
                    'contact_id' => $volunteerIDs[3]
                ));
                
//                echo "Adding volunteer to FamilyID: ". $familyID . ", ". 
//                        $volunteerIDs[4] . ".\n";
                FamilyContact::create(array(
                    'family_id' => $familyID,
                    'primary' => 0,
                    'currently_active' => rand(0, 1),
                    'contact_id' => $volunteerIDs[4]
                ));
            }
    }    

}