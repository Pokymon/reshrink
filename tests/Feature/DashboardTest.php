<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
  $this->get('/my/dashboard')->assertRedirect('/auth/login');
});

test('authenticated users can visit the dashboard', function () {
  $this->actingAs($user = User::factory()->create());

  $this->get('/my/dashboard')->assertOk();
});
