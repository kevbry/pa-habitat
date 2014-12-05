<?php
namespace App\Repositories;

class EloquentDonorRepository implements DonorRepository
{
    public function getDonor($id)
    {
        return \Donor::find($id);
    }
    
    public function getAllDonors()
    {
        return \Donor::paginate(20);     
    }
    
    public function saveDonor($donor)
    {
        $donor->save();
    }
}
