<?php

namespace Tests\Models;

use App\Activities;
use App\Address;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class AddressTests extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * Testing if create event is triggered
     */
    public function testCreate()
    {
        $userAddress = factory(Address::class)->create();
        $activityRecords = Activities::all();
        $activity = $activityRecords->get(1);
        $this->assertEquals($userAddress->id, $activity->resource_id);
        $this->assertEquals($userAddress->getTable(), $activity->table_name);
    }

    /**
     * @test
     * Testing if update event is triggered
     */
    public function testUpdate()
    {
        $userAddress = factory(Address::class)->create();

        $updatedUser = [
            'address1' => $this->faker->streetName,
            'address2' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
            'user_id' => $userAddress->user_id,
        ];

        $userAddress->address1 = $updatedUser['address1'];
        $userAddress->address1 = $updatedUser['address2'];
        $userAddress->city = $updatedUser['city'];
        $userAddress->state = $updatedUser['state'];
        $userAddress->zip = $updatedUser['zip'];
        $userAddress->country = $updatedUser['country'];
        //  $userAddress->address1 = $updatedUser['last_name'];

        $activityRecords = Activities::all();
        $activity = $activityRecords->get(1);
        $this->assertEquals($userAddress->id, $activity->resource_id);
        $this->assertEquals($userAddress->getTable(), $activity->table_name);
    }

    /**
     * @test
     * Testing if delete event is triggered
     */
    public function testDelete()
    {
        $userAddress = factory(Address::class)->create();
        $userArray = $userAddress->getAttributes();
        $userAddress->delete();

        $activityRecords = Activities::all();
        $activity = $activityRecords->get(1);
        //$activity = Activities::latest()->first();
        $this->assertDatabaseMissing('user_address', $userArray);
        $this->assertEquals($userAddress->id, $activity->resource_id);
        $this->assertEquals($userAddress->getTable(), $activity->table_name);
    }
}
