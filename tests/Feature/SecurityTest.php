<?php

namespace Tests\Feature;

use App\Enquiry;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole($role)
    {
        $user = factory(User::class)->create();
        $user->role = $role;
        $user->save();

        return $user;
    }

    public function test_public_sign_up_is_disabled()
    {
        $this->get('/register')->assertNotFound();
        $this->post('/register', [
            'name' => 'x', 'email' => 'x@example.com',
            'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertStatus(404);
        $this->assertDatabaseMissing('users', ['email' => 'x@example.com']);
    }

    public function test_super_admin_from_install_migration_has_super_admin_role()
    {
        $this->assertDatabaseHas('users', ['email' => 'connect@perksproperty.in', 'role' => 'super-admin']);
    }

    public function test_author_cannot_reach_admin_only_areas()
    {
        $author = $this->userWithRole('author');

        $this->actingAs($author)->get('/control-panel/enquiries/export')->assertForbidden();
        $this->actingAs($author)->get('/control-panel/enquiries')->assertForbidden();
        $this->actingAs($author)->get('/control-panel/properties')->assertForbidden();
        $this->actingAs($author)->get('/control-panel/visits')->assertForbidden();
        $this->actingAs($author)->get('/control-panel/users')->assertForbidden();
        $this->actingAs($author)->post('/control-panel/property-image-upload/123')->assertForbidden();
        $this->actingAs($author)->get('/control-panel/dashboard')->assertRedirect(route('blogs.index'));
    }

    public function test_author_cannot_load_admin_data_tables()
    {
        $author = $this->userWithRole('author');

        foreach (['manage_enquiries', 'manage_users', 'manage_visits', 'manage_properties', 'manage_dashboard'] as $page) {
            $this->actingAs($author)->post('/ajax', ['page' => $page])->assertForbidden();
        }
    }

    public function test_admin_can_export_enquiries()
    {
        $this->actingAs($this->userWithRole('admin'))
            ->get('/control-panel/enquiries/export')
            ->assertOk()
            ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    public function test_guests_are_sent_to_login()
    {
        $this->get('/control-panel/enquiries/export')->assertRedirect('/login');
        $this->post('/ajax', ['page' => 'manage_enquiries'])->assertRedirect('/login');
    }

    public function test_admin_tables_escape_visitor_supplied_text()
    {
        Enquiry::create([
            'name' => '<img src=x onerror=alert(1)>',
            'phone_number' => '9820012345',
            'message' => '<script>alert(2)</script>',
        ]);

        $response = $this->actingAs($this->userWithRole('admin'))->post('/ajax', [
            'page' => 'manage_enquiries', 'search' => ['value' => null], 'start' => 0, 'length' => 10, 'draw' => 1,
        ]);

        $response->assertOk();
        $this->assertStringNotContainsString('<img src=x', $response->getContent());
        $this->assertStringNotContainsString('<script>', $response->getContent());
        $row = $response->json('data.0');
        $this->assertSame('&lt;img src=x onerror=alert(1)&gt;', $row[1]);
        $this->assertSame('&lt;script&gt;alert(2)&lt;/script&gt;', $row[6]);
    }

    public function test_bulk_delete_cannot_be_triggered_by_a_link()
    {
        $admin = $this->userWithRole('super-admin');
        $enquiry = Enquiry::create(['name' => 'Kept', 'phone_number' => '9820012345']);
        $enquiry->delete();

        // A plain link (GET) must not delete anything.
        $this->actingAs($admin)->get('/control-panel/enquiries/delete-all');
        $this->assertSoftDeleted('enquiries', ['id' => $enquiry->id]);

        // The confirmed form (POST with CSRF token) does.
        $this->actingAs($admin)->post('/control-panel/enquiries/delete-all')->assertRedirect();
        $this->assertDatabaseMissing('enquiries', ['id' => $enquiry->id]);
    }

    public function test_uploads_accept_images_only()
    {
        Storage::fake('public');
        $admin = $this->userWithRole('admin');

        $php = UploadedFile::fake()->createWithContent('shell.php', '<?php system($_GET["c"]); ?>');
        $this->actingAs($admin)
            ->postJson('/control-panel/property-image-upload/123', ['files' => [$php]])
            ->assertStatus(422);

        // A script renamed to .jpg: the type is detected from the content.
        $path = tempnam(sys_get_temp_dir(), 'upl');
        file_put_contents($path, '<?php echo 1; ?>');
        $disguised = new UploadedFile($path, 'photo.jpg', null, null, true);
        $this->actingAs($admin)
            ->postJson('/control-panel/blog-image-upload', ['file' => $disguised])
            ->assertStatus(422);

        $this->assertCount(0, Storage::disk('public')->allFiles());

        $image = UploadedFile::fake()->image('flat.jpg', 800, 600);
        $this->actingAs($admin)
            ->postJson('/control-panel/property-image-upload/123', ['files' => [$image]])
            ->assertOk()
            ->assertJsonStructure(['uploadURL']);
    }

    public function test_responses_carry_security_headers()
    {
        $this->get('/login')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }
}
