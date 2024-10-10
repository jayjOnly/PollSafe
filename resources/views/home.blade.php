<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoolSafe - Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="font-bold text-xl">PoolSafe</div>
            <div>
                
        </nav>
    </header>

    <main class="container mx-auto px-6 py-8">
        <section class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">Secure Online Voting Made Easy</h1>
            <p class="text-xl text-gray-600">Participate in elections from anywhere, anytime, with complete confidence in the security and integrity of your vote.</p>
        </section>

        <section class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Secure</h2>
                <p>State-of-the-art encryption and blockchain technology ensure the integrity of every vote.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Accessible</h2>
                <p>Vote from any device, anywhere in the world. No more long queues or travel hassles.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Transparent</h2>
                <p>Real-time results and comprehensive audit trails for complete transparency.</p>
            </div>
        </section>

        <section class="bg-blue-100 p-8 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Upcoming Elections</h2>
            <div id="upcomingElections" class="grid md:grid-cols-2 gap-4">
                <!-- Upcoming elections will be dynamically inserted here -->
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-6 py-4">
            <p>&copy; 2024 VoteSecure. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simulated data for upcoming elections
        const upcomingElections = [
            { title: "Student Council Election 2024", date: "May 15, 2024" },
            { title: "City Mayor Election", date: "June 1, 2024" },
            // Add more elections as needed
        ];

        // Populate upcoming elections
        const electionsContainer = document.getElementById('upcomingElections');
        upcomingElections.forEach(election => {
            const electionElement = document.createElement('div');
            electionElement.className = 'bg-white p-4 rounded shadow';
            electionElement.innerHTML = `
                <h3 class="font-semibold">${election.title}</h3>
                <p class="text-gray-600">Date: ${election.date}</p>
            `;
            electionsContainer.appendChild(electionElement);
        });
    </script>
</body>
</html>