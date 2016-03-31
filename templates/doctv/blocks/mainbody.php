<body id="bd" class="dark <?php echo strtolower($helper->device); ?>" data-spy="scroll" data-target="#menu">
	<header id="header">
		<?php if ($isFrontpage) { ?><h1 class="hide"><?php echo $sitename; ?></h1><?php } ?>
		<div class="wrapper gray-darkest">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="header-schedule">
							{schedule}
						</div>
						<div class="logo">
							<a href="<?php echo JURI::base(); ?>" title="<?php echo $sitename; ?>"><?php echo $sitename; ?></a>
						</div>
						<?php if ($helper->countModules('menu')) { ?>
							<jdoc:include type="modules" name="menu" />
						<?php } ?>
						<?php if ($helper->countModules('search')) { ?>
							<jdoc:include type="modules" name="search" />
						<?php } ?>						
						<ul class="header-anchors list-inline list-unstyled">
							<li>
								<a href="#"><i class="icon-placeholder"></i><span>پخش زنده</span></a>
							</li>
							<li>
								<a href="#"><i class="icon-placeholder"></i><span>کاتالوگ</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php // if ($helper->countModules('showcase')) { ?>
		<section id="showcase">
			<div class="wrapper gray-dark">
				{Showcase}
				<jdoc:include type="modules" name="showcase" />
			</div>
		</section>
	<?php // } ?>
	<?php // if ($helper->countModules('special')) { ?>
		<aside id="showcase">
			<div class="wrapper yellow">
				{Special}
				<jdoc:include type="modules" name="special" />
			</div>
		</aside>
	<?php // } ?>
	<main id="mainbody">
		<div class="wrapper content gray-dark">
			<?php if ($isFrontpage) { ?>
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<jdoc:include type="component" />
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if ($helper->countModules('content-left') || $helper->countModules('content-center') || $helper->countModules('content-right')) { ?>
				<div class="container">
					<div class="row">
						<?php if ($helper->countModules('content-right')) { ?>
							<div class="col-xs-12 col-md-4"><jdoc:include type="modules" name="content-right" /></div>
						<?php } ?>
						<?php if ($helper->countModules('content-center')) { ?>
							<div class="col-xs-12 col-md-4"><jdoc:include type="modules" name="content-center" /></div>
						<?php } ?>
						<?php if ($helper->countModules('content-left')) { ?>
							<div class="col-xs-12 col-md-4"><jdoc:include type="modules" name="content-left" /></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if ($helper->countModules('main-top-left') || $helper->countModules('main-top-right')) { ?>
			<div class="wrapper main-top gray-darker">
				<div class="container">
					<div class="row">
						<?php if ($helper->countModules('main-top-right')) { ?>
							<div class="col-xs-12 col-sm-6"><jdoc:include type="modules" name="main-top-right" /></div>
						<?php } ?>
						<?php if ($helper->countModules('main-top-left')) { ?>
							<div class="col-xs-12 col-sm-6"><jdoc:include type="modules" name="main-top-left" /></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if ($helper->countModules('main-left') || $helper->countModules('main-right')) { ?>
			<div class="wrapper main gray-dark">
				<div class="container">
					<div class="row">
						<?php if ($helper->countModules('main-right')) { ?>
							<div class="col-xs-12 col-sm-6"><jdoc:include type="modules" name="main-right" /></div>
						<?php } ?>
						<?php if ($helper->countModules('main-left')) { ?>
							<div class="col-xs-12 col-sm-6"><jdoc:include type="modules" name="main-left" /></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if ($helper->countModules('main-bot')) { ?>
			<div class="wrapper main-bot gray">
				<jdoc:include type="modules" name="main-bot" />
			</div>
		<?php } ?>
	</main>
	<footer id="footer">
		<div class="wrapper gray-darker">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3">
						<div class="footer-about">
							<a href="<?php echo JURI::base(); ?>"><img src="<?php echo JURI::base() ?>assets/img/logo_footer.png" /></a>
							<?php if ($helper->countModules('footer-about')) { ?><jdoc:include type="modules" name="footer-about" /><?php } ?>
						</div>
					</div>
					<div class="col-xs-12 col-md-9">
						<?php if ($helper->countModules('footer')) { ?><jdoc:include type="modules" name="footer" /><?php } ?>
						<?php if ($helper->countModules('copyright')) { ?><jdoc:include type="modules" name="copyright" /><?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php if ($helper->countMessages($app->getMessageQueue())) { ?><jdoc:include type="message" /><?php } ?>
	</footer>
	<script src="<?php echo JURI::base(); ?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo JURI::base(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo JURI::base(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo JURI::base(); ?>assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
	<script src="<?php echo JURI::base(); ?>assets/js/main.min.js?_=20160326"></script>
	<script type="text/javascript">
        // Piwik code
	</script>
</body>