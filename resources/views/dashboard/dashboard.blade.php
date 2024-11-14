<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; }
        .container { width: 80%; margin: 20px auto; }
        .vote-card { background-color: #fff; padding: 20px; margin-bottom: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        .vote-card h3 { margin: 0 0 10px; }
        .vote-card p { margin: 5px 0; }
        .participation-rate { font-weight: bold; color: #2ecc71; }
    </style>
</head>
<body>
    <div id="app" class="container">
        <h1>Active Voting Dashboard</h1>
        <div v-if="votes.length === 0">No active votes available.</div>
        <div v-else>
            <div class="vote-card" v-for="vote in votes" :key="vote.vote_id">
                <h3>{{ vote.vote_name }}</h3>
                <p><strong>Description:</strong> {{ vote.description }}</p>
                <p><strong>Start Date:</strong> {{ formatDate(vote.start_date) }}</p>
                <p><strong>End Date:</strong> {{ formatDate(vote.end_date) }}</p>
                <p><strong>Participation Rate:</strong> <span class="participation-rate">{{ vote.participation_rate }}%</span></p>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                userId: 'USER_ID', // Ganti dengan user_id yang diinginkan
                votes: []
            },
            created() {
                this.fetchVotes();
            },
            methods: {
                async fetchVotes() {
                    try {
                        const response = await fetch(`/api/active-votes/${this.userId}`);
                        this.votes = await response.json();
                    } catch (error) {
                        console.error('Error fetching votes:', error);
                    }
                },
                formatDate(date) {
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return new Date(date).toLocaleDateString(undefined, options);
                }
            }
        });
    </script>
</body>
</html>
