<?php
session_start();
include('includes/header.php');
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register Form</h4>
                        </div>
                    <div class="card-body">
                            <div class="input-field">
                                <i class="material-icons prefix">person</i>
                                <input type=text id="username" name="username" >
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input type=password id="password" name="password" >
                                <label for="password">Password</label>
                            </div>
                            <div style="float:right">
                                <button onclick="window.location.replace('index.php');" class="btn shadow-none text-dark" style="background-color:transparent">Login</button>
                                <button type=submit class="btn btn-primary" style="">Register</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
include('includes/footer.php');
?>