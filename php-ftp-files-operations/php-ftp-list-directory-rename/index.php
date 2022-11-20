<?php

//ftp_nlist
//ftp_rename
//ftp_delete

$domain_name = "http://ademtest.site/";
$ip_address = "185.215.199.212";
$host_name = "cpweb07.misshosting.no";
$username = "ademtest";
$psw = "j8mVY9d)1!r0GD";


function showErr()
{
    $error = error_get_last();
    if (isset($error["message"])) :
        return $error["message"];
    endif;
}


$ft_conn = ftp_connect($ip_address);
if ($ft_conn) {
    echo "FTP connection is successfully";
    $login = ftp_login($ft_conn, $username, $psw);
    if ($login) {
        echo "Logged in successfully";
        ftp_chdir($ft_conn, "./public_html");
        $current_directory = ftp_pwd($ft_conn);
        // echo $current_directory;
        //ftp_nlist
        $path = ".";
        $files = ftp_nlist($ft_conn, $path);//normald local de scann_dir in yaptgi islemin aynisini yapiyor
      //  print_r($files);

      //ftp_rename file
    //   $rename=ftp_rename($ft_conn,"adem_er.txt","adem.txt");
    //   if($rename){
    //     echo "Filename is changed";
    //   }else{
    //     echo showErr();
    //   }

 //ftp_rename folder
    //   $rename=ftp_rename($ft_conn,"adem-test","adem-test-folder");
    //   if($rename){
    //     echo "Folderame is changed";
    //   }else{
    //     echo showErr();
    //   }
    //ftp_delete - delete file i server
    // $ftp_del=ftp_delete($ft_conn,"adem.txt");
    // if($ftp_del){
    //     echo "Folder is deleted";
    // }else{
    //     echo showErr();
    // }

    } else {
        echo showErr();
    }
} else {
    echo "FTP connection is failed";
}

/*

//FTP DE DOSYA LISTESINI GORMEK ICIN
$path=".";
$files = ftp_rawlist($ftp_conn, $path);
print_r($files);
*/
