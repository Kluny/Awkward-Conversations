<?php
	/*
	Plugin Name: Log Error
	*/

	if ( ! function_exists( 'sg_log' ) ) {
		function sg_log( $log, $email = false ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}

			if ( $email ) {
				do_action( 'tell_admin', $log );
			}
		}
	}

	function sg_tell_admin( $log ) {
		mail( 'shannon@geeksonthebeach.ca', 'Logger error report', print_r( $log, true ) );
	}

	add_action( 'tell_admin', 'sg_tell_admin' );
