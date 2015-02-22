<?php
namespace App\Repositories;

/**
 * Description of ContactRepository
 *
 * @author cst217, cst210
 */
interface VolunteerHoursRepository {
    public function getHoursForProject($id);
    public function getHoursForFamily($family_id);
    public function getAllHours();
    public function saveVolunteerHours($volunteerHours);
    public function getHoursForVolunteer($volunteerId);
    public function getHoursForVolunteerNonPaginated($volunteerId);
    public function orderBy($sortby, $order);
    public function getHoursForVolunteerSortedByProject($volunteerId);
    public function getHoursForProjectSortedByVolunteer($projectId);
    public function getHoursForProjectNonPaginated($projectId);
    
}
