<?php

namespace AoDTechnologies;



class Analytics {
	private static $queue = array();
	
	private static $queue_ready = false;
	
	public static function init() {
		add_action( 'init', array( get_called_class(), 'send_queue' ) );
	}
	
	public static function send_queue() {
		if ( !self::$queue_ready ) {
			self::$queue_ready = true;
			
			foreach ( self::$queue as $time => $trackable ) {
				$trackable['args']['qt'] = ( time() - intval( $time ) ) * 1000;
				
				if ( $trackable['args']['uid'] === 'CURRENT_USER' ) {
					$trackable['args']['uid'] = get_current_user_id();
				}
				
				self::send_trackable( $trackable );
			}
		}
	}
	
	public static function generate_uuid() {
		return sprintf(
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			
			// 32 bits for "time_low"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			
			// 16 bits for "time_mid"
			mt_rand(0, 0xffff),
			
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand(0, 0x0fff) | 0x4000,
			
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand(0, 0x3fff) | 0x8000,
			
			// 48 bits for "node"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}
	
	public static function get_current_url() {
		global $wp;
		
		return add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	}
	
	public static function track( $cid, $args, $uid = null ) {
		$args = wp_parse_args( $args, array(
			// Protocol Version
			'v' => '1',
			
			// Tracking ID / Web Property ID
			'tid' => 'UA-75655200-1',
			
			// Data Source
			'ds' => 'WordPress Plugin',
			
			// Queue Time
			'qt' => '0',
			
			// Document Referer
			'dr' => wp_get_referer(),
			
			// Campaign Name
			'cn' => 'WordPress Plugin Analytics',
			
			// Campaign Source
			'cs' => 'Server-Side',
			
			// Campaign Medium
			'cm' => 'organic',
			
			// User Language
			'ul' => get_locale(),
			
			// Hit Type
			't' => 'event',
			
			// Document Location URL
			'dl' => self::get_current_url(),
			
			// Document Host Name
			'dh' => $_SERVER['SERVER_NAME'],
			
			// Document Path
			'dp' => $_SERVER['REQUEST_URI'],
			
			// Event Category
			'ec' => 'WordPress Plugin Event',
			
			// Event Action
			'ea' => 'Track Event'
		) );
		
		if ( $args['dr'] === FALSE ) {
			unset( $args['dr'] );
		}
		
		if ( $args['t'] !== 'event' ) {
			unset( $args['ec'] );
			unset( $args['ea'] );
			unset( $args['el'] );
			unset( $args['ev'] );
		}
		
		if ( $uid !== null ) {
			$args['uid'] = $uid;
		}
		
		$trackable = array(
			'cid' => $cid,
			'args' => $args
		);
		
		if ( self::$queue_ready ) {
			self::send_trackable( $trackable );
		} else {
			self::$queue[time()] = $trackable;
		}
	}
	
	public static function send_trackable( $trackable ) {
		wp_remote_post( 'https://www.google-analytics.com/' . ( defined( 'WP_DEBUG' ) && WP_DEBUG === TRUE ? 'debug/' : '' ) . 'collect', array(
			'httpversion' => '1.1',
			'blocking' => false,
			'sslverify' => true,
			'body' => 'cid=' . rawurlencode( $trackable['cid'] ) . '&' . http_build_query( $trackable['args'], '', ini_get( 'arg_separator.output' ), PHP_QUERY_RFC3986 ) . '&z=' . time()
		) );
	}
}

Analytics::init();
