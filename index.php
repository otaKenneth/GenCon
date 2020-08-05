<?php session_start();
require_once('api/index.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gen-Con</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        div.contact:nth-child(odd) {
            background-color: #dedede;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#" style="font-family: Engravers MT;">Gen|Con</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if (isset($_SESSION['user'])) { ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> -->
                    </ul>
                    <form action="api/Logout.php" class="form-inline my-2 my-lg-0">
                        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                </div>
            <?php } else { ?>
                <div class="col-10"></div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto my-2">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" id="option-login" href="#login">Login</a>
                                <a class="dropdown-item" id="option-register" href="#register">Register</a>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </nav>
    </header>

    <?php if (!isset($_SESSION['user'])) { ?>
        <section class="row justify-content-center">

            <form id="login" class="col-5" action="api/Login.php" method="POST">
                <div class="d-flex justify-content-center">
                    <h1 class="mt-5 mb-4">Login</h1>
                </div>

                <div class="form-group">
                    <label for="username" class="font-semibold">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password" class="font-semibold">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <form id="register" class="collapse col-5" action="api/Register.php" method="POST">
                <div class="d-flex justify-content-center">
                    <h1 class="mt-5 mb-4">Register</h1>
                </div>

                <div class="form-group">
                    <label for="username" class="font-semibold">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password" class="font-semibold">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="font-semibold">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </section>
    <?php } else { ?>
        <section class="row mx-0 justify-content-around mt-4">
            <div class="py-2 col-3 border-solid border border-gray-400 rounded-lg" style="height: 38vh;">
                <form action="api/Contact.php" method="post">
                    <div class="hidden">
                        <label for=""></label>
                        <input type="text" class="form-control" name="user_id" id="user_id" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user']['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" autofocus autocomplete="off" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="cnum">Contact No:</label>
                        <input type="text" class="form-control" name="cnum" id="cnum" aria-describedby="helpId" placeholder="0900 000 0000" maxlength="12" onkeypress="return event.key >= '0' && event.key <= '9'">
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn active">
                            Save in General Contacts?
                            <input type="checkbox" name="in_gen" id="in_gen" checked autocomplete="off">
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <?php if (isset($_GET['err'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if ($_GET['err'] == "meetmax") { ?>
                            <strong>General Contacts Meets is Maximum Storage.</strong>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="row justify-content-around col-8 border-solid border border-gray-400 rounded-lg p-3" style="height: 80vh;">
                <div id="gen-con" class="col-6">
                    <h4>General Contacts</h4>
                    <div class="">
                        <?php foreach ($contacts->where('in_gen')['data'] as $key => $value) {
                            if ($value['in_gen']) { ?>
                                <div class="row py-2 px-3 contact rounded-lg">
                                    <div class="col-9">
                                        <div class="name"><?php echo $value['name']; ?></div>
                                        <div class="cnum"><?php echo $value['cnum']; ?></div>
                                    </div>
                                    <div class="col-3">
                                        <form action="api/Contact.php" method="get">
                                            <input type="text" name="update" class="hidden" id="" value="move to personal contacts">
                                            <input type="text" name="contact_id" class="hidden" id="" value="<?php echo $value['id']; ?>">
                                            <button type="submit" name="move" class="btn btn-primary h-100" title="Move to Personal Contacts">Move</button>
                                        </form>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div id="per-con" class="col-5">
                    <h4>Personal Contacts</h4>
                    <div class="">
                        <?php $p_con = $contacts->where('user_id', $_SESSION['user']['id']); $p_con = isset($p_con['data']) ? $p_con['data']:$p_con; ?>
                        <?php foreach ($p_con as $key => $value) {
                            if (!$value['in_gen']) { ?>
                                <div class="py-2 px-3 contact rounded-lg">
                                    <div class="name"><?php echo $value['name']; ?></div>
                                    <div class="cnum"><?php echo $value['cnum']; ?></div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <footer></footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="index.js"></script>
</body>

</html>