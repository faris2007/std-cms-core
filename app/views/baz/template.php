<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$HEAD['TITLE']?></title>
    <link rel="stylesheet" href="<?=$STYLE_FOLDER?>css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$STYLE_FOLDER?>css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="<?=$STYLE_FOLDER?>css/jquery.fancybox-1.3.4.css" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        <?=(@$DISABLE)?'' :"var Token = '".$this->core->token(TRUE)."';\n"?>
        var base_url = '<?=base_url()?>';
        var style_dir = '<?=$STYLE_FOLDER?>';
    </script>
    <script type="text/javascript" src="<?=$STYLE_FOLDER?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=$STYLE_FOLDER?>js/jquery.dataTables.js"></script>
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script src="<?=$STYLE_FOLDER?>js/jquery.nivo.slider.pack.js"></script>
    <script src="<?=$STYLE_FOLDER?>js/jquery.easing-1.3.pack.js"></script>
    <script src="<?=$STYLE_FOLDER?>js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="<?=$STYLE_FOLDER?>js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=$STYLE_FOLDER?>js/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="<?=$STYLE_FOLDER?>js/functions.js"></script>
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
    <script src="<?=$STYLE_FOLDER?>js/jquery.smoothscroll.js"></script>
    <?=meta($HEAD['META']['META'])?>
    <?=$HEAD['OTHER']?>
</head>

<body>
    <!-- header-wrap -->
    <div id="header-wrap">
        <header>

            <hgroup>
                <h1><a href="index.html">PageOne</a></h1>
                <h3>Just Another Styleshout Template</h3>
            </hgroup>

            <?=$MENU?>

        </header>
    </div>
    <!-- content-wrap -->
    <div class="content-wrap">

        <!-- main -->
        <section id="main">      
            <div class="intro-box">
                
                <h2>شركة طه باز وأولاده</h2>

                <p class="intro">شركة طه عبدالله باز وأولاده المحدوده هي شركة سعودية مقرها 
                مكة المكرمة تعمل في العديد من الأنشطة التجارية داخل وخارج 
                المملكة العربية السعودية , وتتنوع أنشطة الشركة بين خدمات 
                الحج والعمرة والفندقة والسياحة والمقاولات والإستيراد والتصدير
                .</p>

                <p class="intro">اقرأ المزيد <a href="#about-us">عنّا</a>  أو <a href="#contact">تواصل معنا</a> إذا أردت حجزنا 
                        لمشروعك القادم.</p>

            </div>

            <?=$SLIDERS_SHOW?>
            
            <div section id="contact" class="clearfix">
            </div>
        </section>
        <section id="cms-content">
            <?php if (@$NAV): ?>
                <div id="nav">
                    <ul>
                        <?php foreach($NAV as $key => $value): ?>
                        <li>&rsaquo;</li>
                        <li><a href="<?=$key?>"><?=$value?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?=$CONTENT?>
            <a class="back-to-top" href="#main">Back to Top</a>
        </section>
    </div>
    <!-- footer -->
    <footer>
        <div class="footer-content">
            <?php if($EXTMENU1): ?>
            <ul class="footer-menu">
                <?php foreach ($EXTMENU1 as $row): ?>
                    <li><a href="<?=$row->url?>"><?=$row->title?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <p class="footer-text">حقوق النسخ محفوظة 2013 لشركة طه عبدالله باز وأولاده المحدودة &nbsp;&nbsp;&nbsp; <?=@$DEVELOPMENT?></p>
        </div>

    </footer>
</body>
</html>