<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$session = $this->call->library('session');
$role = $session->get('role');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #1a0b1f 0%, #3a0d3e 40%, #5b1f69 70%, #7a3e8a 100%);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      color: #fff;
      transition: all 0.4s ease;
    }

    .container {
      width: 95%;
      max-width: 1100px;
      margin: 20px auto;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.5);
      padding: 24px;
      backdrop-filter: blur(10px);
      transition: all 0.4s ease;
      overflow-x: auto;
    }

    .header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px;
      gap: 12px;
    }

    h2 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
      color: #fff;
      text-shadow: 0 2px 6px rgba(0,0,0,0.4);
    }

    .btn {
      display: inline-block;
      padding: 6px 16px;
      border-radius: 6px;
      font-size: 0.95rem;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-success {
      background: linear-gradient(90deg, #7a3e8a 0%, #9c4dcc 100%);
      color: #fff;
    }
    .btn-success:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 14px rgba(156,77,204,0.5);
    }

    .btn-warning {
      background: linear-gradient(90deg, #b06ab3 0%, #ec9f05 100%);
      color: #222;
    }
    .btn-danger {
      background: linear-gradient(90deg, #d4145a 0%, #fbb03b 100%);
      color: #fff;
    }
    .btn-primary {
      background: linear-gradient(90deg, #673ab7 0%, #9c27b0 100%);
      color: #fff;
    }

    .search-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 18px;
    }

    .search-form input {
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.4);
      font-size: 1rem;
      flex: 1;
      min-width: 180px;
      background: rgba(255,255,255,0.15);
      color: #fff;
    }

    .card {
      overflow-x: auto;
      border-radius: 10px;
      background: rgba(255,255,255,0.08);
      box-shadow: 0 2px 6px rgba(0,0,0,0.4);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
      min-width: 600px;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      font-size: 0.95rem;
    }

    th {
      background: rgba(0,0,0,0.3);
      font-weight: 700;
      text-transform: uppercase;
    }

    tr:hover td {
      background: rgba(255,255,255,0.08);
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .pagination-container {
      margin-top: 18px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 6px;
    }

    .pagination-container a,
    .pagination-container strong {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      background: rgba(255,255,255,0.15);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.25);
      transition: all 0.3s ease;
    }

    .pagination-container a:hover {
      background: linear-gradient(90deg, #5b1f69 0%, #7a3e8a 100%);
      transform: scale(1.05);
    }

    .dark-toggle {
      background: transparent;
      border: none;
      font-size: 1.3rem;
      color: #fff;
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    .dark-toggle:hover { transform: scale(1.2); }

    @media (max-width: 640px) {
      .header, .search-form {
        flex-direction: column;
        align-items: stretch;
      }
      .search-form button {
        width: 100%;
      }
      .actions a {
        flex: 1 1 48%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Students Dashboard</h2>
      <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
        <span>Welcome, <?= html_escape($session->get('username')); ?> (<?= html_escape($role); ?>)</span>
        <button class="dark-toggle" id="darkToggle"><i class="fa fa-moon"></i></button>
      </div>
    </div>

    <!-- Search Form -->
    <form method="get" action="<?= site_url('/students') ?>" class="search-form">
      <input type="text" name="q" placeholder="Search student..." value="<?= html_escape($_GET['q'] ?? '') ?>">
      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
    </form>

    <!-- Students Table -->
    <div class="card">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <?php if ($role === 'admin'): ?>
              <th>Actions</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($students)): ?>
            <?php foreach($students as $student): ?>
              <tr>
                <td><?= html_escape($student['id']); ?></td>
                <td><?= html_escape($student['first_name']); ?></td>
                <td><?= html_escape($student['last_name']); ?></td>
                <td><?= html_escape($student['email']); ?></td>
                <?php if ($role === 'admin'): ?>
                  <td class="actions">
                    <a href="<?= site_url('students/update/'.$student['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i> Edit</a>
                    <a href="<?= site_url('students/delete/'.$student['id']); ?>" class="btn btn-danger" onclick="return confirm('Delete this student?');"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="<?= $role === 'admin' ? 5 : 4; ?>" style="text-align:center; padding:30px;">No records found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if (!empty($page_links)): ?>
    <div class="pagination-container">
      <?= $page_links; ?>
    </div>
    <?php endif; ?>

    <!-- Logout -->
    <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger" style="margin-top:20px;"><i class="fa fa-sign-out"></i> Logout</a>
  </div>

  <script>
    const toggle = document.getElementById("darkToggle");
    const body = document.body;
    if(localStorage.getItem("darkMode") === "1") {
      body.classList.add("dark");
      toggle.innerHTML = '<i class="fa fa-sun"></i>';
    }
    toggle.addEventListener("click", () => {
      body.classList.toggle("dark");
      const isDark = body.classList.contains("dark");
      toggle.innerHTML = isDark ? '<i class="fa fa-sun"></i>' : '<i class="fa fa-moon"></i>';
      localStorage.setItem("darkMode", isDark ? "1" : "0");
    });
  </script>
</body>
</html>
