<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class AddressControllerTests extends TestCase
{
    use DatabaseMigrations;

    /**
     * @covers App\Http\Controller
     * AddressController::index()
     */
    public function testIndexReturnsDataInValidFormat()
    {
        $userAddress = factory(\App\Address::class)->create();

        $this->json('get', "api/user_address/$userAddress->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [

                    '*' =>
                    'address1',
                    'address2',
                    'city',
                    'state',
                    'zip',
                    'country'

                ]
            );
    }

    /**
     * @covers App\Http\Controller
     * AddressController::store()
     */
    public function testAddressIsCreatedSuccessfully()
    {
        $address = factory(\App\Address::class)->create();

        $data = [
            'address1' => $address->address1,
            'address2' =>  $address->address2,
            'city' =>  $address->city,
            'state' =>  $address->state,
            'zip' =>  $address->zip,
            'country' => $address->country,
            'user_id' => $address->user_id
        ];

        $this->json('post', "api/users/$address->user_id/user_address", $data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertSee('User address Added');

        $this->assertDatabaseHas('user_address', $data);
    }

    /**
     * @covers App\Http\Controller
     * AddressController::show()
     */
    public function testAddressIsShownCorrectly()
    {
        $address = factory(\App\Address::class)->create();

        $this->json('get', "api/users/$address->user_id/user_address")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    [
                        'address1' => $address->address1,
                        'address2' => $address->address2,
                        'city' => $address->city,
                        'state' => $address->state,
                        'zip' => $address->zip,
                        'country' => $address->country,
                    ]
                ]
            );
    }

    /**
     * @covers App\Http\Controller
     * AddressController::destroy()
     */
    public function testAddressIsDestroyed()
    {
        $userAddress = factory(\App\Address::class)->create();

        $this->json('delete', "api/user_address/$userAddress->id")
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $userAddress = $userAddress->toArray();

        $this->assertDatabaseMissing('user_address', $userAddress);
    }
}
