<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([ItemSeeder::class, AttributeSeeder::class]);
		// \App\Models\User::factory(10)->create();

		\App\Models\User::factory()->create([
			'name' => 'Administrator',
			'email' => 'admin@example.com',
			'password' => bcrypt('admin1234'),
			'role' => 'administrator',
		]);
	}
}
