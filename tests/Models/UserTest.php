<?php

namespace Tests\Models;

use App\Activities;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class UserTests extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * Testing if create event is triggered
     */
    public function testCreate()
    {
        $user = factory(User::class)->create();
        $activity = Activities::latest()->first();
        $this->assertEquals($user->id, $activity->resource_id);
        $this->assertEquals($user->getTable(), $activity->table_name);
    }

    /**
     * @test
     * Testing if update event is triggered
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();

        $updatedUser = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
        ];
        $user->first_name = $updatedUser['first_name'];
        $user->last_name = $updatedUser['last_name'];

        $activity = Activities::latest()->first();
        $this->assertEquals($user->id, $activity->resource_id);
        $this->assertEquals($user->getTable(), $activity->table_name);
    }

    /**
     * @test
     * Testing if delete event is triggered
     */
    public function testDelete()
    {
        $user = factory(User::class)->create();
        $user->delete();
        $userArray = $user->getAttributes();

        $activity = Activities::latest()->first();
        $this->assertSoftDeleted('users', $userArray);
        $this->assertEquals($user->id, $activity->resource_id);
        $this->assertEquals($user->getTable(), $activity->table_name);
    }
}
