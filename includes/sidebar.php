<div class="sidebar">
  <a href="index.php">
    <h6 class="mb-3">🔵 Attendance</h6>
  </a>

  <small>Overview</small>
  <a href="index.php"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>

  <small>Pages</small>
  <a href="students.php"><i class="bi bi-people-fill me-2"></i>Students List</a>
  

  <a href="mark_att.php"><i class="bi bi-pencil-square me-2"></i>Mark Attendance</a>
  <a href="view_att.php"><i class="bi bi-calendar-check-fill me-2"></i>View Attendance</a>

  <small>Others</small>
  

  <a href="index.php"><i class="bi bi-house-door-fill me-2"></i>settings</a>

  <a href="auth/logout.php" class=" logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
  <div class=" ad-box p-5  bg-primary rounded"></div>
</div>

<style>
  .sidebar {
    background-color: #02043F;
    padding: 16px;
    color: white;
    border-radius: 16px;
    height: 97vh;
    position: fixed;
    overflow-y: auto;
    overflow-y: scroll;
    scrollbar-width: none;

  }
  .sidebar::-webkit-scrollbar {
    display: none;             /* For Chrome, Safari, and Edge */
}

  .sidebar a {
    color: white;
    display: block;
    padding: 10px;
    
    text-decoration: none;
    font-size: 13px;

  }

  small {
    color: grey;
    margin-bottom: 20px;
  }

  .sidebar a:hover,
  .sidebar .active {
    background-color: blue;
    border-radius: 10px;
    color: #cfd1ff;

  }

  .topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    background-color: #ffffff;
    padding: 10px;
    border-radius: 12px;
    position: fixed;
    width: 81%;
  }

  .search-box input {
    background-color: rgb(221, 226, 250);
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    width: 100%;
  }

  .logout {
    margin-top: 120px;
  }
</style>