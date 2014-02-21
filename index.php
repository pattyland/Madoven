<?php
if (!defined('WB_PATH')) die(header('Location: ../../../index.php'));
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php page_title('', '[PAGE_TITLE] | [WEBSITE_TITLE]'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo defined('DEFAULT_CHARSET') ? DEFAULT_CHARSET : 'utf-8'; ?>" >
	<meta name="description" content="<?php page_description(); ?>">
	<meta name="keywords" content="<?php page_keywords(); ?>">
	
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/amelia/bootstrap.min.css" rel="stylesheet">
	<style>
	.post-top > td {
		margin-top: 40px;
	}
	tr.post-top > td, footer {
		padding-top: 40px;
	}
	</style>
	<?php
	if (function_exists('register_frontend_modfiles')) {
		register_frontend_modfiles('css');
		register_frontend_modfiles('jquery');
		register_frontend_modfiles('js');
	} ?>
</head>
<body>

	<?php
	if(SHOW_MENU) {
	?>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="<?php echo WB_URL; ?>"><?php page_title('', '[WEBSITE_TITLE]'); ?></a>
		  </div>
		  <div class="collapse navbar-collapse" id="mainmenu">
		    <?php show_menu2(0,SM2_ROOT,SM2_START, null,'[if(class==menu-current){<li class="active">}else{<li>}][a][menu_title]</a>','</li>','<ul class="nav navbar-nav">','</ul>');?>
		    
		    <?php if (SHOW_SEARCH) { ?>
		    <form class="navbar-form navbar-left" role="search" name="search" action="<?php echo WB_URL; ?>/search/index.php" method="get">
		    	<input type="hidden" name="referrer" value="<?php echo defined('REFERRER_ID') ? REFERRER_ID : PAGE_ID; ?>" />
		      <div class="form-group">
		        <input type="text" name="string" class="form-control" placeholder="<?php echo $TEXT['SEARCH']; ?>">
		      </div>
		      <!--<button type="submit" class="btn btn-default"><?php echo $TEXT['SEARCH']; ?></button>-->
		    </form>
		    <?php } ?>
		    
		    <ul class="nav navbar-nav navbar-right">
		    <?php if(FRONTEND_LOGIN AND !$wb->is_authenticated() AND VISIBILITY != 'private' ) { ?>
		    	<li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#logindialog"><?php echo $TEXT['LOGIN']; ?></button></li>
		    <?php } ?>
		    <?php if (is_numeric(FRONTEND_SIGNUP)) { ?>
			    	<li><a href="<?php echo SIGNUP_URL; ?>"><?php echo $TEXT['SIGNUP']; ?></a></li>
			    		
			<?php } ?>
			<?php if (FRONTEND_LOGIN AND $wb->is_authenticated()) { ?>
				<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $wb->get_display_name(); ?> <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			          <li><a href="<?php echo PREFERENCES_URL; ?>"><?php echo $MENU['PREFERENCES']; ?></a></li>
			          <li><a href="javascript:void(0)" onclick="document.logout.submit();"><?php echo $MENU['LOGOUT']; ?></a></li>
			          <form name="logout" action="<?php echo LOGOUT_URL; ?>" method="post"></form>
			        </ul>
			     </li>
			<?php } ?>
			</ul>
		  </div>
		</div>
	</nav>		
<?php
	
		if(FRONTEND_LOGIN AND !$wb->is_authenticated() AND VISIBILITY != 'private' ) {
			$redirect_url = ((isset($_SESSION['HTTP_REFERER']) && $_SESSION['HTTP_REFERER'] != '') ? $_SESSION['HTTP_REFERER'] : WB_URL );
			$redirect_url = (isset($thisApp->redirect_url) ? $thisApp->redirect_url : $redirect_url );
?>
		<div class="modal fade" id="logindialog" tabindex="-1" role="dialog" aria-labelledby="logindialog" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title"><?php echo $TEXT['LOGIN']; ?></h4>
		      </div>
		      <form name="login" role="form" action="<?php echo LOGIN_URL; ?>" method="post">
				  <input type="hidden" name="redirect" value="<?php echo $redirect_url;?>" />
		      <div class="modal-body">
		         <div class="form-group">
				    <input type="text" class="form-control" name="username" placeholder="<?php echo $TEXT['USERNAME']; ?>">
				 </div>
				 <div class="form-group">
				    <input type="password" class="form-control" name="password" placeholder="<?php echo $TEXT['PASSWORD']; ?>">
				 </div>
				 <a href="<?php echo FORGOT_URL; ?>"><?php echo $TEXT['FORGOT_DETAILS']; ?></a>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $TEXT['CANCEL']; ?></button>
		        <button type="submit" class="btn btn-primary"><?php echo $TEXT['LOGIN']; ?></button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>

		
		<?php
		} 
		?>
	
	<?php } ?>
	
	
	<div class="container">
	
		<header><?php page_header(); ?></header>
		
		<?php if (LEVEL > 0) { ?>
		<ol class="breadcrumb">
			<li><a href="<?php echo WB_URL; ?>"><span class="glyphicon glyphicon-home"></span></a>
			<?php show_menu2(0, SM2_ROOT, SM2_CURR, SM2_CRUMB, '[if(class==menu-current){<li class="active">[menu_title]</li>}else{<li>[a][menu_title]</a></li>}]', '', '', ''); ?>
		</ol>
		<?php } ?>
		
	
		<?php if (gettype(LEVEL) === 'string') { ?> 
		<h1><?php page_title('', '[PAGE_TITLE]'); ?></h1>
		<?php } ?>
		
		<div class="row">
		<?php 
		
			ob_start();
			page_content(1);
			$main=ob_get_contents(); 
			ob_end_clean();
			
			//libxml_use_internal_errors(true);
			/*$doc = new DOMDocument();
			$doc->loadHTML($main);
			
			/*foreach( $doc->getElementsByTagName('input') as $tag) {
		        $tag->setAttribute('class', ($tag->hasAttribute('class') ? $tag->getAttribute('class') . ' ' : '') . 'form-control');
		    }
		    
		    foreach( $doc->getElementsByTagName('button') as $tag) {
		        $tag->setAttribute('class', ($tag->hasAttribute('class') ? $tag->getAttribute('class') . ' ' : '') . 'btn btn-default');
		    }
			
			$main = $doc->saveHTML();*/
		
			ob_start();
			page_content(2);
			$sidebar=ob_get_contents(); 
			ob_end_clean(); 
			
			
			ob_start();
			//show_menu2(0,SM2_ROOT,SM2_START, null,'[if(class==menu-current){<li class="active">}else{<li>}][a][menu_title]</a>','</li>','<ul class="nav navbar-nav">','</ul>'
			show_menu2(0, SM2_CURR+1, SM2_CURR+2, null, false, false, '<h2>'.$TEXT['MORE'].'</h2><ul class="nav nav-pills nav-stacked">', '</ul>');
			$submenu=ob_get_contents(); 
			ob_end_clean();
				
			if (strlen($sidebar)==0 && strlen($submenu)==0) {
				echo '<div class="col-md-12">'.$main.'</div>';
			} else {
				echo '<div class="col-md-9">'.$main.'</div><div class="col-md-3">'.$submenu.$sidebar.'</div>';
			}			
			
		?>
		</div>
	 
		<footer>
			<p class="text-center">Powered By <a href="http://www.websitebaker.org/" target="_blank">Website Baker</a> - Theme Madoven by <a href="http://pattyland.de/" target="_blank">pattyland</a></p>
			<?php page_footer();?>
		</footer>
	</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<?php
if (function_exists('register_frontend_modfiles_body')) { register_frontend_modfiles_body(); } 
?>
</body>
</html>
<?php

function getElementsByClassName(DOMDocument $DOMDocument, $ClassName)
{
    $Elements = $DOMDocument -> getElementsByTagName("*");
    $Matched = array();
 
    foreach($Elements as $node)
    {
        if( ! $node -> hasAttributes())
            continue;
 
        $classAttribute = $node -> attributes -> getNamedItem('class');
 
        if( ! $classAttribute)
            continue;
 
        $classes = explode(' ', $classAttribute -> nodeValue);
 
        if(in_array($ClassName, $classes))
            $Matched[] = $node;
    }
 
    return $Matched;
}

?>