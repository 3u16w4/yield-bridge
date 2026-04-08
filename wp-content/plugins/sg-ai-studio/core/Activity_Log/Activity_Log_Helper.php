<?php
namespace SG_AI_Studio\Activity_Log;

/**
 * Activity log helper class
 */
class Activity_Log_Helper {

	/**
	 * Add a log entry to the activity log
	 *
	 * @param string $activity The activity type (e.g., 'Plugins', 'Posts', 'Users', etc.).
	 * @param string $description The activity description (e.g., 'Plugin Installed: hello-dolly').
	 * @param int    $visitor_id Optional visitor ID, defaults to current user ID.
	 *
	 * @return bool|int False on failure, log entry ID on success.
	 */
	public static function add_log_entry( $activity, $description, $visitor_id = null ) {
		global $wpdb;

		// Get current user ID if visitor_id not provided.
		if ( null === $visitor_id ) {
			$visitor_id = get_current_user_id();
			// If no user is logged in, use 0.
			if ( ! $visitor_id ) {
				$visitor_id = 0;
			}
		}

		// Get the log table name.
		$table_name = $wpdb->prefix . 'sg_ai_log_events';

		// Check if table exists.
		if ( ! Activity_Log::table_exists( $table_name ) ) {
			Activity_Log::create_log_tables();
		}

		// Insert the log entry.
		$result = $wpdb->insert(
			$table_name,
			array(
				'visitor_id'  => $visitor_id,
				'ts'          => time(),
				'activity'    => sanitize_text_field( $activity ),
				'description' => sanitize_text_field( $description ),
			),
			array( '%d', '%d', '%s', '%s' )
		);

		if ( false === $result ) {
			return false;
		}

		return $wpdb->insert_id;
	}

	/**
	 * Get log entries.
	 *
	 * @param array $args Query arguments.
	 *
	 * @return array Log entries.
	 */
	public static function get_log_entries( $args = array() ) {
		global $wpdb;

		$defaults = array(
			'limit'      => 50,
			'offset'     => 0,
			'activity'   => '',
			'visitor_id' => null,
			'date_from'  => '',
			'date_to'    => '',
			'order_by'   => 'ts',
			'order'      => 'DESC',
		);

		$args = wp_parse_args( $args, $defaults );

		$table_name = $wpdb->prefix . 'sg_ai_log_events';

		// Check if table exists.
		if ( ! Activity_Log::table_exists( $table_name ) ) {
			return array();
		}

		// Build query.
		$query = "SELECT * FROM `{$table_name}` WHERE 1=1";

		// Add filters.
		if ( ! empty( $args['activity'] ) ) {
			$query .= $wpdb->prepare( ' AND activity = %s', $args['activity'] );
		}

		if ( null !== $args['visitor_id'] ) {
			$query .= $wpdb->prepare( ' AND visitor_id = %d', $args['visitor_id'] );
		}

		if ( ! empty( $args['date_from'] ) ) {
			$timestamp_from = strtotime( $args['date_from'] );
			if ( $timestamp_from ) {
				$query .= $wpdb->prepare( ' AND ts >= %d', $timestamp_from );
			}
		}

		if ( ! empty( $args['date_to'] ) ) {
			$timestamp_to = strtotime( $args['date_to'] );
			if ( $timestamp_to ) {
				$query .= $wpdb->prepare( ' AND ts <= %d', $timestamp_to );
			}
		}

		// Add ordering.
		$allowed_order_by = array( 'ts', 'activity', 'visitor_id', 'id' );
		$order_by         = in_array( $args['order_by'], $allowed_order_by, true ) ? $args['order_by'] : 'ts';
		$order            = 'ASC' === strtoupper( $args['order'] ) ? 'ASC' : 'DESC';

		$query .= " ORDER BY `{$order_by}` {$order}";

		// Add limit.
		if ( $args['limit'] > 0 ) {
			$query .= $wpdb->prepare( ' LIMIT %d OFFSET %d', $args['limit'], $args['offset'] );
		}

		return $wpdb->get_results( $query, ARRAY_A );
	}

	/**
	 * Get activity statistics.
	 *
	 * @param string $date_from Optional start date.
	 * @param string $date_to Optional end date.
	 *
	 * @return array Activity statistics.
	 */
	public static function get_activity_stats( $date_from = '', $date_to = '' ) {
		global $wpdb;

		$table_name = $wpdb->prefix . 'sg_ai_log_events';

		// Check if table exists.
		if ( ! Activity_Log::table_exists( $table_name ) ) {
			return array();
		}

		$query = "SELECT activity, COUNT(*) as count FROM `{$table_name}` WHERE 1=1";

		// Add date filters.
		if ( ! empty( $date_from ) ) {
			$timestamp_from = strtotime( $date_from );
			if ( $timestamp_from ) {
				$query .= $wpdb->prepare( ' AND ts >= %d', $timestamp_from );
			}
		}

		if ( ! empty( $date_to ) ) {
			$timestamp_to = strtotime( $date_to );
			if ( $timestamp_to ) {
				$query .= $wpdb->prepare( ' AND ts <= %d', $timestamp_to );
			}
		}

		$query .= ' GROUP BY activity ORDER BY count DESC';

		return $wpdb->get_results( $query, ARRAY_A );
	}
}
