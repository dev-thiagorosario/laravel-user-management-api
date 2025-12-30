<?php

namespace Tests\Feature;

use App\Mail\NewUserConfirmationMail;
use App\Models\EmailConfirmationToken;
use App\Models\User;
use App\Services\TokenGeneratorServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EmailConfirmationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_email_confirmation(): void
    {
        Mail::fake();

        $user = User::factory()->unverified()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/email/confirmation');

        $response->assertStatus(200);

        Mail::assertSent(NewUserConfirmationMail::class, function (NewUserConfirmationMail $mail) use ($user): bool {
            return $mail->hasTo($user->email);
        });

        $this->assertDatabaseHas('email_confirmation_tokens', [
            'user_id' => $user->id,
            'used_at' => null,
        ]);
    }

    public function test_user_can_confirm_email_with_valid_signed_url(): void
    {
        $user = User::factory()->unverified()->create();

        $tokenGenerator = app(TokenGeneratorServiceInterface::class);
        $plainToken = $tokenGenerator->generatePlainToken();
        $tokenHash = $tokenGenerator->hashToken($plainToken);

        EmailConfirmationToken::query()->create([
            'user_id' => $user->id,
            'token_hash' => $tokenHash,
            'expires_at' => now()->addMinutes(10),
        ]);

        $signedUrl = URL::temporarySignedRoute('confirm-email', now()->addMinutes(10), [
            'userId' => $user->id,
            'hash' => sha1($user->email),
            'token' => $plainToken,
        ]);

        $response = $this->getJson($signedUrl);

        $response->assertStatus(200);

        $user->refresh();
        $this->assertNotNull($user->email_verified_at);

        $this->assertDatabaseHas('email_confirmation_tokens', [
            'user_id' => $user->id,
            'token_hash' => $tokenHash,
        ]);
        $this->assertDatabaseMissing('email_confirmation_tokens', [
            'user_id' => $user->id,
            'token_hash' => $tokenHash,
            'used_at' => null,
        ]);
    }
}
