<?php 
// my_rentals.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
    // **User Not Logged In – Redirect to Login Page**
    header("Location: login.php");
    exit();
}

// **Retrieve User Information**
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// **Include Database Connection**
require_once 'db_connection.php';

// **Handle Search and Filter Inputs**
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : 'all';

// **Pagination Settings**
$rentals_per_page = 10;

// **Determine Current Page**
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// **Calculate Offset for SQL Query**
$offset = ($current_page - 1) * $rentals_per_page;

// **Build SQL Query with Search and Filter**
$sql = "SELECT rental_id, product_name, rental_date, return_date, status 
        FROM rentals 
        WHERE user_id = ?";

$types = "i"; // Initial type for user_id
$params = [$user_id]; // Initial parameter for user_id

// **Apply Search Filter**
if ($search !== '') {
    $sql .= " AND product_name LIKE ?";
    $types .= "s";
    $params[] = "%" . $search . "%";
}

// **Apply Status Filter**
if ($filter !== 'all') {
    $sql .= " AND status = ?";
    $types .= "s";
    $params[] = $filter;
}

$sql .= " ORDER BY rental_date DESC LIMIT ? OFFSET ?";

// **Add Types and Parameters for LIMIT and OFFSET**
$types .= "ii";
$params[] = $rentals_per_page;
$params[] = $offset;

// **Prepare Statement**
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

// **Bind Parameters Dynamically**
$stmt->bind_param($types, ...$params);

// **Execute and Fetch Results**
$stmt->execute();
$result = $stmt->get_result();
$rentals = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// **Fetch Total Rentals for Pagination**
$count_sql = "SELECT COUNT(*) FROM rentals WHERE user_id = ?";
$count_types = "i";
$count_params = [$user_id];

// **Apply Search Filter to Count Query**
if ($search !== '') {
    $count_sql .= " AND product_name LIKE ?";
    $count_types .= "s";
    $count_params[] = "%" . $search . "%";
}

// **Apply Status Filter to Count Query**
if ($filter !== 'all') {
    $count_sql .= " AND status = ?";
    $count_types .= "s";
    $count_params[] = $filter;
}

$count_stmt = $conn->prepare($count_sql);
if ($count_stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

$count_stmt->bind_param($count_types, ...$count_params);
$count_stmt->execute();
$count_stmt->bind_result($total_rentals);
$count_stmt->fetch();
$count_stmt->close();

// **Calculate Total Pages**
$total_pages = ceil($total_rentals / $rentals_per_page);

// **Close Database Connection**
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rentals - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Animate.css for additional animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        .container {
            margin-top: 80px; /* Adjusted for fixed navbar */
        }
        footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
            text-align: center;
            position: relative;
            width: 100%;
            bottom: 0;
        }
        table th, table td {
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .status-current {
            color: #0d6efd;
            font-weight: bold;
        }
        .status-completed {
            color: #198754;
            font-weight: bold;
        }
        .status-canceled {
            color: #dc3545;
            font-weight: bold;
        }
        /* Pagination Styles */
        .pagination {
            justify-content: center;
        }
        /* Search and Filter Form */
        .search-filter-form {
            margin-bottom: 20px;
        }
        /* Confirmation Modal */
        .modal-confirm {		
            color: #434e65;
            width: 350px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }
        .modal-confirm .modal-header {
            border-bottom: none;   
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }	
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;		
            border-radius: 5px;
            font-size: 13px;
        }	
        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #0d6efd;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border: none;
        }
        .modal-confirm .btn:hover, .modal-confirm .btn:focus {
            background: #0b5ed7;
            outline: none;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">TECH RIDE</h1>
    </div>
</header>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TECH RIDE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="my_rentals.php">My Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
<div class="container mt-5 pt-4">
    <h2>Your Rentals</h2>
    <p>Manage your current and past rentals here.</p>
    
    <?php
    // Display Success or Error Messages
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success animate__animated animate__fadeInDown">' . htmlspecialchars($_SESSION['success']) . '</div>';
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger animate__animated animate__fadeInDown">' . htmlspecialchars($_SESSION['error']) . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    
    <!-- Search and Filter Form -->
    <form class="row g-3 search-filter-form" method="GET" action="my_rentals.php">
        <div class="col-md-4">
            <input type="text" class="form-control" name="search" placeholder="Search by Product Name" value="<?php echo htmlspecialchars($search); ?>">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="filter">
                <option value="all" <?php if($filter === 'all') echo 'selected'; ?>>All Statuses</option>
                <option value="current" <?php if($filter === 'current') echo 'selected'; ?>>Current</option>
                <option value="completed" <?php if($filter === 'completed') echo 'selected'; ?>>Completed</option>
                <option value="canceled" <?php if($filter === 'canceled') echo 'selected'; ?>>Canceled</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>
    
    <?php if (count($rentals) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped animate__animated animate__fadeIn">
                <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>Product Name</th>
                        <th>Rental Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $rental): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rental['rental_id']); ?></td>
                            <td><?php echo htmlspecialchars($rental['product_name']); ?></td>
                            <td><?php echo htmlspecialchars(date("F j, Y, g:i a", strtotime($rental['rental_date']))); ?></td>
                            <td>
                                <?php 
                                    if ($rental['return_date']) {
                                        echo htmlspecialchars(date("F j, Y, g:i a", strtotime($rental['return_date'])));
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $status = htmlspecialchars($rental['status']);
                                    if ($status === 'current') {
                                        echo '<span class="status-current">Current</span>';
                                    } elseif ($status === 'completed') {
                                        echo '<span class="status-completed">Completed</span>';
                                    } elseif ($status === 'canceled') {
                                        echo '<span class="status-canceled">Canceled</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if ($rental['status'] === 'current'): ?>
                                    <button class="btn btn-sm btn-danger" onclick="confirmCancellation(<?php echo $rental['rental_id']; ?>)">Cancel</button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled>Action</button>
                                <?php endif; ?>
                                <a href="rental_details.php?rental_id=<?php echo htmlspecialchars($rental['rental_id']); ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <!-- Previous Button -->
                <li class="page-item <?php if($current_page <=1){ echo 'disabled'; } ?>">
                  <a class="page-link" href="?page=<?php echo $current_page-1; ?>&search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>" tabindex="-1">Previous</a>
                </li>
                
                <!-- Page Numbers -->
                <?php 
                // Display a range of pages around the current page
                $range = 2; // Number of pages to show on either side
                for($page = max(1, $current_page - $range); $page <= min($total_pages, $current_page + $range); $page++): ?>
                    <li class="page-item <?php if($current_page == $page){ echo 'active'; } ?>">
                        <a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>"><?php echo $page; ?></a>
                    </li>
                <?php endfor; ?>
                
                <!-- Next Button -->
                <li class="page-item <?php if($current_page >= $total_pages){ echo 'disabled'; } ?>">
                  <a class="page-link" href="?page=<?php echo $current_page+1; ?>&search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>">Next</a>
                </li>
              </ul>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <p>You have no rentals at the moment.</p>
    <?php endif; ?>
</div>
    
<footer>
    <p>&copy; <?php echo date("Y"); ?> TECH RIDE. All rights reserved.</p>
    <div>
        <a href="faq.php" style="color: #ff6600; text-decoration: none;">FAQ'S</a> | 
        <a href="privacy_policy.php" style="color: #ff6600; text-decoration: none;">Privacy Policy</a> | 
        <a href="terms_of_service.php" style="color: #ff6600; text-decoration: none;">Terms of Service</a>
    </div>
</footer>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-confirm">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Cancellation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel this rental? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
        <a href="#" class="btn btn-danger" id="confirmCancelBtn">Yes, Cancel It</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery for easier DOM manipulation (optional, Bootstrap 5 doesn't require it) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fade-in effect on scroll using Intersection Observer
    document.addEventListener('DOMContentLoaded', () => {
        const faders = document.querySelectorAll('.animate__animated');

        const appearOptions = {
            threshold: 0.1,
            rootMargin: "0px"
        };

        const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    return;
                } else {
                    entry.target.classList.add('animate__fadeInUp');
                    appearOnScroll.unobserve(entry.target);
                }
            });
        }, appearOptions);

        faders.forEach(fader => {
            appearOnScroll.observe(fader);
        });
    });

    // Handle Cancellation Confirmation
    let rentalIdToCancel = null;

    function confirmCancellation(rentalId) {
        rentalIdToCancel = rentalId;
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'), {
            keyboard: false
        });
        confirmModal.show();
    }

    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        if(rentalIdToCancel){
            window.location.href = `cancel_rental.php?rental_id=${rentalIdToCancel}`;
        }
    });
</script>
</body>
</html>
