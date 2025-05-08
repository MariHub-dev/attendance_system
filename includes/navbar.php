<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="topbar d-flex justify-content-between">
    <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class="bi bi-search"></i>
    </div>
    <div class="icons d-flex justify-content-center align-items-center gap-3 ">
    <a class="" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="bi bi-plus-square-fill"></i></a>
        <i class="bi bi-gear-wide-connected"></i>
        
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-4"></i>
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
       


    </div>
</div>

<style>
    .topbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;
        margin-bottom: 10px;
    }

    .icons i {
        color: rgb(5, 8, 78);
        font-size: 20px;
        cursor: pointer;
    }
    .search-box{
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:rgb(219, 219, 245);
        width: 30%;
        border-radius: 12px;
        padding: 0px 10px;
        cursor: pointer;
    }
    .search-box input{
        background-color: rgb(219, 219, 245) ;
    }
</style>
