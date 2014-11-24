<?php
namespace App\Repositories;

/**
 * Description of CompanyRepository
 * 
 * 
 * @author cst217, cst220
 */

interface CompanyRepository 
{
    public function getCompany($id);
    public function getAllCompanies();
    public function saveCompany($company, $values);    
}