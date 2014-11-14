<?php
namespace App\Repositories;

/**
 * Description of ContactRepository
 *
 * @author cst222, cst210
 */
interface DonorRepository 
{
    public function getDonor($id);
    public function getAllDonors();
    public function saveDonor($donor, $values);
}
