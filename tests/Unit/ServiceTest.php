<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rating;
use App\Models\Service;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_calculates_a_service_average_rating(): void
    {
        $service = Service::create([
            'name' => 'example service',
            'description' => ' A test service',
            'price' => 10,
        ]);
        
        $ratings = [5, 4, 3];

        foreach($ratings as $rating) {
            Rating::create([
                'service_id' => $service->id,
                'rating'=> $rating,
            ]);
        }
        // due to the laravel naming convention, we can access the average rating of a service by calling $service->average_rating,
        // which will call the getAverageRatingAttribute() method in the Service model.
        //fresh() is used to reload the service model from the database, ensuring that we have the most up-to-date data after creating the ratings.
        $this->assertEquals(4.0, $service->fresh()->average_rating);
        //$this->assertEquals(4.0, $service->fresh()->getAverageRatingAttribute()); //can be done as well as the method is public, but the above is more elegant and follows the laravel naming convention.
    }
}
