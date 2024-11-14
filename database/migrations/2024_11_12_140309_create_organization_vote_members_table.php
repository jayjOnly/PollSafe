<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organization_vote_members', function (Blueprint $table) {
            $table->id();
            $table->uuid('organization_vote_id');
            $table->uuid('organization_member_id');
            $table->uuid('organization_vote_candidate_id');
            $table->timestamps();
        });

        Schema::table('organization_vote_members', function(Blueprint $table) {
            $table->foreign('organization_vote_id')->references('id')->on('organization_votes')->onDelete('cascade');
            $table->foreign('organization_member_id')->references('id')->on('organization_members')->onDelete('cascade');
            $table->foreign('organization_vote_candidate_id')->references('id')->on('organization_vote_candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_vote_members', function (Blueprint $table) {
            $table->dropForeign(['organization_vote_id', 'organization_member_id', 'organization_vote_candidate_id']); // Remove the foreign key
            $table->dropColumn(['organization_vote_id', 'organization_member_id', 'organization_vote_candidate_id']); // Remove the column
        });
    }
};
