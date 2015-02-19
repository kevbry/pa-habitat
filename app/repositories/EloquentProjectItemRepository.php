<?php
/**
 *
 * @author cst210
 */
namespace App\Repositories;

class EloquentProjectItemRepository implements ProjectItemRepository {

    public function getItemsForProject($id) {
        return \ProjectItem::whereRaw('project_id =' . $id)->orderBy('item_type', 'asc')->paginate(20);
    }

    public function saveProjectItem($projectItem) {
        $projectItem->save();
    }
    
    public function getItemsForProjectNonPaginated($id) {
        return \ProjectItem::whereRaw('project_id =' . $id)->orderBy('item_type', 'asc')->get();
    }

}
