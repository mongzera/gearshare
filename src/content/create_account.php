<div class="content-container flex-col">
        <form action="/create-account" method="POST" class="form-container flex-col ">
            <h2 class="inter">Create Account</h2><br><br>
      
            <input class='input-field inter' type="text" name="username" id="username" placeholder="Username"/>
            <input class='input-field inter' type="text" name="email" id="email" placeholder="Email"/>
            <input class='input-field inter' type="password" name="password" id="password" placeholder="Password">
            <input class='input-field inter' type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm Password">
            <input class='input-field input-submit btn1' type="submit" value="Create Account">

        </form>

        <?php

            if($create_account_error){
                echo '<h3 style="color: red;">' . $create_account_error . '</h3>';
            }
        ?>
</div>