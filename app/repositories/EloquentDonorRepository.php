<?php

namespace App\Repositories;

class EloquentDonorRepository implements DonorRepository {

    public function getDonor($id) {
        return \Donor::find($id);
    }

    public function getAllDonors() {
        return \Donor::join('Contact', 'Donor.id', '=', 'Contact.id')->orderBy('first_name', 'asc')->paginate(20);
    }

    public function saveDonor($donor) {
        $donor->save();
    }

    public function orderBy($sort, $order) {

        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sort) {
            case 'l':
                $sortby = 'first_name';
                break;
            case 'e':
                $sortby = 'email_address';
                break;
        }

        return \Donor::join('Contact', 'Donor.id', '=', 'Contact.id')->orderBy($sortby, $order)->paginate(20);
    }

}
