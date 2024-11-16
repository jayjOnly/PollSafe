<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Page</title>
</head>
<body>
    <div container = "container">
        <h1 class="voting-name">VOTING {{ $vote->name }}</h1> <!--ganti jadi variabel biar bisa disesuain sm organisasi / nama voting!-->

        <div class="card-container">

            <div class="candidate-container">
                @foreach ($candidates as $candidate)
                <div class="candidate-card" data-candidate-id={{ $candidate['id'] }}>
                    <img class="profile-pic" src="{{ asset('JV.png') }}" alt="{{ $candidate['name'] }}">
                    <h3 class="candidate-name">{{ $candidate['name'] }}</h3>
                </div>
                @endforeach
            </div>

            <div class="flex-vote-button">
                <button class="vote-button" id="vote-btn">Vote</button>
                <button class="can-button" onclick="window.history.back()" >Cancel</button>
            </div>
        </div>
    </div>

     <div id="confirmPopup" class="popup-overlay">
        <div class="popup-content">
            <h2>Confirm Vote?</h2>
            <p>Are you sure you want to vote for this candidate?</p>
            <div class="popup-buttons">
                <button id="cancel-button" class="popup-btn btn-no">Cancel</button>
                <button id="confirm-button" class="popup-btn btn-confirm">Confirm</button>
            </div>
        </div>
    </div>

    <script>
 
        document.querySelectorAll('.candidate-card').forEach(card => {
            card.addEventListener('click', () => {
                // Remove selected class from all cards
                document.querySelectorAll('.candidate-card').forEach(c => {
                    c.classList.remove('selected');
                });
                
                // Add selected class to clicked card
                card.classList.add('selected');

                const selectedCard= document.querySelector('.candidate-card.selected');
                
                // Enable vote button
                document.getElementById('vote-btn').disabled = !selectedCard;
            });
        });
    
        // Show confirmation popup
        document.getElementById('vote-btn').addEventListener('click', () => {
            document.getElementById('confirmPopup').style.display = 'flex';
        });
    
        // No button - close popup
        document.getElementById('cancel-button').addEventListener('click', () => {
            document.getElementById('confirmPopup').style.display = 'none';
        });
    
        // Confirm button - submit vote and redirect
        document.getElementById('confirm-button').addEventListener('click', () => {
            const selectedCandidate = document.querySelector('.candidate-card.selected');
            if (selectedCandidate) {
                const candidateId = selectedCandidate.getAttribute('data-candidate-id');
                    // Here you would typically send the vote to your backend
                    fetch('/api/setVote', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adjust this if you're using a different CSRF token setup
                        },
                        body: JSON.stringify({ organization_vote_id: '{{ $vote['id'] }}', candidate_id: candidateId })
                    })
                    .then(response => {
                        // Check if the response status is 200
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            // If not 200, throw an error with the message from the response
                            return response.json().then(errorData => {
                                throw new Error(errorData.message || 'An error occurred');
                            });
                        }
                    })
                    .then(data => {
                        // If we reach here, the response was successful
                        alert('Successfully vote!');
                        window.location.href = '{{ route('voting-active', ['organization_id' => $vote['organization_id']]) }}' // Reload the page
                    })
                    .catch(error => {
                        // Handle any errors that occurred during the fetch
                        console.error('Error:', error);
                        alert(`Failed to vote: ${error.message}`);
                    });
            }
        });
    
    </script>
</body>
</html>

<style>
    *{
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color:#f4f4f4
    }
    .container {
        max-width: 90%;
        margin: 12px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .card-container {
        width: 100%;             
        max-width: 90%;        
        margin-left: auto;      
        margin-right: auto;       
        padding-top: 2rem;        
        padding-bottom: 2rem;    
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
    }
    .candidate-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .candidate-card {
        width: 400px;
        height:450px;
        display:flex;
        flex-direction: column; 
        justify-content: center; 
        align-items:center;
        border: 2px solid #ddd;
        border-radius: 10px;
        margin: auto 20px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .candidate-card:hover {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        transform: scale(1.05);
    }
    .candidate-card.selected {
        border-color: #0069ff;
        background-color:#006aff47;
        transform: scale(1.05);
    }
    .candidate-name{
        font-size:2em;
        background-color:transparent;
    }
    .vote-button {
        background-color: #0069ff;
        color: white;
        font-size: 25px;
        font-weight:bold;
        border: none;
        height: 50px;
        width: 200px;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .can-button{
        background-color: #ca2115;
        color: white;
        font-size: 25px;
        font-weight:bold;
        border: none;
        height: 50px;
        width: 200px;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .can-button:hover{
        transform: scale(1.05);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .vote-button:hover{
        transform: scale(1.05);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    .vote-button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
    .flex-vote-button{
        display: flex;
        justify-content: center;
        align-items: center;   
        gap: 2rem;
    }
    .voting-name{
        margin-top:20px;
        margin-bottom:20px;
        display:flex;
        justify-content:center;
    }
    .profile-pic{
        max-width: 250px;
        max-height:300px;
        
    }
/* Popup styles */
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;            
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    .popup-content {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        width: 300px;
    }
    .popup-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .popup-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    .btn-no {
        background-color: #6c757d;
        color: white;
    }
    .btn-confirm {
        background-color: #28a745;
        color: white;
    }
</style>



