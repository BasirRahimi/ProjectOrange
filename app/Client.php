<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Get the executors record for this client (section 1)
     */
    public function Executors()
    {
        return $this->hasOne('App\Client\Executors');
    }

    /**
     * Get the powers of attorney record for this client (section 2)
     */
    public function PowersOfAttorney()
    {
        return $this->hasOne('App\Client\PowersOfAttorney');
    }

    /**
     * Get the will record for this client (section 3)
     */
    public function Will()
    {
        return $this->hasOne('App\Client\Will');
    }
    
    /**
     * (section 4)
     */
    public function LifetimeGifts()
    {
        return $this->hasOne('App\Client\LifetimeGifts');
    }

    /**
     * (section 5)
     */
    public function Gifts()
    {
        return $this->hasOne('App\Client\Gifts');
    }

    /**
     * (section 6)
     */
    public function UKBritishIsles()
    {
        return $this->hasOne('App\Client\UKBritishIsles');
    }

    /**
     * (section 7)
     */
    public function TaxHavens()
    {
        return $this->hasOne('App\Client\TaxHavens');
    }

    /**
     * (section 8)
     */
    public function NilRateBand()
    {
        return $this->hasOne('App\Client\NilRateBand');
    }

    /**
     * (section 9)
     */
    public function BusinessInterests()
    {
        return $this->hasOne('App\Client\BusinessInterests');
    }

    /**
     * (section 10)
     */
    public function ReceivedInheritance()
    {
        return $this->hasOne('App\Client\ReceivedInheritance');
    }

    /**
     * (section 11)
     */
    public function Trusts()
    {
        return $this->hasOne('App\Client\Trusts');
    }

    /**
     * (section 12)
     */
    public function Pensions()
    {
        return $this->hasOne('App\Client\Pensions');
    }

    /**
     * (section 13)
     */
    public function LifeAssurance()
    {
        return $this->hasOne('App\Client\LifeAssurance');
    }

    /**
     * (section 14)
     */
    public function JointHeldAssets()
    {
        return $this->hasOne('App\Client\JointHeldAssets');
    }

    /**
     * (section 15)
     */
    public function StocksShares()
    {
        return $this->hasOne('App\Client\StocksShares');
    }

    /**
     * (section 16)
     */
    public function BanksSavings()
    {
        return $this->hasOne('App\Client\BanksSavings');
    }

    /**
     * (section 17)
     */
    public function PersonalBelongings()
    {
        return $this->hasOne('App\Client\PersonalBelongings');
    }

    /**
     * (section 18)
     */
    public function Assets()
    {
        return $this->hasOne('App\Client\Assets');
    }

    /**
     * (section 19)
     */
    public function Liabilities()
    {
        return $this->hasOne('App\Client\Liabilities');
    }

    /**
     * (section 20)
     */
    public function OtherInformation()
    {
        return $this->hasOne('App\Client\OtherInformation');
    }
}
