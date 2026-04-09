<?php require "includes/header.php"; ?>

<style>
* { 
    box-sizing: border-box; 
    margin: 0; 
    padding: 0; 
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: #2d3748;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
}

main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem 1.5rem;
}

/* Hero Banner */
.hero {
    position: relative;
    height: 400px;
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 4rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
}

.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
    padding: 2rem;
    color: white;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    margin: 4rem 0;
}

.content-text h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
}

.content-text p {
    font-size: 1.1rem;
    color: #4a5568;
    margin-bottom: 1.5rem;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
}

.workplace-img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Team Section */
.team-section {
    margin: 6rem 0;
}

.team-intro {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 4rem;
}

.team-intro p {
    font-size: 1.2rem;
    color: #4a5568;
    margin-bottom: 0;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.team-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.team-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.team-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

.card-image {
    width: 100%;
    height: 260px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.team-card:hover .card-image {
    transform: scale(1.05);
}

.card-content {
    padding: 2rem;
}

.card-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.25rem;
}

.card-role {
    color: #667eea;
    font-size: 0.95rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1.5rem;
}

.card-quote {
    font-style: italic;
    color: #4a5568;
    font-size: 1rem;
    line-height: 1.7;
    position: relative;
    padding-left: 1.5rem;
}

.card-quote::before {
    content: '"';
    position: absolute;
    left: 0;
    top: -0.25rem;
    font-size: 3rem;
    color: #e2e8f0;
    font-family: serif;
}

/* Responsive */
@media (max-width: 768px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .hero {
        height: 280px;
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    main {
        padding: 2rem 1rem;
    }
}

@media (max-width: 480px) {
    .team-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<main>
    <!-- Hero Banner -->
    <div class="hero">
        <img src="/assets/images/banner.jpeg" alt="Rydr Banner">
        <div class="hero-overlay">
            <h1 class="section-title">Over Rydr</h1>
        </div>
    </div>

    <!-- Content Section -->
    <section class="content-section">
        <div class="content-grid">
            <div class="content-text">
                <h3>Rotterdam • Innovatie • Mobiliteit</h3>
                <p>
                    Ons hoofdkantoor bevindt zich in het bruisende hart van Rotterdam, direct naast het Centraal Station. 
                    Hier combineren we technologie, design en klantgerichtheid onder één dak.
                </p>
                <p>
                    In een modern pand met uitzicht op de skyline werken we elke dag aan de mobiliteit van morgen. 
                    Loop je een keer binnen? De koffie staat klaar.
                </p>
                <a href="#" class="cta-button">
                    Kom langs
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <div>
                <img class="workplace-img" src="/assets/images/work-place.png" alt="Onze werkplek">
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="team-intro">
            <h2 class="section-title">Ons Team</h2>
            <p>Achter Rydr zit een gedreven team dat elke dag werkt aan slimmere mobiliteit. Mensen met passie, kennis en een gezonde dosis Rotterdamse nuchterheid.</p>
        </div>

        <div class="team-grid">
            <div class="team-card">
                <img class="card-image" src="/assets/images/team/youssef-amrani.png" alt="Youssef Amrani">
                <div class="card-content">
                    <h3 class="card-name">Youssef Amrani</h3>
                    <p class="card-role">Head of Product</p>
                    <p class="card-quote">Bij Rydr bouwen we niet zomaar een app — we herdefiniëren hoe de stad beweegt.</p>
                </div>
            </div>

            <div class="team-card">
                <img class="card-image" src="/assets/images/team/jasper-van-den-brink.png" alt="Jasper van den Brink">
                <div class="card-content">
                    <h3 class="card-name">Jasper van den Brink</h3>
                    <p class="card-role">CEO & Co-founder</p>
                    <p class="card-quote">Rotterdam is de perfecte plek om iets nieuws te bouwen. De energie hier is ongeëvenaard.</p>
                </div>
            </div>

            <div class="team-card">
                <img class="card-image" src="/assets/images/team/lotte-de-graaf.png" alt="Lotte de Graaf">
                <div class="card-content">
                    <h3 class="card-name">Lotte de Graaf</h3>
                    <p class="card-role">Lead Designer</p>
                    <p class="card-quote">Goed design merk je niet — het voelt gewoon logisch. Dat is waar ik elke dag voor ga.</p>
                </div>
            </div>

            <div class="team-card">
                <img class="card-image" src="/assets/images/team/brian-mensah.png" alt="Brian Mensah">
                <div class="card-content">
                    <h3 class="card-name">Brian Mensah</h3>
                    <p class="card-role">Tech Lead</p>
                    <p class="card-quote">De technologie achter Rydr is schaalbaar, snel en gebouwd om mee te groeien met de stad.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>