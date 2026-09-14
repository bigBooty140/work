<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: simple_login.php");
    exit();
}

// Get user information
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MFC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <?php include_once "whatsapp_chatbot.php"; ?>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /* MFC Website Theme Colors */
        .mfc-primary { background: #006341 !important; }
        .mfc-secondary { background: #004d36 !important; }
        .mfc-accent { background: #03f4a9 !important; }
        .mfc-text { color: #006341 !important; }
        
        .dashboard-header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-top: 4px solid #006341;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
            background: linear-gradient(135deg, #006341 0%, #004d36 100%);
            color: white;
            padding: 40px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
            background-size: 100px 100px;
            opacity: 0.3;
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
        }
        
        .user-info {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-left: 4px solid #03f4a9;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
            border-top: 3px solid #006341;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #006341;
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            font-size: 3em;
            color: #03f4a9;
            margin-bottom: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-primary {
            background: #006341;
            color: white;
        }
        
        .btn-primary:hover {
            background: #004d36;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,99,65,0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108,117,125,0.3);
        }
        
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            z-index: 1000;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220,53,69,0.3);
        }
        
        /* Recent Activity Section */
        .recent-activity {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .activity-item:hover {
            background: #f8f9fa;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2em;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-time {
            color: #999;
            font-size: 0.9em;
        }
        
        /* Upcoming Auctions */
        .upcoming-auctions {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .auction-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #006341;
            transition: all 0.3s ease;
        }
        
        .auction-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .auction-date {
            font-size: 1.2em;
            font-weight: bold;
            color: #006341;
            margin-bottom: 5px;
        }
        
        .auction-details {
            color: #666;
            margin-bottom: 10px;
        }
        
        .auction-countdown {
            background: #03f4a9;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
            display: inline-block;
        }
        
        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .quick-stat {
            background: linear-gradient(135deg, #006341 0%, #004d36 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .quick-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,99,65,0.3);
        }
        
        .quick-stat-value {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .quick-stat-label {
            font-size: 0.9em;
            opacity: 0.9;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 20px;
            }
            
            .welcome-section {
                padding: 30px 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>

    <div class="container">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt" style="color: #006341;"></i> MFC Dashboard</h1>
            <p class="text-muted">Your complete auction and finance management center</p>
        </div>

        <div class="welcome-section">
            <div class="welcome-content">
                <h2>Welcome back, <?php echo htmlspecialchars($user_name); ?>! <i class="fas fa-hand-wave"></i></h2>
                <p>You are successfully logged in to your MFC account. Manage your bids, browse vehicles, and track your auction activity all in one place.</p>
                <div class="quick-stats">
                    <div class="quick-stat">
                        <div class="quick-stat-value">R0</div>
                        <div class="quick-stat-label">Total Bid Amount</div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-value">0</div>
                        <div class="quick-stat-label">Active Bids</div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-value">0</div>
                        <div class="quick-stat-label">Won Auctions</div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-value">0</div>
                        <div class="quick-stat-label">Watchlist Items</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-info">
            <h3><i class="fas fa-user-circle" style="color: #006341;"></i> Your Account Information</h3>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user_name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
                </div>
                <div class="col-md-4">
                    <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
                    <p><strong>Account Status:</strong> <span class="badge bg-success">Active</span></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Member Since:</strong> <?php echo date('F j, Y'); ?></p>
                    <p><strong>Last Login:</strong> <?php echo date('g:i A, M j'); ?></p>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Active Bids</div>
                <p class="text-muted">Currently bidding on vehicles</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Won Auctions</div>
                <p class="text-muted">Successfully won vehicles</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Viewed Vehicles</div>
                <p class="text-muted">Vehicles you've viewed</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Watchlist</div>
                <p class="text-muted">Saved for later</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="recent-activity">
                    <h3><i class="fas fa-history" style="color: #006341;"></i> Recent Activity</h3>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #e8f5e8;">
                            <i class="fas fa-sign-in-alt" style="color: #006341;"></i>
                        </div>
                        <div class="activity-content">
                            <div><strong>Logged in to your account</strong></div>
                            <div class="activity-time">Just now</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #fff3cd;">
                            <i class="fas fa-user-edit" style="color: #856404;"></i>
                        </div>
                        <div class="activity-content">
                            <div><strong>Profile updated</strong></div>
                            <div class="activity-time">2 days ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #f8d7da;">
                            <i class="fas fa-car" style="color: #721c24;"></i>
                        </div>
                        <div class="activity-content">
                            <div><strong>Viewed Toyota Camry 2020</strong></div>
                            <div class="activity-time">3 days ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #d1ecf1;">
                            <i class="fas fa-heart" style="color: #0c5460;"></i>
                        </div>
                        <div class="activity-content">
                            <div><strong>Added vehicle to watchlist</strong></div>
                            <div class="activity-time">1 week ago</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="upcoming-auctions">
                    <h3><i class="fas fa-calendar-alt" style="color: #006341;"></i> Upcoming Auctions</h3>
                    <div class="auction-card">
                        <div class="auction-date">Tuesday, April 15, 2026</div>
                        <div class="auction-details">
                            <strong>Live Vehicle Auction</strong><br>
                            50+ vehicles available including sedans, SUVs, and trucks
                        </div>
                        <span class="auction-countdown">Starts in 3 days</span>
                    </div>
                    <div class="auction-card">
                        <div class="auction-date">Thursday, April 17, 2026</div>
                        <div class="auction-details">
                            <strong>Premium Vehicle Auction</strong><br>
                            Luxury vehicles and high-end models
                        </div>
                        <span class="auction-countdown">Starts in 5 days</span>
                    </div>
                    <div class="auction-card">
                        <div class="auction-date">Tuesday, April 22, 2026</div>
                        <div class="auction-details">
                            <strong>Commercial Vehicle Auction</strong><br>
                            Trucks, vans, and commercial vehicles
                        </div>
                        <span class="auction-countdown">Starts in 10 days</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="browse_vehicles.php" class="btn btn-primary">
                <i class="fas fa-search"></i> Browse Vehicles
            </a>
            <a href="my_bids.php" class="btn btn-primary">
                <i class="fas fa-hammer"></i> My Bids
            </a>
            <a href="watchlist.php" class="btn btn-primary">
                <i class="fas fa-heart"></i> My Watchlist
            </a>
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize WhatsApp chatbot
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observe all cards
            document.querySelectorAll('.stat-card, .activity-item, .auction-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
            
            // Update countdown timers
            function updateCountdowns() {
                const countdowns = document.querySelectorAll('.auction-countdown');
                countdowns.forEach(countdown => {
                    // This would normally calculate actual countdown
                    // For demo purposes, we'll just show the text
                });
            }
            
            updateCountdowns();
            setInterval(updateCountdowns, 60000); // Update every minute
        });
    </script>
</body>
</html>
