<?php

session_start();

/**
 * @param string|null $message
 * @return void
 */
function flash(?string $message = null): void
{
    if($message){
        $_SESSION['flash'] = $message;

    } else {
        if(!empty($_SESSION['flash'])){ ?>

            <div class="error-text">
                <?=$_SESSION['flash']?>
            </div>

       <?php }
        unset($_SESSION['flash']);
    }
}
