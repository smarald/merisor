<div class="title">Login</div>

<div class="box">
    <?php echo  $form->begin(); ?>
    <table border="0" cellspacing="0" width="100%">
        <tr>
            <td ><br /><?php echo  $error ?></td>
        </tr>
        <tr>
            <td>Utilizator: </td>
            <td><?php echo  $form->text('username', ' class="loginInput" ') ?></td>
        </tr>
        <tr>
            <td>Parola: </td>
            <td><?php echo  $form->password('pass', ' class="loginInput" ') ?></td>
        </tr>
        <tr>
            <td align="center"><input type="submit" name="btnSubmit" value="Login" class="button"></td>
        </tr>
    </table>
    <?php echo  $form->end();  ?>
    </div>