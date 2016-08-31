<?php

class wpcrowd_admin_rewrites {

	function add_admin_cpt_rewrite() {
		add_rewrite_tag('%author_cpt%', '([^&]+)');
		add_rewrite_rule('^author/([^/]+)/([^/]+)/?$', 'index.php?author_name=$matches[1]&author_cpt=$matches[2]', 'top');
		add_rewrite_rule('^author/([^/]+)/([^/]+)/page/([0-9]+)?$', 'index.php?author_name=$matches[1]&author_cpt=$matches[2]&page=$matches[3]', 'top');
	}
}