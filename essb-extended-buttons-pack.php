<?php

/*
 * Plugin Name: Easy Social Share Buttons for WordPress: Extended Buttons Pack
 * Description: Extended support by Easy Social Share Buttons list of networks (we will update that package regularly with specific social networks). You can request your own by contacting us <a href="https://socialsharingplugin.com/contact-us/">https://socialsharingplugin.com/contact-us/</a>
 * Page Plugin URI: http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo
 * Version: 1.0 
 * Author: CreoApps 
 * Author URI: http://codecanyon.net/user/appscreo/portfolio?ref=appscreo
 */

//http://www.jiathis.com/
//http://share.baidu.com/

define ( 'ESSB_EP_ROOT', dirname ( __FILE__ ) . '/' );
define ( 'ESSB_EP_URL', plugins_url () . '/' . basename ( dirname ( __FILE__ ) ) );

add_filter ( 'essb4_social_networks', 'essb_extended_pack_register' );

function essb_extended_pack_register($networks) {
	$networks ['hatena'] = array ('name' => 'Hatena', 'type' => 'buildin', 'supports' => 'desktop,mobile,retina templates only' );
	$networks ['douban'] = array ('name' => 'Douban', 'type' => 'buildin', 'supports' => 'desktop,mobile,retina templates only' );
	$networks ['qzone'] = array ('name' => 'Tencent QQ', 'type' => 'buildin', 'supports' => 'desktop,mobile,retina templates only' );
	$networks ['naver'] = array ('name' => 'Naver', 'type' => 'buildin', 'supports' => 'desktop,mobile,retina templates only' );	
	$networks ['renren'] = array ('name' => 'Renren', 'type' => 'buildin', 'supports' => 'desktop,mobile,retina templates only' );
	
	return $networks;
}

add_action ( 'wp_enqueue_scripts', 'essbep_register_assets', 2 );
add_action ( 'admin_enqueue_scripts', 'essbep_register_assets_admin', 100 );

function essbep_register_assets() {
	if (! defined ( 'ESSB3_VERSION' )) {
		return;
	}
	
	if (essb_is_plugin_deactivated_on () || essb_is_module_deactivated_on ( 'share' )) {
		return;
	}
	
	$resource_url = ESSB_EP_URL . '/assets/essb-extended-pack.css';
	essb_resource_builder ()->add_static_resource ( $resource_url, 'easy-social-share-buttons-extended-pack', 'css' );
	essb_resource_builder ()->activate_resource ( 'essb-ep' );
	
}

function essbep_register_assets_admin() {
	wp_register_style ( 'essb-ep-admin-icon', ESSB_EP_URL . '/assets/essb-extended-pack.css', array (), ESSB3_VERSION );
	wp_enqueue_style ( 'essb-ep-admin-icon' );

}

add_filter ( 'essb4_shareapi_url_hatena', 'essb_ep_url_hatena' );
add_filter ( 'essb4_shareapi_url_douban', 'essb_ep_url_douban' );
add_filter ( 'essb4_shareapi_url_qzone', 'essb_ep_url_qzone' );
add_filter ( 'essb4_shareapi_url_naver', 'essb_ep_url_naver' );
add_filter ( 'essb4_shareapi_url_renren', 'essb_ep_url_renren' );

function essb_ep_url_hatena($share) {
	return 'http://b.hatena.ne.jp/bookmarklet?url='.$share['url'].'&btitle='.$share['title'];
}

function essb_ep_url_douban($share) {
	return 'http://www.douban.com/share/service?name=&amp;href=http://demoism.wpindeed.com/&amp;image='.$share['image'].'&amp;updated=&amp;bm=&amp;url='.$share['url'].'&amp;title='.$share['title'];
}

function essb_ep_url_qzone($share) {
	return 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='.$share['url'].'&title='.$share['title'].'&desc=&summary=&site=';
}

function essb_ep_url_naver($share) {
	return 'http://blog.naver.com/openapi/share?url='.$share['url'].'&title='.$share['title'];
}

function essb_ep_url_renren($share) {
	return 'http://widget.renren.com/dialog/share?resourceUrl='.$share['url'].'&title='.$share['title'].'&description='.$share['description'].'&pic='.$share['image'];
}