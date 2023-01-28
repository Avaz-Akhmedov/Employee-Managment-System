<?php

namespace Tests\Feature\Ems;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{


    public function test_if_admin_can_create_country()
    {
        $country = Country::factory()->create();
     $response =  $this->post("/admin/countries/create",[
           "name" =>  $country->name,
           "country_code" => $country->country_code
       ]);


    }
}
