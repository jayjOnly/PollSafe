<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PollSafe - Online Voting System</title>
</head>

<body>
    <x-nav-bar-guest></x-nav-bar-guest>

    <div class="container">
        <div class="upper-section">
            <h1 class="title">Secure Online Voting Made Easy</h1>
            <p class="description">Participate in elections from anywhere, anytime, with complete confidence in the security and integrity of your vote.</p>
        </div>
    
        <div class="feature-container">
            <div class="feature-box">
                <h2 class="feature-title">Secure</h2>
                <svg viewBox="0 0 1 0.002" preserveAspectRatio="none">
                    <path d="M0 0 l12 0" stroke="#A9B3CA" stroke-width="1" stroke-dasharray="4 8" vector-effect="non-scaling-stroke" stroke-linecap="round"></path>
                </svg>
                <p class="feature-description">State-of-the-art encryption and blockchain technology ensure the integrity of every vote.</p>
            </div>
            <div class="feature-box">
                <h2 class="feature-title">Accessible</h2>
                <svg viewBox="0 0 1 0.002" preserveAspectRatio="none">
                    <path d="M0 0 l12 0" stroke="#A9B3CA" stroke-width="1" stroke-dasharray="4 8" vector-effect="non-scaling-stroke" stroke-linecap="round"></path>
                </svg>
                <p class="feature-description">Vote from any device, anywhere in the world. No more long queues or travel hassles.</p>
            </div>
            <div class="feature-box">
                <h2 class="feature-title">Transparent</h2>
                <svg viewBox="0 0 1 0.002" preserveAspectRatio="none">
                    <path d="M0 0 l12 0" stroke="#A9B3CA" stroke-width="1" stroke-dasharray="4 8" vector-effect="non-scaling-stroke" stroke-linecap="round"></path>
                </svg>
                <p class="feature-description">Real-time results and comprehensive audit trails for complete transparency.</p>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>

<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .container {
        background: linear-gradient(135deg, rgba(0, 105, 255, 0.8), rgba(0, 255, 255, 0.5)),
                    radial-gradient(circle, rgba(0, 105, 255, 0.5) 0%, rgba(0, 255, 255, 0.2) 70%);
        background-blend-mode: multiply;
        padding: 10px;
        flex: 1;
        
    }

    .upper-section {
        align-content: center;
        margin: 20px;
        margin-block: 50px;
    }

    .title {
        text-align: center;
        margin-bottom: 20px;
    }

    .description {
        text-align: center;
    }

    .feature-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        flex-direction: row;
        align-content: center;
        justify-content: space-evenly;
        gap: 35px;
        padding-inline: 5vw;
        padding-bottom: 50px;
    }

    .feature-box {
        box-shadow: rgba(17, 25, 46, 0.1) 0px 0px 0px 2px inset;
        background: rgb(249, 250, 254);
        border-radius: 10px;
        display: flex;
        max-width: 100%;
        flex-direction: column;
        gap: 24px;
        height: 100%;
        padding: 35px;
        justify-content: center;
        transition: background-color 0.3s;
    }

    .feature-title {
        font-weight: 700;
    }

    .feature-description {
        font-weight: 500;
        align-items: flex-start;
        align-self: stretch;
        display: flex;
        flex-grow: 1;
        gap: 24px;
    }

    @media only screen and (max-width: 768px) {
        .feature-container {
            grid-template-columns: 1fr; 
        }
    }
</style>