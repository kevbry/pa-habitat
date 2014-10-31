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
    public function saveContact($contact, $values);
}
