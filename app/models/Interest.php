<?php

class Interest extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Interest';
    protected $with = array('volunteerInterest');
    public static $description = array(
        'Building Site - General Labour',
        'Building Site - Meals (Providing',
        'Building Site - Safety/First Aid',
        'Building Site - Trades',
        'Committee - Board Member',
        'Committee - Church Relations',
        'Committee - Communications',
        'Committee - Construction',
        'Committee - Family Partnering/Selection',
        'Committee - Fundraising',
        'ReStore - Administration/Cashier',
        'ReStore - Appliance Testing',
        'ReStore - Marketing',
        'ReStore - Inventory',
        'ReStore - Warehouse',
        'ReStore - Clean Up',
        'Office - Accounting/Bookkeeping',
        'Office - Clerical',
        'Office - Database Administration',
        'Office - Data Entry',
        'Office - Newsletter',
        'Office - Making Calls');

    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id', 'description',);

}
