@extends('components.nav-bar')
@section('content')

        <h1 class="text-3xl font-bold mb-8">Voter Dashboard</h1>

        <section class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-2xl font-semibold mb-4">Active Elections</h2>
            <div id="activeElections" class="grid md:grid-cols-2 gap-4">
                <!-- Active elections will be dynamically inserted here -->
            </div>
        </section>

        <section class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-2xl font-semibold mb-4">Upcoming Elections</h2>
            <div id="upcomingElections" class="grid md:grid-cols-2 gap-4">
                <!-- Upcoming elections will be dynamically inserted here -->
            </div>
        </section>

        <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Recent Activity</h2>
            <ul id="recentActivity" class="list-disc pl-5">
                <!-- Recent activity will be dynamically inserted here -->
            </ul>
        </section>
    </main>

    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-6 py-4">
            <p>&copy; 2024 VoteSecure. All rights reserved.</p>
        </div>
    </footer>
@endsection
