<?php echo validation_errors(); ?>


<?php 
	if($agenda==null){
		echo form_open('user/save'); 
?>
    <label for="username">Code</label>
    <input type="input" name="username" value="<?php echo $value['username']; ?>" disabled/><br />

    <label for="password">Password</label>
    <input type="input" name="password" value="<?php echo $value['password']; ?>"/><br />

    <label for="retype-password">Re-Type Password</label>
    <input type="input" name="retype-password" value="<?php echo $value['password']; ?>"/><br />

    <label for="agenda">Agenda</label>
    <textarea name="agenda"><?php echo $value['bagian']; ?></textarea><br />

    <input type="submit" name="submit" value="Tambah User" />
<?php
	}else{
        $value = $user[0]; 
        echo form_open('user/save/'.$value['code']);    
?>
	<label for="username">Code</label>
    <input type="input" name="username" value="<?php echo $value['username']; ?>" disabled/><br />

    <label for="password">Password</label>
    <input type="input" name="password" value="<?php echo $value['password']; ?>"/><br />

    <label for="retype-password">Re-Type Password</label>
    <input type="input" name="retype-password" value="<?php echo $value['password']; ?>"/><br />

    <label for="agenda">Agenda</label>
    <textarea name="agenda"><?php echo $value['bagian']; ?></textarea><br />

    <input type="submit" name="submit" value="Rubah User" />
<?php
	}
?>
</form>