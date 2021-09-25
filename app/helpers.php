<?php
  
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function depotImagePath($image_name)
{
    return public_path('photos/depots/'.$image_name);
}

function validateImage(){
    return 'mimes:jpg, JPG, PNG, png, gif, pdf,xlx,csv|max:2048';
}

function validateEntry($entry){
    return htmlspecialchars($entry);
}

function getSevenDays(){ 
    $date = strtotime(date('Y-m-d'));
    $date = strtotime("-2 day", $date);
    return date('Y-m-d',$date);
}