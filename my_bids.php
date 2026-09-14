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
    <title>My Bids - MFC</title>
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
        .bids-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .bid-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .bid-item:last-child {
            border-bottom: none;
        }
        .bid-info {
            flex: 1;
        }
        .bid-amount {
            font-size: 1.2em;
            font-weight: bold;
            color: #007bff;
        }
        .bid-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            font-weight: bold;
        }
        .status-active {
            background: #28a745;
            color: white;
        }
        .status-won {
            background: #28a745;
            color: white;
        }
        .status-lost {
            background: #dc3545;
            color: white;
        }
        .vehicle-info {
            flex: 2;
            text-align: right;
            color: #666;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-hammer"></i> My Bids</h1>
            <p>Track all your active and past bids</p>
        </div>

        <div class="bids-container">
            <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="bid-item">
                <div class="bid-info">
                    <div class="bid-amount">R<?php echo (50000 + ($i * 25000)); ?></div>
                    <div class="bid-status <?php echo $i % 3 === 0 ? 'status-active' : ($i % 3 === 1 ? 'status-won' : 'status-lost'); ?>">
                        <?php echo $i % 3 === 0 ? 'Active' : ($i % 3 === 1 ? 'Won!' : 'Lost'); ?>
                    </div>
                </div>
                <div class="vehicle-info">
                    <div>Vehicle <?php echo $i + 1; ?></div>
                    <div>202<?php echo (2018 + $i); ?></div>
                </div>
                <div class="vehicle-info">
                    <button class="btn btn-sm">Increase Bid</button>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
