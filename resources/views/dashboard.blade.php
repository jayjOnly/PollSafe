<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Dashboard - VoteSecure</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="font-bold text-xl">VoteSecure</div>
            <div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-8">
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

    <script>
        // Simulated data
        const activeElections = [
            { id: 1, title: "Student Council Election 2024", endDate: "May 15, 2024" },
            { id: 2, title: "Dormitory Representative Election", endDate: "April 30, 2024" },
        ];

        const upcomingElections = [
            { id: 3, title: "Student Club President Election", startDate: "June 1, 2024" },
            { id: 4, title: "Campus Improvement Project Voting", startDate: "July 15, 2024" },
        ];

        const recentActivity = [
            { action: "Voted in Student Council Election 2024", date: "April 10, 2024" },
            { action: "Registered for Dormitory Representative Election", date: "April 5, 2024" },
        ];

        // Populate active elections
        const activeElectionsContainer = document.getElementById('activeElections');
        activeElections.forEach(election => {
            const electionElement = document.createElement('div');
            electionElement.className = 'bg-green-100 p-4 rounded shadow';
            electionElement.innerHTML = `
                <h3 class="font-semibold">${election.title}</h3>
                <p class="text-gray-600">Ends: ${election.endDate}</p>
                <a href="/vote/${election.id}" class="mt-2 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-400">Vote Now</a>
            `;
            activeElectionsContainer.appendChild(electionElement);
        });

        // Populate upcoming elections
        const upcomingElectionsContainer = document.getElementById('upcomingElections');
        upcomingElections.forEach(election => {
            const electionElement = document.createElement('div');
            electionElement.className = 'bg-yellow-100 p-4 rounded shadow';
            electionElement.innerHTML = `
                <h3 class="font-semibold">${election.title}</h3>
                <p class="text-gray-600">Starts: ${election.startDate}</p>
            `;
            upcomingElectionsContainer.appendChild(electionElement);
        });

        // Populate recent activity
        const recentActivityContainer = document.getElementById('recentActivity');
        recentActivity.forEach(activity => {
            const activityElement = document.createElement('li');
            activityElement.innerHTML = `
                <span class="font-semibold">${activity.action}</span> - ${activity.date}
            `;
            recentActivityContainer.appendChild(activityElement);
        });
    </script>
</body>
</html>