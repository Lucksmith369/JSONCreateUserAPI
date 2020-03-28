<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
  exit();

delete_option( 'reactdeepl_tres' );
delete_option( 'reactdeepl_fres' );
delete_option( 'gmaps_API_Key' );