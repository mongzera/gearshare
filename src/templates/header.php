<?php 
    use Src\Middleware\Auth;
?>

<div class="header-container  align-center">
    <div class="title">
        <a class='nav-link nav-title align-center bold' href="/">GearShare</a>
    </div>
    <div class="nav align-center">
        

        <?php 

            if(!Auth::verify()) {
                echo '<div class="top-nav flex-row justify-right">
                <a class="nav-link bold" href="/create-account">Create Account</a> <span class="bold">|</span>
                <a class="nav-link bold" href="/login">Log In</a>
                </div>';
            }

        ?>
        
        
        <div class="bottom-nav">
            <a class='nav-link' href='/?search_bar=bike+parts'>Bike Parts</a>
            <a class='nav-link' href='/?search_bar=motor+parts'>Motor Parts</a>
    
            <?php 

                if(Auth::verify()) {
                    echo "<a class='nav-link bold' href='/logout'> {$_SESSION['username']} </a>";
                }else{
                    echo "<a class='nav-link' href='/create-account'>Become a Seller</a>";
                }
            ?>
        </div>
    </div>
</div>