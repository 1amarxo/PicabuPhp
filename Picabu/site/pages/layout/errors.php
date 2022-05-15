<?php
   if(isset($_POST['reg_user']) ||isset($_POST['login_user']) &&  count($errors)>0)  : ?>

    <div>
        <?php foreach($errors as $error): ?>
            <p style="color: red;"><?php echo $error?></p>
            <?php endforeach?>
    </div>
   <?php endif?>