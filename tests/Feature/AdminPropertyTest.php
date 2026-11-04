<?php

namespace Tests\Feature;

use App\Property;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPropertyTest extends TestCase
{
    use RefreshDatabase;

    private function admin()
    {
        $user = User::factory()->create();
        $user->role = 'admin';
        $user->save();

        return $user;
    }

    private function residentialSalePayload(array $overrides = [])
    {
        return array_merge([
            '_method' => 'PUT',
            'property-status' => '2', 'property-type' => '1',
            'name' => 'Demo Owner', 'phone' => '9000000005', 'email' => 'owner5@example.com',
            'location-realtor-name' => '', 'location-building-name' => 'Tridev', 'location-street' => 'Bhakti Marg',
            'location-locality' => 'Opp. Richardson Ground', 'location-landmark' => '', 'location-town' => 'Mulund',
            'location-city' => 'Mumbai', 'location-pincode' => '400080', 'location-state' => 'Maharashtra',
            'location-country' => 'India', 'location-latitude' => '19.18', 'location-longitude' => '72.94',
            'property-detailed-type' => 'Apartment', 'property-age-property' => '12', 'property-description' => 'Bright 2 BHK.',
            'property-carpet-area' => '1050', 'property-availability-status' => '2', 'property-negotiable' => '1',
            'location-house-number' => 'A-201', 'property-bedrooms' => '2', 'property-furnished-status' => '1',
            'property-covered-parking' => '1', 'property-open-parking' => '0', 'property-facing-direction' => 'East',
            'property-price' => '26000000',
            'special_room' => [null], 'amenity_name' => [null], 'facility_name' => [null],
            'safety_equipment_name' => [null], 'surrounding_name' => [null],
        ], $overrides);
    }

    public function test_a_residential_sale_listing_can_be_edited()
    {
        $this->seed(\Database\Seeders\PropertySeeder::class);
        $property = Property::where('type', 'Residential')->where('status', 'Sell')->firstOrFail();

        $this->actingAs($this->admin())
            ->post('/control-panel/properties/' . $property->id, $this->residentialSalePayload())
            ->assertOk()
            ->assertSee('success');

        $property->refresh();
        $this->assertEquals(26000000, $property->price);
        $this->assertSame('Apartment', $property->detailed_type);
        $this->assertEquals(1, $property->residential->furnishing);
    }

    public function test_invalid_edits_return_every_field_error_and_change_nothing()
    {
        $this->seed(\Database\Seeders\PropertySeeder::class);
        $property = Property::where('type', 'Residential')->where('status', 'Sell')->firstOrFail();
        $before = $property->price;

        $this->actingAs($this->admin())
            ->postJson('/control-panel/properties/' . $property->id, $this->residentialSalePayload([
                'property-price' => '', 'location-pincode' => '12', 'property-bedrooms' => '',
            ]))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['property-price', 'location-pincode', 'property-bedrooms']);

        $this->assertEquals($before, $property->fresh()->price);
    }

    public function test_an_office_for_rent_can_be_created_with_its_photo()
    {
        Storage::fake('public');
        // Make rent_details ids differ from property ids, so a relation that
        // joins on the wrong column shows the wrong rent.
        \App\RentDetail::create(['security_deposit_mode' => 'Fixed', 'amount' => 1, 'duration_of_agreement' => 11, 'months_of_notice' => 1]);

        $payload = $this->residentialSalePayload([
            'property-status' => '1', 'property-type' => '2', 'property-commercials' => '1',
            'location-building-name' => 'Kalpataru Square',
            'property-detailed-type' => 'Office',
            'property-office-number' => '501', 'property-seats' => '24', 'property-cabin' => '3',
            'property-meeting-room' => '1', 'property-reception-area' => '1', 'property-pantry' => '1',
            'property-staircase' => '1', 'property-lift' => '1',
            'property-security-deposit-mode' => '1', 'property-amount' => '185000',
            'property-duration-of-agreement' => '36', 'property-months-of-notice' => '3',
            'image' => UploadedFile::fake()->image('front.jpg', 1200, 800),
        ]);
        unset($payload['_method'], $payload['property-price']);

        $this->actingAs($this->admin())
            ->post('/control-panel/properties', $payload)
            ->assertOk()
            ->assertSee('success');

        $property = \App\Property::with(['office', 'rentDetail', 'location'])->latest('id')->firstOrFail();
        $this->assertSame('Rent', $property->status);
        $this->assertSame('Commercial', $property->type);
        $this->assertEquals(185000, $property->rentDetail->amount);
        $this->assertEquals(1, $property->office->lift);
        $this->assertSame('Kalpataru Square', $property->location->building_name);
        Storage::disk('public')->assertExists($property->feature_image_path);

        // The public page shows the listing with its rent and the correct lift value.
        $this->get('/properties/' . $property->slug)
            ->assertOk()
            ->assertSee('₹1.85 L / month')
            ->assertSee('Lift');
    }
}
