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
        return \Company::orderBy('company_name','asc')->paginate(20);        
    }
    
    public function saveCompany($company)
    {       
        $company->save();
    }
}
