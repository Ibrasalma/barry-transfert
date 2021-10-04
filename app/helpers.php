<?php
  
function changeDateFormate($date){
    return Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateString();   
}
   
function imagePath($dossier,$image_name)
{
    return 'images/'.$dossier.'/'.$image_name;
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