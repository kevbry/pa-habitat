<?php
namespace App\Repositories;

/**
 * Description of ContactRepository
 *
 * @author cst217, cst210
 */
interface VolunteerHoursRepository {
    public function getHoursForProject($id);
    public function getAllHours();
    public function saveVolunteerHours($volunteerHours);
    public function getHoursForVolunteer($volunteerId);
}
