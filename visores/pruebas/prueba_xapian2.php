<?php
ini_set("display_errors",true);
include ("xapian1.php");
$posting = $database->postlist_begin( $search_id );
$enquire = new XapianEnquire( $database );
$rset = new XapianRset();
$rset->add_document( $posting->get_docid() );
$eset = $enquire->get_eset(20, $rset);
$i = $eset->begin();
$terms = array();
while ( !$i->equals($eset->end()) ) {
    $terms[] = $i->get_term();
    $i->next();
}
$query = new XapianQuery( XapianQuery::OP_OR, $terms );
$enquire->set_query( $query ); 
$matches = $enquire->get_mset( 0, $max_recommended+1 );
$ids = array();
$i = $matches->begin();
while ( !$i->equals($matches->end()) ) {
    $n = $i->get_rank() + 1;
    if( $i->get_document()->get_value( $field_id ) != $post->id ) {
        $ids[] = $i->get_document()->get_value( $field_id );
    }
    $i->next();
}
