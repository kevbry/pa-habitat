<?php
namespace App\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EloquentCompanyRepository
 *
 * @author cst217
 */
class EloquentCompanyRepository  implements CompanyRepository
{
    //put your code here
    public function getCompany($id)
    {
        return \Company::find($id);
    }
    
    
    public function  getAllCompanies()
    {
        return \Company::all();        
    }
    public function saveCompany($company, $values)
    {       
        $company->save();
    }
}
