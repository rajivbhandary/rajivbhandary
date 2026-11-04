<?php

namespace Tests\Feature;

use App\Notifications\NewEnquiryNotification;
use App\Notifications\RevertEnquiryNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EnquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_visitor_can_send_an_enquiry_with_just_name_and_mobile()
    {
        Notification::fake();

        $this->postJson('/enquiry', ['name' => 'Asha Patil', 'phone_number' => '+91 98200 12345'])
            ->assertOk()
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('enquiries', ['name' => 'Asha Patil', 'phone_number' => '9820012345', 'email' => null]);
        $admin = User::where('email', 'connect@perksproperty.in')->first();
        Notification::assertSentTo($admin, NewEnquiryNotification::class);
        Notification::assertNotSentTo(\App\Enquiry::first(), RevertEnquiryNotification::class);
    }

    public function test_invalid_details_are_rejected_with_field_errors()
    {
        $this->postJson('/enquiry', ['name' => 'A', 'phone_number' => '12345', 'email' => 'not-an-email'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'phone_number', 'email']);
    }

    public function test_bots_filling_the_hidden_field_are_rejected()
    {
        $this->postJson('/enquiry', ['name' => 'Spam Bot', 'phone_number' => '9820012345', 'website' => 'http://spam.example'])
            ->assertStatus(422);
        $this->assertDatabaseCount('enquiries', 0);
    }

    public function test_enquiries_are_rate_limited()
    {
        Notification::fake();

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/enquiry', ['name' => 'Asha Patil', 'phone_number' => '9820012345'])->assertOk();
        }
        $this->postJson('/enquiry', ['name' => 'Asha Patil', 'phone_number' => '9820012345'])->assertStatus(429);
    }
}
