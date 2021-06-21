`#php` `#basics` `#master-in-software-engineering`

# PHP Server Environment <!-- omit in toc -->

We will explore the Server and PHP information and will create a small login and logout system that allows the user to access a Dashboard panel with a username and password.

## Technologies used <!-- omit in toc -->

\* PHP

## Index <!-- omit in toc -->


- [Server variables](#server-variables)
- [Session variables](#session-variables)
- [index.php](#indexphp)
- [validate.php](#validatephp)
- [panel.php](#panelphp)
- [close_session.php](#close_sessionphp)


## Server variables

PHP file that prints the $_SERVER variable. An excellent way to learn more about the information that the server obtains from the users.

```
$s = $_SERVER;

echo "<pre>";
print_r($s);
echo "<pre>";
```

## Session variables

PHP file that prints the $_SESSION variable. We can see better what does this variable is used for and how important it will be when working on the Server.

```
session_start();

$_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
$_SESSION["time"] = time();

echo "<pre>";
print_r($_SESSION);
```

We've introduced here the *session start function* that allows us to pass variables from one page to another thanks to the server session:

* session_start() [https://www.php.net/manual/es/function.session-start]

## index.php

Login page where the user can input the username and password. Here we have set up a couple of functions:

* The first one checks if the user has already logged in. If so, it redirects to the dashboard panel automatically.

```
if (isset($_SESSION["email"])) {
    header('Location: panel.php');
}
```

* The second feature shows an alert message if the user tries to log in with an incorrect email or password and also if they have just logged out.

```
<?php
    if (isset($_SESSION["error"])) {
        echo "<div class='bg-danger mb-3 p-2 text-center rounded'>Incorrect email or password</div>";
    } elseif (isset($_GET["logout"])) {
        echo "<div class='bg-info mb-3 p-2 text-center rounded'>You have logged out correctly</div>";
    }
?>
```

## validate.php

File with all the validation functions needed for the application. Basically it checks if the email and password are valid and let the user enter to the dashboard or it return to the index.php page showing an alert message.

```
$loginUser = $_POST["user"];
$loginPass = $_POST["pass"];

if ($loginUser == $user && password_verify($loginPass, $pass)) {
    $_SESSION["email"] = $user;
    $_SESSION["username"] = $name;
    unset($_SESSION["error"]);

    header("Location: panel.php");
} else {
    $_SESSION["error"] = true;

    header("Location: index.php");
}
```

## panel.php

Mockup of a dashboard page where the user is redirected once has logged in. We've implemented different PHP features:

* If the user tries to access the page without logging in, there's a redirection that goes back to the index.php page.

```
if (!isset($_SESSION["email"])) {
    header('Location: /index.php');
}
```

* The page shows the user email, that we saved on the *$_SESSION* variable before:

```
<div class="panel-link"><?= $_SESSION["email"] ?></div>
```

We show too the "user name" that we have obtained from cutting the email string:

```
$nameArr = explode("@", $user);
$name = ucwords($nameArr[0]);
```
The *explode()* function breaks the string into an array using the first string paramether as a breakpoint [https://www.php.net/manual/es/function.explode] 

The *ucwords()* function trasforms to upper case the first letter of a string [https://www.php.net/manual/es/function.ucwords]

```
Welcome to your Dashboard, <strong><?= $_SESSION["username"] ?></strong>
```

* We have also included the PHP Info function [https://www.php.net/manual/es/function.phpinfo]

## close_session.php

Filer with all the functions that the app needs to close the opened user session. We've mainly use it to unset and destroy the *$_SESSION* variable and the cookies we've set up with it.

```
unset($_SESSION);
```

First we unset the session variable [https://www.php.net/manual/en/function.unset]

```
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() + 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httpOnly"]
    );
}
```

We reset the cookie and all its paramethers [https://www.php.net/manual/en/function.ini-get.php]

```
session_destroy();
```

We destroy the session with the *session_destroy()* function [https://www.php.net/manual/es/function.session-destroy]

```
header('Location: index.php?logout=true');
```

Finally we redirect the user to the index.php site and add to the link a paramether that specifies that the user has just logged out.