<?php
use App\Repositories\EloquentProjectRepository;


class ProjectItemsTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('ProjectItem')->delete();
        
 
        $projectRepo = new EloquentProjectRepository();
        $projectIDs = $projectRepo->getAllProjectsForSeed();
        $itemsJson = File::get(storage_path() . "/jsondata/items.json");
		$itemsEntries = json_decode($itemsJson);
		foreach ($itemsEntries as $item) 
                    {
                        $project = array_rand($projectIDs);
                        echo "Adding Item to Project ID: " . $projectIDs[$project] 
                                . ".\n";
                            ProjectItem::create(array(
                                'project_id' => $projectIDs[$project], 
                                'item_type' => $item->item_type, 
                                'manufacturer' => $item->manufacturer,
                                'model' => $item->model,
                                'serial_number' => $item->serial_number,
                                'vendor' => $item->vendor,
                                'comments' => $item->comments
                            ));
                    }
                    
        $itemsJson = File::get(storage_path() . "/jsondata/items2.json");
		$itemsEntries = json_decode($itemsJson);
		foreach ($itemsEntries as $item) 
                    {
                        $project = array_rand($projectIDs);
                        echo "Adding Item to Project ID: " . $projectIDs[$project] 
                                . ".\n";
                            ProjectItem::create(array(
                                'project_id' => $projectIDs[$project], 
                                'item_type' => $item->item_type, 
                                'manufacturer' => $item->manufacturer,
                                'model' => $item->model,
                                'serial_number' => $item->serial_number,
                                'vendor' => $item->vendor,
                                'comments' => $item->comments
                            ));
                    }
                    
        $itemsJson = File::get(storage_path() . "/jsondata/items3.json");
		$itemsEntries = json_decode($itemsJson);
		foreach ($itemsEntries as $item) 
                    {
                        $project = array_rand($projectIDs);
                        echo "Adding Item to Project ID: " . $projectIDs[$project] 
                                . ".\n";
                            ProjectItem::create(array(
                                'project_id' => $projectIDs[$project], 
                                'item_type' => $item->item_type, 
                                'manufacturer' => $item->manufacturer,
                                'model' => $item->model,
                                'serial_number' => $item->serial_number,
                                'vendor' => $item->vendor,
                                'comments' => $item->comments
                            ));
                    }
                    
        $itemsJson = File::get(storage_path() . "/jsondata/items4.json");
		$itemsEntries = json_decode($itemsJson);
		foreach ($itemsEntries as $item) 
                    {
                        $project = array_rand($projectIDs);
                        echo "Adding Item to Project ID: " . $projectIDs[$project] 
                                . ".\n";
                            ProjectItem::create(array(
                                'project_id' => $projectIDs[$project], 
                                'item_type' => $item->item_type, 
                                'manufacturer' => $item->manufacturer,
                                'model' => $item->model,
                                'serial_number' => $item->serial_number,
                                'vendor' => $item->vendor,
                                'comments' => $item->comments
                            ));
                    }
    }    

}
