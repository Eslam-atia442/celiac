<?php

namespace Database\Seeders;

use App\Models\CalendarDay;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        $this->call(\Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder::class);

        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UsersTableSeeder::class,
            CommitteesTableSeeder::class,
            NormalUsersSeeder::class,
            GovernanceListsTableSeeder::class,
            FilesTableSeeder::class,
            PositionsTableSeeder::class,
            MembersTableSeeder::class,
            DonationTypesTableSeeder::class,
            BannersTableSeeder::class,
            PostsTableSeeder::class,
            PartnerGroupsTableSeeder::class,
            PartnersTableSeeder::class,
            DonationTypesTableSeeder::class,
            DonationsTableSeeder::class,
            ClinicTableSeeder::class,
            CalendarDayTableSeeder::class,
            ReservationTableSeeder::class

        ]);
    }
}
