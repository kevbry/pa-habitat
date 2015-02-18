<?php
namespace App\Repositories;

/**
 * Description of ContactRepository
 *
 * @author cst222, cst210
 */
interface ContactRepository 
{
    public function getContact($id);
    public function getAllContacts();
    public function getAllContactsForSeed();
    public function saveContact($contact);
    public function orderBy($sort,$order);
    public function getContactSearchInfo($filter);
}
