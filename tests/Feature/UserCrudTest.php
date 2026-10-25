<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_be_listed_without_exposing_passwords(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('secret-password'),
        ]);

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('Test User')
            ->assertSee('test@example.com')
            ->assertDontSee('secret-password');
    }

    public function test_create_form_is_available(): void
    {
        $this->get(route('users.create'))
            ->assertOk()
            ->assertSee('Tambah User')
            ->assertSee('name="password"', false);
    }

    public function test_user_can_be_created_with_a_hashed_password(): void
    {
        $response = $this->post(route('users.store'), [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User berhasil ditambahkan!');
        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'new@example.com',
        ]);

        $user = User::where('email', 'new@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('secret-password', $user->password));
    }

    public function test_create_validation_errors_preserve_safe_old_input(): void
    {
        $this->from(route('users.create'))
            ->post(route('users.store'), [
                'name' => 'Remember This Name',
                'email' => 'not-an-email',
                'password' => 'short',
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email', 'password']);

        $this->get(route('users.create'))
            ->assertOk()
            ->assertSee('value="Remember This Name"', false)
            ->assertDontSee('value="short"', false);
    }

    public function test_user_can_be_edited_and_password_can_be_kept_or_changed(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
            'password' => Hash::make('original-password'),
        ]);

        $this->get(route('users.edit', $user))
            ->assertOk()
            ->assertSee('value="Original Name"', false)
            ->assertSee('value="original@example.com"', false);

        $this->put(route('users.update', $user), [
            'name' => 'Updated Name',
            'email' => 'original@example.com',
            'password' => '',
        ])
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User berhasil diperbarui!');

        $user->refresh();
        $this->assertSame('Updated Name', $user->name);
        $this->assertTrue(Hash::check('original-password', $user->password));

        $this->put(route('users.update', $user), [
            'name' => 'Updated Name',
            'email' => 'original@example.com',
            'password' => 'replacement-password',
        ])->assertRedirect(route('users.index'));

        $this->assertTrue(Hash::check('replacement-password', $user->fresh()->password));
    }

    public function test_update_rejects_an_email_used_by_another_user(): void
    {
        $user = User::factory()->create(['email' => 'first@example.com']);
        User::factory()->create(['email' => 'taken@example.com']);

        $this->put(route('users.update', $user), [
            'name' => $user->name,
            'email' => 'taken@example.com',
            'password' => '',
        ])
            ->assertSessionHasErrors('email');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'first@example.com',
        ]);
    }

    public function test_user_can_be_deleted(): void
    {
        $user = User::factory()->create();

        $this->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User berhasil dihapus!');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
