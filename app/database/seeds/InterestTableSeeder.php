<?php

class InterestTableSeeder extends Seeder 
{
    
    /**
     * NOTE: This data should be kept accurate and up to date for production 
     * usage.
     * 
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     * Template Interest:
     * Interest::create(array(  'description' => '' ));
     */
    public function run()
    {
        DB::table('Interest')->delete();
        
        // Building Site
        Interest::create(array(  'description' => 'Building Site - General Labour' ));
        Interest::create(array(  'description' => 'Building Site - Meals (Providing)' ));
        Interest::create(array(  'description' => 'Building Site - Safety/First Aid' ));
        Interest::create(array(  'description' => 'Building Site - Trades' ));
        
        //Committee
        Interest::create(array(  'description' => 'Committee - Board Member' ));
        Interest::create(array(  'description' => 'Committee - Church Relations' ));
        Interest::create(array(  'description' => 'Committee - Communications' ));
        Interest::create(array(  'description' => 'Committee - Construction' ));
        Interest::create(array(  'description' => 'Committee - Family Partnering/Selection' ));
        Interest::create(array(  'description' => 'Committee - Fundraising' ));
        
        //ReStore
        Interest::create(array(  'description' => 'ReStore - Administration/Cashier' ));
        Interest::create(array(  'description' => 'ReStore - Appliance Testing' ));
        Interest::create(array(  'description' => 'ReStore - Marketing' ));
        Interest::create(array(  'description' => 'ReStore - Inventory' ));
        Interest::create(array(  'description' => 'ReStore - Warehouse' ));
        Interest::create(array(  'description' => 'ReStore - Clean Up' ));
        
        //Office
        Interest::create(array(  'description' => 'Office - Accounting/Bookkeeping' ));
        Interest::create(array(  'description' => 'Office - Clerical' ));
        Interest::create(array(  'description' => 'Office - Database Administration' ));
        Interest::create(array(  'description' => 'Office - Data Entry' ));
        Interest::create(array(  'description' => 'Office - Newsletter' ));
        Interest::create(array(  'description' => 'Office - Making Calls' ));
    }

}

