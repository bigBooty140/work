<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: simple_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Vehicles - MFC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .page-header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .vehicle-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .vehicle-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f0f0f0;
        }
        .vehicle-info {
            padding: 15px;
        }
        .vehicle-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .vehicle-details {
            color: #666;
            font-size: 0.9em;
        }
        .bid-section {
            background: #e9ecef;
            padding: 15px;
            text-align: center;
        }
        .current-bid {
            font-size: 1.5em;
            font-weight: bold;
            color: #28a745;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-car"></i> Browse Vehicles</h1>
            <p>Explore our available vehicles and place your bids</p>
        </div>

        <div class="vehicle-grid">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="https://via.placeholder.com/300x200?text=Vehicle+<?php echo $i + 1; ?>" alt="Vehicle <?php echo $i + 1; ?>">
                </div>
                <div class="vehicle-info">
                    <div class="vehicle-title">Vehicle <?php echo $i + 1; ?></div>
                    <div class="vehicle-details">
                        <p><strong>Year:</strong> 202<?php echo (2018 + $i); ?></p>
                        <p><strong>Make:</strong> Toyota, Honda, Ford</p>
                        <p><strong>Model:</strong> Camry, Civic, F-150</p>
                        <p><strong>Price:</strong> R<?php echo (100000 + ($i * 50000)); ?></p>
                    </div>
                </div>
                <div class="bid-section">
                    <div class="current-bid">Current Bid: R<?php echo (50000 + ($i * 10000)); ?></div>
                    <button class="btn btn-primary">Place Bid</button>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
