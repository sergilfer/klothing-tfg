
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="Email" placeholder="Tu Email" id="email" value="<?php echo $email; ?>">

            <label for="password">Password</label>
            <input type="password" name="Password" placeholder="Tu Password" id="password" value="<?php echo $password; ?>">
        </fieldset>