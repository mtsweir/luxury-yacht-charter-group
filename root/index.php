<?php header('Content-type: text/html; charset=utf-8'); ?>
<?php
  // load viewer library
  $libraryPath = 'cms/lib/viewer_functions.php';
  $dirsToCheck = array('/home/luxurychartergroup/dev.luxurychartergroup.com/','','../','../../','../../../');
  foreach ($dirsToCheck as $dir) { if (@include_once("$dir$libraryPath")) { break; }}
  if (!function_exists('getRecords')) { die("Couldn't load viewer library, check filepath in sourcecode."); }

  // load record from 'homepage'
  list($homepageRecords, $homepageMetaData) = getRecords(array(
    'tableName'   => 'homepage',
    'where'       => '', // load first record
    'loadUploads' => true,
    'allowSearch' => false,
    'limit'       => '1',
  ));
  $homepageRecord = @$homepageRecords[0]; // get first record
  if (!$homepageRecord) { dieWith404("Record not found!"); } // show error message if no record found
  
  list($yachtsRecords, $yachtsMetaData) = getRecords(array(
    'tableName'   => 'yachts',
    'limit'       => '5',
    'allowSearch' => '0',
    'where'       => "feature = '1'" . ' AND active ="1"' . ' AND hide ="0"',
    'useSeoUrls'  => true,
    //'debugSql' =>'true',
  ));
  
  list($settingsRecords, $settingsMetaData) = getRecords(array(
    'tableName'   => 'settings',
    'limit'       => '1',
    'allowSearch'   => false,
  ));
  $settingsRecord = @$settingsRecords[0]; // get first record
  
?>
<? include("includes/headers.php"); ?>
<!doctype html>
<html class="no-js" lang="en" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($homepageRecord['title']): ?><?php echo $homepageRecord['title'] ?> - <?php endif ?><?php if ($settingsRecord['title']): ?><?php echo $settingsRecord['title'] ?><?php endif ?></title>
    <meta name="description" content="<?php echo $homepageRecord['meta_desc'] ?>" />
<? include("includes/head.php"); ?>
  </head>
<body>

<div id="skip"><a href="#content">Skip to Main Content</a></div>

<div class="off-canvas-wrap" data-offcanvas>
<div class="inner-wrap">

<? include("includes/top.php"); ?>

<div id="content">

<div class="media-photo home-hero">
    <div class="media-cover" style="background-image:url(<?php foreach ($homepageRecord['main_banner_background'] as $index => $upload): ?><?php echo $upload['urlPath'] ?><?php break ?><?php endforeach ?>)"></div>
    <div class="row row-table collapse">
        <div class="title text-center small-10 small-offset-1 col-middle column">
            <?php if ($homepageRecord['main_heading']): ?><h1 class="animated fadeIn"><?php echo htmlencode($homepageRecord['main_heading']) ?></h1><?php endif ?>
            <?php if ($homepageRecord['main_heading_intro']): ?><h2 class=""><?php echo htmlencode($homepageRecord['main_heading_intro']) ?></h2><?php endif ?>
        </div>
    </div>

    <div class="banner-search">
        <div class="row">
            <div class="medium-10 medium-offset-1 column">

                <div class="search-form">
                    <div class="row collapse">
                        <div class="medium-4 column">
                            <select class="input-list input-large" id="destination" name="destination">
                                <option value="1">Destination</option>
                                <option value="2">1</option>
                            </select>
                        </div>
                        <div class="medium-3 column">
                            <select class="input-list input-large" id="yacht_type" name="yacht_type">
                                <option value="1">Yacht Type</option>
                                <option value="2">Sailing Yachts</option>
                                <option value="3">Motor Yachts</option>
                                <option value="4">Catamarans</option>
                                <option value="5">Gulets</option>
                            </select>
                        </div>
                        <div class="medium-3 column">
                            <input class="input-search input-large" type="text" placeholder="keyword" />
                        </div>
                        <div class="medium-2 column">
                            <a href="#" class="button postfix">Search</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div id="choose_yacht">
    <div class="row small-collapse">
        <div class="small-12 column text-center">
            <?php if ($homepageRecord['choose_yacht']): ?><h2 class="section-header"><?php echo htmlencode($homepageRecord['choose_yacht']) ?></h2><?php endif ?>
            <?php if ($homepageRecord['choose_yacht_intro']): ?><p class="text-lead"><?php echo htmlencode($homepageRecord['choose_yacht_intro']) ?></p><?php endif ?>

            <ul class="grid-yacht-type small-block-grid-1 medium-block-grid-2 large-block-grid-4 text-center">
                <li>
                    <a href="#"><img src="images/tile-sailing-yacht.jpg" alt=""><h3>Sailing</h3></a>
                </li>
                <li>
                    <a href="#"><img src="images/tile-motor-yacht.jpg" alt=""><h3>Motor</h3></a>
                </li>
                <li>
                    <a href="#"><img src="images/tile-catamaran.jpg" alt=""><h3>Catamaran</h3></a>
                </li>
                <li>
                    <a href="#"><img src="images/tile-gulet.jpg" alt=""><h3>Gulets</h3></a>
                </li>
            </ul>
            
        </div>
    </div>
</div>

<div id="feat_advice" class="text-center">
    <div class="media-photo">
        <div class="media-cover" style="background-image:url(<?php foreach ($homepageRecord['experience_background'] as $index => $upload): ?><?php echo $upload['urlPath'] ?><?php break ?><?php endforeach ?>)"></div>
        <div class="row row-table collapse">
            <div class="title small-12 text-center col-middle column">
                <?php if ($homepageRecord['experience_heading']): ?><h1><?php echo htmlencode($homepageRecord['experience_heading']) ?></h1><?php endif ?>
                <?php if ($homepageRecord['experience_intro']): ?><p class="text-lead"><?php echo htmlencode($homepageRecord['experience_intro']) ?></p><?php endif ?>
                <?php if ($homepageRecord['experience_link']): ?><a href="<?php echo $homepageRecord['experience_link'] ?>" class="button button-secondary">Learn more</a><?php endif ?>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="small-12 column">
                <?php if ($homepageRecord['about_heading']): ?><h2 class="section-header"><?php echo htmlencode($homepageRecord['about_heading']) ?></h2><?php endif ?>
                <?php if ($homepageRecord['about_intro']): ?><p class="text-lead"><?php echo htmlencode($homepageRecord['about_intro']) ?></p><?php endif ?>
            </div>
        </div>
    </div>
</div>
<hr>
<div id="feat_destinations">
    <div class="row row-space-top-3">
        <div class="small-12 column text-center">
            <?php if ($homepageRecord['destinations_heading']): ?><h2 class="section-header"><?php echo htmlencode($homepageRecord['destinations_heading']) ?></h2><?php endif ?>
            <?php if ($homepageRecord['destinations_intro']): ?><p class="text-lead"><?php echo htmlencode($homepageRecord['destinations_intro']) ?></p><?php endif ?>
        </div>
    </div>
    <div class="panel-group row">
        <div class="medium-6 column">
            <div class="panel-wrap margin-space">
                <a href="#">
                    <img class="panel-img" src="images/tile-destination-caribbean.jpg" alt="">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <h4 class="destination-name">Caribbean</h4>
                            <h3>Explore coral atolls and uninhabited sandy islands</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="medium-6 column">
            <div class="panel-wrap margin-space">
                <a href="#">
                    <img class="panel-img" src="images/tile-destination-tahiti.jpg" alt="">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <h4 class="destination-name">Tahiti</h4>
                            <h3>Adventure awaits in this magical South Pacific paradise</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-group row">
        <div class="medium-4 column">
            <div class="panel-wrap margin-space">
                <a href="#">
                    <img class="panel-img" src="images/tile-destination-st-barts.jpg" alt="">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <h4 class="destination-name">St Barts</h4>
                            <h3>Gastronomic delights, bars, boutiques and culture</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="medium-4 column">
            <div class="panel-wrap margin-space">
                <a href="#">
                    <img class="panel-img" src="images/tile-destination-mediterranean.jpg" alt="">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <h4 class="destination-name">Mediterranean</h4>
                            <h3>From mystical coastlines to unspoilt cruising grounds</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="medium-4 column">
            <div class="panel-wrap margin-space">
                <a href="#">
                    <img class="panel-img" src="images/tile-destination-croatia.jpg" alt="">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <h4 class="destination-name">Croatia</h4>
                            <h3>Explore quaint seaside villages and historic towns</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 text-center">
            <div class="destination-sub">
                <?php if ($homepageRecord['destinations_link']): ?><a href="<?php echo htmlencode($homepageRecord['destinations_link']) ?>" class="button button-secondary">See all destinations</a><?php endif ?>
            </div>  
        </div>
    </div>
</div>

<section id="news">

    <div class="row">
        <div class="small-12 columns block-header text-center">
            <?php if ($homepageRecord['news_heading']): ?><h2 class="section-header"><?php echo htmlencode($homepageRecord['news_heading']) ?></h2><?php endif ?>
            <?php if ($homepageRecord['news_intro']): ?><p class="text-lead"><?php echo htmlencode($homepageRecord['news_intro']) ?></p><?php endif ?>
        </div>
    </div>

    <div class="row">

        <div class="small-12 columns">
            <div class="article-fluid">
                <article class="article article-snippet">
                    <a href="#">
                    <figure class="post-image"><img src="images/luxury_yacht_arcadia_jurata.jpg" alt=""></figure>
                    <div class="post-content">
                        <span class="post-date">March 20, 2015</span>
                        <h3>Environmentally-aware ARCADIA</h3>
                        <p>Italian shipyard, Arcadia Yachts are keeping pace with the trend towards larger superyachts, with new models the Arcadia 100 and 145 currently in build and preliminary plans for a 180.</p>
                    </div></a>
                </article>
            </div>
            <div class="article-fluid">
                <article class="article article-snippet">
                    <a href="#">
                    <figure class="post-image"><img src="images/alfa-nero-beach-club.jpg" alt=""></figure>
                    <div class="post-content">
                        <span class="post-date">March 20, 2015</span>
                        <h3>Join the Club – the Superyacht Beach Club</h3>
                        <p>Bigger and with more options than ever, the superyacht beach club brings charter guests as close as possible to the water.</p>
                    </div></a>
                </article>
            </div>
            <div class="article-fluid">
                <article class="article article-snippet">
                    <a href="#">
                    <figure class="post-image"><img src="images/onboard-spa.jpg" alt=""></figure>
                    <div class="post-content">
                        <span class="post-date">March 20, 2015</span>
                        <h3>Let's get Physical, or Spiritual – the choice is yours</h3>
                        <p>Today's superyacht Owners are incorporating high-tech gyms and dedicated spas on their superyachts to cater to the every wellness whim of their charter guests.</p>
                    </div></a>
                </article>
            </div>
        </div>

        <div class="small-12 text-center">
            <div class="destination-sub">
                <?php if ($homepageRecord['news_link']): ?><a href="<?php echo htmlencode($homepageRecord['news_link']) ?>" class="button button-secondary">More News</a><?php endif ?>
            </div>  
        </div>

    </div>

</section>

<section id="team">

    <div class="row">
        <div class="small-12 columns block-header text-center">
            <h2 class="section-header">Meet the Team</h2>
            <p class="text-lead">We're here to create an experience you'll always remember.</p>
        </div>
    </div>
    <?php
      // load records from 'brokers'
      list($brokersRecords, $brokersMetaData) = getRecords(array(
        'tableName'   => 'brokers',
        'loadUploads' => true,
        'allowSearch' => false,
      ));
    ?>
    <div class="row">
        <?php foreach ($brokersRecords as $record): ?>
        <div class="medium-4 columns">
            <div class="profile-card">
              <?php foreach ($record['photo'] as $index => $upload): ?><img src="<?php echo $upload['urlPath'] ?>" alt="<?php echo htmlencode($record['first_name']) ?> <?php echo htmlencode($record['last_name']) ?>"><?php break ?><?php endforeach ?>
              <div class="profile-info">
                <h4 class="subheader"><?php echo htmlencode($record['first_name']) ?> <?php echo htmlencode($record['last_name']) ?></h4>
                <h5 class="small"><?php echo htmlencode($record['region']) ?></h5>
                <ul class="no-bullet">
                    <li>Office: <?php echo htmlencode($record['phone']) ?></li>
                    <li>Cell: <?php echo htmlencode($record['cell']) ?></li>
                </ul>
                <a href="mailto:<?php echo htmlencode($record['email']) ?>" class="button button-secondary">Email <?php echo htmlencode($record['first_name']) ?></a>
              </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>

</section>

</div>

<? include("includes/footer.php"); ?>

<!-- close the off-canvas menu -->
<a class="exit-off-canvas"></a>

</div><!-- .inner-wrap -->
</div><!-- .off-canvas-wrap -->

<? include("includes/footer-scripts.php"); ?>

</body>
</html>
