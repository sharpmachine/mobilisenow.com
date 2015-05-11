<?phpadd_action('inbound_store_lead_pre','wp_cta_set_conversion',10,1);function wp_cta_set_conversion($data){	// Update Landing Page Conversions	if($data['post_type'] === 'wp-call-to-action')	{					//$disable_admin_tracking = get_option( 'wp-cta-main-landing-page-disable-admin-tracking', '0' );				//if ( !$disable_admin_tracking || !current_user_can( 'manage_options' ) )		//{							$lp_conversions = get_post_meta( $data['lp_id'], 'wp-cta-ab-variation-conversions-'.$data['lp_variation'], true );			$lp_conversions++;			update_post_meta(  $data['lp_id'] , 'wp-cta-ab-variation-conversions-'.$data['lp_variation'], $lp_conversions );		//}	}}function wp_cta_get_page_views($postID){    $count_key = 'wp_cta_page_views_count';    $count = get_post_meta($postID, $count_key, true);    if($count==''){        delete_post_meta($postID, $count_key);        add_post_meta($postID, $count_key, '0');        return;   }   return $count;}function wp_cta_set_page_views($postID) {    $count_key = 'wp_cta_page_views_count';    $count = get_post_meta($postID, $count_key, true);    if($count==''){        $count = 0;        delete_post_meta($postID, $count_key);        add_post_meta($postID, $count_key, '0');    }else{        $count++;        update_post_meta($postID, $count_key, $count);    }}function wp_cta_get_conversions($postID){    $count_key = 'wp_cta_page_conversions_count';    $count = get_post_meta($postID, $count_key, true);    if($count==''){        delete_post_meta($postID, $count_key);        add_post_meta($postID, $count_key, '0');        return "0";   }   return $count;}function wp_cta_set_conversions($postID) {    $count_key = 'wp_cta_page_conversions_count';    $count = get_post_meta($postID, $count_key, true);	//mail('hudson.atwell@gmail.com','hello',$count);    if($count==''){        $count = 0;        delete_post_meta($postID, $count_key);        add_post_meta($postID, $count_key, '0');    }else{        $count++;        update_post_meta($postID, $count_key, $count);    }}function wp_cta_get_useragent_whitelist(){	$useragent[] = 'msie';	$useragent[] = 'firefox';	$useragent[] = 'webkit';	$useragent[] = 'opera';	$useragent[] = 'netscape';	$useragent[] = 'konqueror';	$useragent[] = 'gecko';	$useragent[] = 'chrome';	$useragent[] = 'songbird';	$useragent[] = 'seamonkey';	$useragent[] = 'flock';	$useragent[] = 'AppleWebKit';	$useragent[] = 'Android';	$useragent[] = 'Lynx';	$useragent[] = 'Dillo';		return $useragent;}function wp_cta_determine_spider(){	if (isset($_SERVER['HTTP_USER_AGENT']))	{		$visitor_useragent = strtolower($_SERVER['HTTP_USER_AGENT']);		$visitor_ip = $_SERVER['REMOTE_ADDR'];	}	else	{		return 1;	}		//check to make sure useragent is present	if ($visitor_useragent)	{		$useragents = wp_cta_get_useragent_whitelist();		foreach ($useragents as $k=>$v) 		{			$v = trim($v);			if ($v)			{				if(stristr($visitor_useragent, $v)||$v=='*')				{					return 0;				}			}		}	}		return 1;}