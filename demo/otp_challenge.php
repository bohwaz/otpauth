<?php
     
    require_once('user_functions.php');
    require_once('db_functions.php');
    require_once('../otp.php');
     
    $uid = get_user_id();
     
     
    $otp = $_POST['form_challenge_response'];
    $login = $_POST['login'];
     
    /* LICENSED UNDER THE GPL */
    ###############################################################################################
    #
    # if they have clicked the login button
    #
    ###############################################################################################
    if ($login) {
        // six word format test/convert
        if (!is_array($otp)) {
            $otp = explode(' ', $otp);
        }
        $cur = ivcs_transform_from($otp);
        $last = __otp_hash(sha1($cur));
        $sequence = get_otp_seq($uid);
        $match = demo_compare_last_otp($sequence, $last, $uid);
         
        if (!$match) {
            print "<h1>Invalid OTP</h1>";
        } else {
            // update session/auth state
            demo_set_last_otp($sequence+1, $cur, $uid);
            //redirect to requested page
            header("Location: index.php");
            exit();
        }
    } else {
    }
     
    ###############################################################################################
    #
    # print out login page
    #
    ###############################################################################################
    print "<HTML><HEAD><TITLE>Login</TITLE></HEAD>";
     
     
    $sequence = get_otp_seq($uid);
    if ($sequence == -1) {
        /* print error message and exit; */
    }
     
    print " <body>
        <a href='reset.php'>reset demo</a>
        <p>
        <FORM ACTION=\"otp_challenge.php\" METHOD=\"POST\">
        <p>
        Enter One-Time Password for Challenge number <B>$sequence</B>:
        <br><INPUT TYPE=\"TEXT\" NAME=\"form_challenge_response\" VALUE=\"$form_challenge_response\" SIZE=\"31\">
        <p>
        <INPUT TYPE=\"SUBMIT\" NAME=\"login\" VALUE=\"Login\">
        </FORM>
        </body>
        </html>
        ";
?>
<?php
     
?>
<?php
    /*
    -----BEGIN PGP MESSAGE-----
    Version: GnuPG v1.2.1 (GNU/Linux)
     
    hQIOA6jz1R+atzBZEAf9EJXPCKrk9SPzLNALLY61g9oxSIq/eExVKDkTeTed9y5p
    HV37pp2tJXBoT5kNJ46Y2/xd1tDmfnSCD/cOVcjOafis7eGKElR39o4VXFi6ToqN
    w7RKZyY6TvL+uaFkNTHED4oSFRH7IYK9zxHBKoiO9qAcWBSaoMMgA1uyBoDvM6Hf
    +1TpyAO3I10KG50/rdWVLXWLaNaPk+dhmx7s965k9wrmYV6fdH79P1E/Z7grjv8o
    oPbNnF0PSruSc42ZTk4nfoMHI5ORJ5qAtN0BfWsFm+/zuwCci/zdNWDyY/7jrJWN
    lc2We5rVF4F6OLmKXUWWIIS2okAorIRmZt9Xc/e7Zgf9HtMZeJAJgHoLRgV9IHuw
    9Ul6hqk2634UpcIiRwfMU/0towB8qGRmm6f8ZEGy8FsYvdlO7JmRinVTY5RulhPD
    R8LWN/Y6kUd5DnS2ddfn75WrUuInTBtq0LKpLPZt6dZimdqO4skCxC2qkwVGEtjH
    hgyH9ItonQPD8Wkp2KliTq3D7NeTDfYC1fEkGzO2avIjue80mA0yfzCW1UNk2wd3
    kvHTicScLi40sUq57nKPZc4EM0/KngegNjSFNRuunN5iJ0Y4cvRs8bh/toLfcrQi
    7DxDs9BQMcPcbXSWoWYYwjWkcgI/mYAEKNnaegqG2NUh+yXJzhUSZsEnCLYEsKUg
    vtKZAb5HIw8MWdSSWzBvmzVDBX7TnXtwQVHfUTtZQZ17ZHE1pzKhSYQCOG/4OcFa
    EVMhXzyPRJ+DyrnZc85/5vrpAYNE1GLYatSb2jky2c4Alguk8KjzYvlZtDbnn8hs
    LgDvOA4zFzaVdEwlqJYzdRA5cEDDMDPWUaXgGYcfUoacp41fLPv9uWb/RHlaR4Ku
    ArepJGt9N5/Ztc3i
    =YHhe
    -----END PGP MESSAGE-----
    */
?>
