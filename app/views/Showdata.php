<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
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
      transition: all 0.4s ease;
      color: #fff;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.5);
      padding: 32px;
      backdrop-filter: blur(10px);
      transition: all 0.4s ease;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }
    h2 {
      margin: 0;
      font-size: 2.2rem;
      font-weight: 700;
      color: #fff;
      text-shadow: 0 2px 6px rgba(0,0,0,0.4);
    }
    .btn {
      display: inline-block;
      padding: 8px 18px;
      border-radius: 6px;
      font-size: 1rem;
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
    .btn-warning:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 14px rgba(236,159,5,0.5);
    }
    .btn-danger {
      background: linear-gradient(90deg, #d4145a 0%, #fbb03b 100%);
      color: #fff;
    }
    .btn-danger:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 14px rgba(244,67,54,0.5);
    }
    .btn-primary {
      background: linear-gradient(90deg, #673ab7 0%, #9c27b0 100%);
      color: #fff;
    }
    .btn-primary:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 14px rgba(156,39,176,0.5);
    }
    .search-form {
      display: flex;
      gap: 10px;
      margin-bottom: 18px;
    }
    .search-form input {
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.4);
      font-size: 1rem;
      flex: 1;
      background: rgba(255,255,255,0.15);
      color: #fff;
    }
    .search-form input::placeholder {
      color: rgba(255,255,255,0.7);
    }
    .card {
      overflow-x: auto;
      border-radius: 10px;
      background: rgba(255,255,255,0.08);
      box-shadow: 0 2px 6px rgba(0,0,0,0.4);
      transition: all 0.4s ease;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
    }
    th, td {
      padding: 12px 16px;
      text-align: left;
      font-size: 1rem;
    }
    th {
      background: rgba(0,0,0,0.3);
      font-weight: 700;
      text-transform: uppercase;
    }
    tr {
      transition: background 0.3s ease;
    }
    tr:hover td {
      background: rgba(255,255,255,0.08);
    }
    .actions {
      display: flex;
      gap: 8px;
    }
    .actions a.btn {
      padding: 6px 12px;
      font-size: 0.9rem;
    }

    /* ✅ Pagination styles */
    .pagination-container {
      margin-top: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .pagination-container ul {
      list-style: none;
      display: flex;
      gap: 6px;
      padding: 0;
      margin: 0;
    }
    .pagination-container li {
      display: inline-block;
    }
    .pagination-container a,
    .pagination-container span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 600;
      text-decoration: none;
      background: rgba(255,255,255,0.15);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.25);
      transition: all 0.3s ease;
    }
    .pagination-container a:hover {
      background: linear-gradient(90deg, #5b1f69 0%, #7a3e8a 100%);
      color: #fff;
      transform: scale(1.05);
    }
    .pagination-container .current,
    .pagination-container span {
      background: linear-gradient(90deg, #5b1f69 0%, #7a3e8a 100%);
      color: #fff;
      cursor: default;
      border-color: transparent;
      box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }
    @media (max-width: 700px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        margin-bottom: 1rem;
        border-radius: 8px;
        background: rgba(255,255,255,0.08);
        padding: 10px;
      }
      td {
        border: none;
        position: relative;
        padding-left: 50%;
        font-size: 0.95rem;
      }
      td:before {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 600;
        color: #eee;
        content: attr(data-label);
      }
    }

    /* ✅ Dark mode */
    body.dark {
      background: linear-gradient(135deg, #0d0312 0%, #1e0b2c 40%, #2e1b3f 70%, #3a2752 100%);
      color: #eee;
    }
    body.dark .container {
      background: rgba(0,0,0,0.5);
      border: 1px solid rgba(255,255,255,0.1);
    }
    body.dark .card {
      background: rgba(0,0,0,0.4);
    }
    body.dark th {
      background: rgba(255,255,255,0.08);
    }
    .dark-toggle {
      background: transparent;
      border: none;
      font-size: 1.4rem;
      color: #fff;
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    .dark-toggle:hover {
      transform: scale(1.2);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Students List</h2>
      <div style="display:flex; gap:12px; align-items:center;">
        <a class="btn btn-success" href="<?= site_url('/') ?>">Add Student</a>
        <!-- ✅ Dark/Light Toggle -->
        <button class="dark-toggle" id="darkToggle"><i class="fa fa-moon"></i></button>
      </div>
    </div>
    
    <!-- Search Form -->
    <form action="<?=site_url('/');?>" method="get" class="search-form">
      <?php
      $q = '';
      if(isset($_GET['q'])) {
        $q = $_GET['q'];
      }
      ?>
      <input name="q" type="text" placeholder="Search students..." value="<?=html_escape($q);?>">
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    
    <div class="card">
      <table>
        <thead>
        <tr>
          <th><i class="fa fa-hashtag"></i> ID</th>
          <th><i class="fa fa-user"></i> First Name</th>
          <th><i class="fa fa-user-astronaut"></i> Last Name</th>
          <th><i class="fa fa-envelope"></i> Email</th>
          <th><i class="fa fa-gears"></i> Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($students) && !empty($students)): ?>
          <?php foreach($students as $s): ?>
          <tr>
            <td data-label="ID"><?=$s['id'];?></td>
            <td data-label="First Name"><?=$s['first_name'];?></td>
            <td data-label="Last Name"><?=$s['last_name'];?></td>
            <td data-label="Email"><?=$s['email'];?></td>
            <td class="actions" data-label="Actions">
              <a href="<?= site_url().'user/update/'.$s['id'] ?>" class="btn btn-warning"><i class="fa fa-pen-to-square"></i> Edit</a>
              <a href="<?= site_url().'user/delete/'.$s['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete student?')"><i class="fa fa-trash"></i> Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px; color: #fff;">
              No students found.
            </td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    <?php if(isset($page) && !empty($page)): ?>
    <div class="pagination-container">
      <?= $page ?>
    </div>
    <?php endif; ?>
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
