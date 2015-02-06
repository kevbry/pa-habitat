<?php
namespace App\Repositories;

/**
 * Description of ProjectItemRepository
 *
 * @author cst210
 */
interface ProjectItemRepository {
    public function getItemsForProject($id);
    public function saveProjectItem($projectItem);
}
