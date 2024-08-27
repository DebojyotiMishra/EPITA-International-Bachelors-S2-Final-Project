<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="icon" href="images/EPITA.svg">
    <title>Login</title>
</head>

<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="images/EPITA-nav.svg" alt="EPITA logo">
            </div>
        </div>
    </nav>

    <form class="form" action="php_actions/login_action.php" method="post">

        <!-- PHP CODE BLOCK -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <!-- PHP -->

        <h1 class="title">Welcome, authenticate</h1>
        <div class="flex-column">
            <label>Email </label>
        </div>
        <div class="inputForm">
            <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="Layer_3" data-name="Layer 3">
                    <path d="M0 11.25C0 17.6855 4.35547 21.5918 10.3516 21.5918C11.9727 21.5918 13.5156 21.3672 14.4727 21.0547C15.1465 20.8398 15.3613 20.4883 15.3613 20.127C15.3613 19.7656 15.0781 19.4922 14.7168 19.4922C14.5996 19.4922 14.4434 19.5117 14.2578 19.5605C13.0664 19.8535 12.041 20.0488 10.6641 20.0488C5.32227 20.0488 1.67969 16.8262 1.67969 11.3086C1.67969 6.02539 5.11719 2.34375 10.293 2.34375C14.873 2.34375 18.7012 5.16602 18.7012 10.2344C18.7012 13.1934 17.7051 15.1855 16.0938 15.1855C15.0195 15.1855 14.4141 14.5605 14.4141 13.4961V6.875C14.4141 6.34766 14.1211 6.02539 13.623 6.02539C13.1348 6.02539 12.832 6.34766 12.832 6.875V7.98828H12.7441C12.2461 6.78711 11.0254 6.02539 9.57031 6.02539C7.04102 6.02539 5.26367 8.18359 5.26367 11.2793C5.26367 14.4043 7.03125 16.582 9.60938 16.582C11.123 16.582 12.2949 15.7617 12.8613 14.375H12.9492C13.1348 15.752 14.2969 16.5918 15.8398 16.5918C18.5645 16.5918 20.2539 13.916 20.2539 10.166C20.2539 4.49219 16.084 0.810547 10.3125 0.810547C4.24805 0.810547 0 4.96094 0 11.25ZM9.87305 15.0391C8.125 15.0391 7.01172 13.584 7.01172 11.2695C7.01172 8.99414 8.13477 7.53906 9.88281 7.53906C11.6797 7.53906 12.8125 8.96484 12.8125 11.2305C12.8125 13.5449 11.6504 15.0391 9.87305 15.0391Z" fill="black" fill-opacity="0.85" />
                </g>
            </svg>
            <input type="text" class="input" placeholder="Enter your Email" name="email">
        </div>

        <div class="flex-column">
            <label>Password </label>
        </div>
        <div class="inputForm">
            <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1280_14)">
                    <path d="M2.19727 19.1504H11.1328C12.5684 19.1504 13.3301 18.3691 13.3301 16.8262V10.0977C13.3301 8.56445 12.5684 7.7832 11.1328 7.7832H2.19727C0.761719 7.7832 0 8.56445 0 10.0977V16.8262C0 18.3691 0.761719 19.1504 2.19727 19.1504ZM2.24609 17.6758C1.82617 17.6758 1.58203 17.4121 1.58203 16.9336V9.99023C1.58203 9.51172 1.82617 9.25781 2.24609 9.25781H11.084C11.5137 9.25781 11.748 9.51172 11.748 9.99023V16.9336C11.748 17.4121 11.5137 17.6758 11.084 17.6758H2.24609ZM1.70898 8.53516H3.26172V5.24414C3.26172 2.77344 4.83398 1.47461 6.66016 1.47461C8.48633 1.47461 10.0781 2.77344 10.0781 5.24414V8.53516H11.6211V5.44922C11.6211 1.77734 9.21875 0 6.66016 0C4.11133 0 1.70898 1.77734 1.70898 5.44922V8.53516Z" fill="black" fill-opacity="0.85" />
                </g>
                <defs>
                    <clipPath id="clip0_1280_14">
                        <rect width="13.6914" height="19.6582" fill="white" />
                    </clipPath>
                </defs>
            </svg>

            <input type="password" class="input" placeholder="Enter your Password" name="password">
        </div>

        <button class="button-submit">Sign In</button>
    </form>
</body>

</html>