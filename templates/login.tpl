{include file="loginheader.tpl"}

    <div class="container">

      <form class="form-signin" name="form1" id="form1" method="post" action="">
        <h2 class="form-signin-heading">{$smarty.const.APPLICATION_NAME}</h2>
        <h3 class="form-signin-heading">Login utente</h3>
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

{include file="loginfooter.tpl"}