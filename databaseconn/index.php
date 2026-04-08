<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connectie fout: " . $e->getMessage());
}

$message = '';
$messageType = '';

if ($_POST['action'] ?? '' === 'add') {
    $voornaam = trim($_POST['voornaam']);
    $woonplaats = trim($_POST['woonplaats']);
    $studierichting = trim($_POST['studierichting']);
    $klas = trim($_POST['klas']);
    $studentnummer = trim($_POST['studentnummer']);
    $email = trim($_POST['email']);

    if (!empty($voornaam) && !empty($studentnummer)) {
        try {
            $sql = "INSERT INTO student (voornaam, woonplaats, studierichting, klas, studentnummer, email) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$voornaam, $woonplaats, $studierichting, $klas, $studentnummer, $email]);
            $message = " Student '$voornaam' succesvol toegevoegd!";
            $messageType = 'success';
        } catch(PDOException $e) {
            $message = " Fout: " . $e->getMessage();
            $messageType = 'error';
        }
    } else {
        $message = " Voornaam en studentnummer zijn verplicht!";
        $messageType = 'error';
    }
}


$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM student WHERE 
        voornaam LIKE ? OR 
        woonplaats LIKE ? OR 
        studierichting LIKE ? OR 
        klas LIKE ? OR 
        studentnummer LIKE ?
        ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $conn->query("SELECT COUNT(*) FROM student")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studenten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
   
    <style> 
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: green;
    min-height: 100vh;
    padding: 20px;
    color: #333;
}


.container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

.header {
    background: black;
    color: white;
    padding: 30px;
    text-align: center;
}

.header h1 {
    font-size: 2.2rem;
    margin-bottom: 10px;
}

.header p {
    font-size: 1.1rem;
    opacity: 0.9;
}


.nav-tabs {
    display: flex;
    background: #f1f3f4;
    border-bottom: 2px solid #ddd;
}

.tab-btn {
    flex: 1;
    padding: 15px;
    border: none;
    background: none;
    font-size: 1rem;
    font-weight: bold;
    color: #666;
    cursor: pointer;
    transition: all 0.3s;
}

.tab-btn:hover {
    background: #e8eaed;
    color: #4285f4;
}

.tab-btn.active {
    background: white;
    color: #4285f4;
    border-bottom: 3px solid #4285f4;
}


.tab-content {
    display: none;
    padding: 30px;
}

.tab-content.active {
    display: block;
}


.message {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: bold;
    border-left: 5px solid;
}

.message.success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.message.error {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}


.search-form {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
    border: 1px solid #dee2e6;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #495057;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 2px solid #ced4da;
    border-radius: 8px;
    font-size: 1rem;
}

.form-group input:focus {
    border-color: #4285f4;
    box-shadow: 0 0 5px rgba(66, 133, 244, 0.3);
    outline: none;
}

.search-input-group {
    display: flex;
}

.search-input-group input {
    border-radius: 8px 0 0 8px;
    border-right: none;
}

.search-btn {
    background: #4285f4;
    color: white;
    border: none;
    border-radius: 0 8px 8px 0;
    padding: 12px 20px;
    cursor: pointer;
}

.search-btn:hover {
    background: #3367d6;
}


.btn-group {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-success {
    background: #28a745;
    color: white;
}

.btn-success:hover {
    background: #218838;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #545b62;
}


.results-info {
    background: #e3f2fd;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: bold;
    border-left: 4px solid #4285f4;
}

.no-results {
    text-align: center;
    padding: 50px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 2px dashed #dee2e6;
}

.no-results i {
    color: #adb5bd;
    font-size: 4rem;
    margin-bottom: 20px;
}

.no-results h3 {
    color: #495057;
    margin-bottom: 10px;
    font-size: 1.5rem;
}


.students-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
}

.student-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s;
    border: 1px solid #e9ecef;
}

.student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.card-header {
    background: black;
    color: white;
    padding: 20px;
    display: flex;
    gap: 15px;
}


.student-info h3 {
    font-size: 1.3rem;
    margin-bottom: 5px;
}

.student-id {
    opacity: 0.9;
    font-size: 0.9rem;
}

.card-body {
    padding: 20px;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row i {
    color: #4285f4;
    width: 18px;
}

.info-row.highlight {
    background: #e3f2fd;
    border-radius: 6px;
    padding: 12px;
    margin: 5px 0;
}

.card-footer {
    padding: 15px 20px;
    background: #f8f9fa;
    text-align: right;
    border-top: 1px solid #e9ecef;
}

.date {
    color: #6c757d;
    font-size: 0.9rem;
}


@media (max-width: 768px) {
    .students-grid {
        grid-template-columns: 1fr;
    }
    
    .nav-tabs {
        flex-direction: column;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    body {
        padding: 10px;
    }
}
    </style>
</head>
<body>
    <div class="container">
       
        <div class="header">
            <h1><i class="fas fa-graduation-cap"></i> Studenten </h1>
        
        </div>

       
        <div class="nav-tabs">
            <button class="tab-btn active" onclick="showTab('overview')">
                <i class="fas fa-list"></i> Overzicht
            </button>
            <button class="tab-btn" onclick="showTab('add')">
                <i class="fas fa-plus-circle"></i> Student toevoegen
            </button>
        </div>

      
        <div id="overview" class="tab-content active">
            <?php if($message): ?>
            <div class="message <?= $messageType ?>">
                <?= $message ?>
            </div>
            <?php endif; ?>

           
            <form method="GET" class="search-form">
                <div class="form-group full-width">
                    <label><i class="fas fa-search"></i> Zoek studenten:</label>
                    <div class="search-input-group">
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Naam, woonplaats, klas...">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="btn-group">
                    <a href="." class="btn btn-secondary"><i class="fas fa-redo"></i> Alles tonen</a>
                </div>
            </form>

          
            <div class="results-info">
                <i class="fas fa-users"></i> <?= count($results) ?> van <?= $total ?> studenten
                <?= $search ? "• Zoekterm: '$search'" : '' ?>
            </div>

            <?php if(empty($results)): ?>
            <div class="no-results">
                <i class="fas fa-users-slash fa-4x"></i>
                <h3>Geen studenten gevonden</h3>
                <p><?= $search ? "Probeer een ander zoekwoord" : "Voeg de eerste student toe!" ?></p>
                <button class="btn" onclick="showTab('add')">+ Nieuwe student toevoegen</button>
            </div>
            <?php else: ?>
            
            <div class="students-grid">
                <?php foreach($results as $row): ?>
                <div class="student-card">
                    <div class="card-header">
                       
                        <div class="student-info">
                            <h3><?= htmlspecialchars($row['voornaam']) ?></h3>
                            <span class="student-id">#<?= $row['id'] ?></span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="info-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= htmlspecialchars($row['woonplaats']) ?></span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-book"></i>
                            <span><?= htmlspecialchars($row['studierichting'] ) ?></span>
                        </div>
                        <div class="info-row highlight">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <strong><?= htmlspecialchars($row['klas'] ) ?></strong>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-id-card"></i>
                            <span><strong><?= htmlspecialchars($row['studentnummer']) ?></strong></span>
                        </div>
                        <?php if($row['email']): ?>
                        <div class="info-row">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-footer">
                        <span class="date">
                            <i class="fas fa-calendar"></i> <?= date('d-m-Y', strtotime($row['created_at'])) ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

       
        <div id="add" class="tab-content">
            <h2><i class="fas fa-user-plus"></i> Nieuwe Student Toevoegen</h2>
            
            <form method="POST" class="search-form">
                <input type="hidden" name="action" value="add">
                
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Voornaam *</label>
                    <input type="text" name="voornaam" required placeholder="Jan">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt"></i> Woonplaats</label>
                    <input type="text" name="woonplaats" placeholder="Amsterdam">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-book"></i> Studierichting</label>
                    <input type="text" name="studierichting" placeholder="Informatica">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-chalkboard-teacher"></i> Klas</label>
                    <input type="text" name="klas" placeholder="INF1A">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-id-card"></i> Studentnummer *</label>
                    <input type="text" name="studentnummer" required placeholder="2024001">
                </div>
                
                <div class="form-group full-width">
                    <label><i class="fas fa-envelope"></i> E-mail </label>
                    <input type="email" name="email" placeholder="student@example.nl">
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">
                       Student toevoegen
                    </button>
                    <button type="button" class="btn" onclick="showTab('overview')">
                        Annuleren
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>