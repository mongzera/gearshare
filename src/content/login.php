<div class="content-container flex-col">
        <form action="/login" method="POST" class="form-container flex-col ">
            <h2 class="inter">Login</h2><br><br>
      
            <?php
                if(isset($_GET['wrongCredentials']) && $_GET['wrongCredentials'] === 'true'){
                    echo "<p class='error'>Wrong Credentials</p>";
                }
            ?>

            <input class='input-field inter' type="text" name="username" id="username" placeholder="Username"/>
            <input class='input-field inter' type="password" name="password" id="password" placeholder="Password">
            <input class='input-field input-submit btn1' type="submit" value="Log In">

        </form>
        
        
</div>