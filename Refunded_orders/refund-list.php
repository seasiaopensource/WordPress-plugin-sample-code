
<?php
/* This file contain code for display Refunded form data
	It is located in wp-content/plugins/refund_list/refund-list.php
*/
function refund_list() {
global $wpdb;
$Sql =	"SELECT * FROM refund_ids";
$content =	$wpdb->get_results($Sql); 
?>
 <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/refund-list/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>List of All Refunded Orders with comments </h2>
     <table class='wp-list-table widefat fixed striped posts'>
          <tr>
               <th class="manage-column ss-list-width">#</th>
                <th class="manage-column ss-list-width">Order Id</th>
                <th class="manage-column ss-list-width">Email</th>
                <th class="manage-column ss-list-width">Account Holder's Name</th>
                <th class="manage-column ss-list-width">Bank Name</th>
                <th class="manage-column ss-list-width">Account Number</th>
                <th class="manage-column ss-list-width">Ifsc Code</th>
                <th class="manage-column ss-list-width">Pan card Number</th>
		</tr>
		<?php 
			$i = 1 ;
			foreach ($content as $row) {
				$order_id = $row->order_id;
				$loop = new WP_Query( $row );
				switch_to_blog( 2 ); // To get or pull data from other site in multisite 
				$email = get_post_meta( $order_id, '_billing_email', true ); // get billing email of Order
		?>
				<tr>
					<td class="manage-column ss-list-width"><?php echo $i; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->order_id; ?></td>
					<td class="manage-column ss-list-width"><?php echo $email; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->user_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->bank_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->Account_no; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->ifsc_code; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->pan_number; ?></td>
				</tr>
            <?php 
				$i++;
			}
           ?>
        </table>
    </div>
	<?php 
		switch_to_blog(1); // switch back to main site
	}
?>