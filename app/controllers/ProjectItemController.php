<?php

use App\Repositories\ProjectItemRepository;
use App\Repositories\ProjectRepository;

class ProjectItemController extends \BaseController {

    public $projectRepo;
    public $projectItemRepo;

    public function __construct(ProjectItemRepository $projectItemRepo, ProjectRepository $projectRepo) {

        $this->projectRepo = $projectRepo;
        $this->projectItemRepo = $projectItemRepo;
    }

    public function index($projectId) {

        $project = $this->projectRepo->getProject($projectId);
        $projectItems = $this->projectItemRepo->getItemsForProject($projectId);

        return View::make('projectitem.index', array('project' => $project, 'projectItems' => $projectItems));
    }
    
    public function create($projectId) {
        $itemTypes = \ProjectItem::$types;
        $project = $this->projectRepo->getProject($projectId);
        return View::make('projectitem.create', array('id' => $projectId, 'itemTypes' => $itemTypes,
                    'project' => $project));
    }

    public function store() {
        $projectItem = array();
        for ($i = 0; $i < count(Input::get('project_id')); $i++) {
            $projectItem['project_id'] = Input::get('project_id')[$i];
            $projectItem['item_type'] = Input::get('item_type')[$i];
            $projectItem['manufacturer'] = Input::get('manufacturer')[$i];
            $projectItem['model'] = Input::get('model')[$i];
            $projectItem['serial_number'] = Input::get('serial_number')[$i];
            $projectItem['vendor'] = Input::get('vendor')[$i];
            $projectItem['comments'] = Input::get('comments')[$i];

            if (empty($projectItem)) {
                throw new Exception('No Project Item info inserted.');
            }
            $this->storeItemWith($projectItem);
        }

        return Redirect::action('ProjectItemController@index', $projectItem['project_id']);

    }
    
    public function edit($projectId) {
        $itemTypes = \ProjectItem::$types;
        $project = $this->projectRepo->getProject($projectId);
        $projectItems = $this->projectItemRepo->getItemsForProjectNonPaginated($projectId);

        return View::make('projectitem.edit', array('project' => $project, 'itemTypes' => $itemTypes, 'projectItems' => $projectItems));
    }
    
    public function update() {
        $projectItem = array();
        $infoArray = array();
        for ($i = 0; $i < count(Input::get('id')); $i++) {
            //$projectItem['project_id'] = Input::get('project_id');
            $projectItem['id'] = Input::get('id')[$i];
            $projectItem['item_type'] = Input::get('item_type')[$i];
            $projectItem['manufacturer'] = Input::get('manufacturer')[$i];
            $projectItem['model'] = Input::get('model')[$i];
            $projectItem['serial_number'] = Input::get('serial_number')[$i];
            $projectItem['vendor'] = Input::get('vendor')[$i];
            $projectItem['comments'] = Input::get('comments')[$i];

            if (empty($projectItem)) {
                throw new Exception('No Project Item info inserted.');
            }
            $this->updateItemWith($projectItem);
            
            $infoArray[$i] = $projectItem;
        }
        $id = Input::get('project_id');
        
        $itemArray = $this->projectItemRepo->getItemsForProjectNonPaginated($id);
        if(!empty($itemArray))
        {
            foreach($itemArray as $itemEntry)
            {
                $bFound = false;
                if(!empty($infoArray))
                {
                    foreach($infoArray as $formEntry)
                    {
                        if( strval($itemEntry['id']) == $formEntry['id'] )
                        {
                            $bFound = true;
                        }
                    }
                }
                if(!$bFound)
                {
                    $affectedRows = ProjectItem::where('id','=',$itemEntry['id'])->delete();
                }
            }     
        }
        return Redirect::action('ProjectItemController@index', $id);
    }
    
    public function updateItemWith($projectItem) {
        $counter = 0;
        $fieldNames = array(
            //'project_id',
            'id', 
            'item_type',
            'manufacturer',
            'model',
            'serial_number', 
            'vendor',
            'comments'
        );
        $fieldUpdateValues = array();
        foreach($projectItem as $fieldValue)
        {
            if($counter != 0)
            {
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            }
            $counter++; 
        }
        $affectedRows = ProjectItem::where('id','=',$projectItem['id'])->update($fieldUpdateValues);
    }

    public function storeItemWith($projectItem) {

        $item = new ProjectItem($projectItem);

        // Store item
        $this->projectItemRepo->saveProjectItem($item);

        return $item->id;
    }   
}
