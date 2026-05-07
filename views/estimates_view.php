<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Your Estimate - Short Cutt LLC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">Short Cutt LLC</div>
            <nav>
                <ul>
                    <li><a href="estimates.php" class="active">Estimates</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="login-info">
                <?php if (isset($is_logged_in) && $is_logged_in): ?>
                    Logged in as: <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                    <a href="logout.php"><button class="logout-btn">Logout</button></a>
                <?php else: ?>
                    <a href="index.php"><button class="logout-btn">Login</button></a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="content-box">
            <div class="estimate-form">
                <h2>Get Your Free Estimate</h2>
                
                <?php if (!empty($message)) echo $message; ?>

                <form method="POST" action="estimates.php" id="estimateForm">
                    <div class="form-group">
                        <label for="service_type">Select Type</label>
                        <select id="service_type" name="service_type" required>
                            <option value="">Choose a service...</option>
                            <option value="Rock" <?php echo (isset($saved_estimate['service_type']) && $saved_estimate['service_type'] == 'Rock') ? 'selected' : ''; ?>>Rock</option>
                            <option value="Mulch" <?php echo (isset($saved_estimate['service_type']) && $saved_estimate['service_type'] == 'Mulch') ? 'selected' : ''; ?>>Mulch</option>
                            <option value="Lawn" <?php echo (isset($saved_estimate['service_type']) && $saved_estimate['service_type'] == 'Lawn') ? 'selected' : ''; ?>>Lawn</option>
                            <option value="Snow" <?php echo (isset($saved_estimate['service_type']) && $saved_estimate['service_type'] == 'Snow') ? 'selected' : ''; ?>>Snow</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="total_area">Total Area (sq ft)</label>
                        <input type="number" id="total_area" name="total_area" step="0.01" value="<?php echo $saved_estimate['total_area'] ?? '0'; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="plants_count">Number of Plants</label>
                        <input type="number" id="plants_count" name="plants_count" value="<?php echo $saved_estimate['plants_count'] ?? '0'; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tree_removal_count">Tree Removal Count</label>
                        <input type="number" id="tree_removal_count" name="tree_removal_count" value="<?php echo $saved_estimate['tree_removal_count'] ?? '0'; ?>" required>
                    </div>

                    <div class="total-display">
                        <h3>Estimated Total</h3>
                        <div class="total-amount" id="totalAmount">$0.00</div>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn-clear" id="clearBtn" onclick="forceClear()">Clear</button>        
                        <button type="button" class="btn-load-styled" onclick="location.reload()" <?php echo (!isset($is_logged_in) || !$is_logged_in) ? 'disabled' : ''; ?>>Load Saved</button>
                        <button type="submit" id="saveBtn" name="save" class="btn-save" <?php echo (!isset($is_logged_in) || !$is_logged_in) ? 'disabled' : ''; ?>>Save</button>
                        <button type="button" class="btn-discard" id="discardBtn" <?php echo (!isset($is_logged_in) || !$is_logged_in) ? 'disabled' : ''; ?>>Discard & Save 0</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function calculateTotal() {
        const type = document.getElementById('service_type').value;
        const area = parseFloat(document.getElementById('total_area').value) || 0;
        const plants = parseInt(document.getElementById('plants_count').value) || 0;
        const trees = parseInt(document.getElementById('tree_removal_count').value) || 0;

        const rates = { 'Rock': 5, 'Mulch': 3, 'Lawn': 2, 'Snow': 4 };
        let total = (rates[type] || 0) * area;
        total += (plants * 25) + (trees * 200);

        document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
    }

    function forceClear() {
        if (confirm('Wipe form entries?')) {
            document.getElementById('service_type').value = "";
            document.getElementById('total_area').value = "0";
            document.getElementById('plants_count').value = "0";
            document.getElementById('tree_removal_count').value = "0";
            calculateTotal();
        }
    }

    // New Discard & Save 0 Logic
    document.getElementById('discardBtn').addEventListener('click', function() {
        if (confirm('This will reset your database save to $0.00. Continue?')) {
            document.getElementById('service_type').value = "";
            document.getElementById('total_area').value = "0";
            document.getElementById('plants_count').value = "0";
            document.getElementById('tree_removal_count').value = "0";
            
            // Programmatically submit the form so the controller saves the 0s
            const form = document.getElementById('estimateForm');
            const hiddenSave = document.createElement('input');
            hiddenSave.type = 'hidden';
            hiddenSave.name = 'save';
            hiddenSave.value = '1';
            form.appendChild(hiddenSave);
            form.submit();
        }
    });

    ['service_type', 'total_area', 'plants_count', 'tree_removal_count'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateTotal);
    });

    window.onload = calculateTotal;
    </script>
</body>
</html>