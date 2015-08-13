<?php
function objeto2array( $object ){
  if( !is_object( $object ) && !is_array( $object ) ){
    return $object;
  }
  if(is_object( $object )){
  	$object = get_object_vars( $object );
  }
  return array_map( 'objeto2array', $object );
}
?>