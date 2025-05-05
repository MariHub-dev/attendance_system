<div class="sidebar">
  <a href="../index.php">
    <h6 class="mb-4">🔵 Attendance</h6>
  </a>

  <small>Overview</small>
  <a href="index.php">Dashboard</a>

  <small>Pages</small>
  <a href="add_students.php">Students List</a>
  <a href="view_att.php">View Attendance</a>
  <a href="mark_att.php">Mark Attendance</a>
  

  <a href="#" class="mt-5">Logout</a>
  <div class="mt-5 p-5 bg-primary rounded"></div>
</div>

<style>
  .sidebar {
    background-color: #02043F;
    padding: 16px;
    color: white;
    border-radius: 16px;
    height: 100vh;


  }

  .sidebar a {
    color: white;
    display: block;
    margin-bottom: 1rem;
    text-decoration: none;
  }

  small {
    color: #cfd1ff;
    margin-bottom: 10px;
  }

  .sidebar a:hover,
  .sidebar .active {
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
    background-color: #cfd8ff;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
  }
</style>