<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class UserControllerTests extends TestCase
{
    use DatabaseMigrations;

    /**
     * @covers App\Http\Controller
     * UserController::index()
     */
    public function testIndexReturnsDataInValidFormat()
    {

        $this->json('get', 'api/users')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [

                    '*' => [
                        'first_name',
                        'last_name',
                        'full_name'
                    ]

                ]
            );
    }

    /**
     * @covers App\Http\Controller
     * UserController::store()
     */
    public function testUserIsCreatedSuccessfully()
    {
        $user = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName
        ];

        $this->json('post', 'api/users', $user)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertSee('User Registered Successfully');


        $this->assertDatabaseHas('users', $user);
    }

    /**
     * @covers App\Http\Controller
     * UserController::show()
     */
    public function testUserIsShownCorrectly()
    {
        $user = User::create(
            [
                'first_name' => $this->faker->firstName,
                'last_name'  => $this->faker->lastName
            ]
        );

        $this->json('get', "api/users/$user->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'full_name'  => $user->full_name
                ]
            );
    }

    /**
     * @covers App\Http\Controller
     * UserController::destroy()
     */
    public function testUserIsDestroyed()
    {
        $userData =
            [
                'first_name' => $this->faker->firstName,
                'last_name'  => $this->faker->lastName
            ];

        $user = User::create($userData);

        $this->json('delete', "api/users/$user->id")
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertSoftDeleted('users', $userData);
    }

    /**
     * @covers App\Http\Controller
     * UserController::update()
     */
    public function testUpdateUserReturnsCorrectData()
    {
        $user = User::create(
            [
                'first_name' => $this->faker->firstName,
                'last_name'  => $this->faker->lastName,
            ]
        );

        $updatedUser = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
        ];

        $this->json('put', "api/users/$user->id", $updatedUser)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'first_name' => $updatedUser['first_name'],
                    'last_name'  => $updatedUser['last_name']
                ]
            );
    }
}
