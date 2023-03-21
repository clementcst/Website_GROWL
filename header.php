<link rel="stylesheet" href="css/header.css">
<header>
    <nav>
        <div class="left">
            <a href="index.php" ><img src="images/logo.png" class="logo"></a>
        </div>

        <div class="right">
            <div class="search-bar">
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" placeholder="Search">
            </div>
            <div class="nav-user online">
                <img src="images/user-1-pic.jpg" onclick="settingMenuOpen()">
            </div>
        </div>

    <!-- Settings User Menu-->
        <div class="setting-menu" id="close">
            <div class="setting-menu-top">
                <div class="user-profil-setting-menu">
                    <div class="setting-menu-profil-top">
                        <img src="images/user-1-pic.jpg">
                        <p>Jordan Gautier</p>
                    </div>
                    <div class="your-profil">
                        <a href="profil.php">See your Profil</a>
                    </div>
                </div>
            </div>

            <div class="settings-items">
                <div class="circle">
                    <ion-icon name="moon"></ion-icon>
                </div>
                <div class="settings-items-description">
                    <p>Change Theme</p>
                </div>
                <div id="dark-mode-btn" >
                    <span></span>
                </div>
            </div> 
            <div class="settings-items">
                <a href="settings.php"><div class="circle">
                    <ion-icon name="settings"></ion-icon>
                </div>
                <div class="settings-items-description">
                    <p>Settings</p>
                </div></a>
            </div> 
            <div class="settings-items">
                <a href="#"><div class="circle">
                    <ion-icon name="help-outline"></ion-icon>
                </div>
                <div class="settings-items-description">
                    <p>Need Help</p>
                </div></a>
            </div> 
            <div class="settings-items">
                <a href="#"><div class="circle">
                    <ion-icon name="log-out"></ion-icon>
                </div>
                <div class="settings-items-description">
                    <p>Logout</p>
                </div></a>
            </div> 

        </div> 
    </nav>
</header>
                