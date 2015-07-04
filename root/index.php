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
                    <form id="searchhome" name="searchhome" method="get" action="/search.php">
                        <div class="row collapse">
                            <div class="medium-4 column">
                                <select class="input-list input-large" id="destination" name="destination">
                                    <?php
                                      // load records from 'destinations' for search box
                                      list($searchhome_destinationsRecords, $destinationsMetaData) = getRecords(array(
                                        'tableName'   => 'destinations',
                                        'where'       => 'active = "1"',
                                        'loadUploads' => false,
                                        'allowSearch' => false,
                                        'useSeoUrls'    => true,
                                      ));
                                    ?>
                                    <option value="">Destination</option>
                                    <?php foreach ($searchhome_destinationsRecords as $record): ?><option value="<?php echo $record['num'] ?>"><?php if ($record['depth'] =="1"): ?>- <?php endif ?><?php if ($record['depth'] =="2"): ?>&nbsp;&nbsp;-- <?php endif ?><?php echo htmlspecialchars($record['name']) ?></option><?php endforeach ?>
                                </select>
                            </div>
                            <div class="medium-3 column">
                                <select class="input-list input-large" id="yacht_type" name="yacht_type">
                                    <?php 
                                      // load records from 'yacht_type' for top and footer nav
                                      list($searchhome_yacht_typeRecords, $yacht_typeMetaData) = getRecords(array(
                                        'tableName'   => 'yacht_type',
                                        'where'       => 'active = "1"',
                                        'loadUploads' => false,
                                        'allowSearch' => false,
                                        'useSeoUrls'    => true,
                                      ));
                                    ?>
                                    <option value="">Yacht Type</option>
                                    <?php foreach ($searchhome_yacht_typeRecords as $record): ?>
                                    <option value="<?php echo $record['num'] ?>">- <?php echo htmlspecialchars($record['name_plural']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="medium-3 column">
                                <input class="input-search input-large" type="text" placeholder="keyword" name="yacht_title_query,meta_description_query,intro_query,yacht_name_query" />
                            </div>
                            <div class="medium-2 column">
                                <input type="submit" class="button postfix" value="Search" />
                            </div>
                        </div>
                    </form>
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
            <?php
              // load records from 'yacht_type'
              list($home_yacht_typeRecords, $yacht_typeMetaData) = getRecords(array(
                'tableName'   => 'yacht_type',
                'where'       => 'featured = "1"' . ' AND active ="1"',
                'limit'       => '4',
                'loadUploads' => true,
                'allowSearch' => false,
                'useSeoUrls'    => true,
              ));
            ?>
            <ul class="grid-yacht-type small-block-grid-1 medium-block-grid-2 large-block-grid-4 text-center">
                <?php foreach ($home_yacht_typeRecords as $record): ?>
                <li><a href="<?php echo strtolower($record['_link']); ?>"><?php foreach ($record['list_image'] as $index => $upload): ?><img src="<?php echo $upload['urlPath'] ?>" alt="<?php echo htmlencode($record['name_plural']) ?>"><h3><?php echo htmlencode($record['name_plural']) ?></h3></a><?php endforeach ?></li>
                <?php endforeach ?>
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

    <?php
      // load records from 'destinations'
      list($homedestinationsRecords, $destinationsMetaData) = getRecords(array(
        'tableName'   => 'destinations',
        'where'       => 'feature = "1"' . ' AND active ="1"',
        'limit'       => '5',
        'orderBy'     => 'RAND()',
        'loadUploads' => true,
        'allowSearch' => false,
        'useSeoUrls'    => true,
      ));
    ?>
    <div class="panel-group row">
        <?php $destinationcount = 0; ?> 
        <?php foreach ($homedestinationsRecords as $record): ?>
        <?php $destinationcount++; ?> 
        <div class="<?php if ($destinationcount<3): ?>medium-6<?php else: ?>medium-4<?php endif ?> column">
            <div class="panel-wrap margin-space">
                <a href="<?php echo strtolower($record['_link']); ?>">
                    <?php $destinationimage = ""; ?> 
                    <?php foreach ($record['list_image'] as $index => $upload): ?>
                        <?php if ($upload['thumbUrlPath'] > "186"): ?>
                        <?php $destinationimage = $upload['thumbUrlPath'] ?>
                        <?php else: ?>
                        <?php $destinationimage = $upload['urlPath'] ?>
                        <?php endif ?>
                        <?php break ?>
                    <?php endforeach ?>
                    <img class="panel-img" src="<?php echo $destinationimage; ?>" alt="<?php echo htmlencode($record['name']) ?>">
                    <div class="panel-inner">
                        <div class="panel-info">
                            <?php if ($record['tagline']): ?>
                            <h4 class="destination-name"><?php echo htmlencode($record['name']) ?></h4>
                            <h3><?php echo htmlencode($record['tagline']) ?></h3>
                            <?php else: ?>
                            <h3><?php echo htmlencode($record['name']) ?></h3>
                            <?php endif ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php if ($destinationcount==2): ?></div><div class="panel-group row"><?php endif ?>
        <?php endforeach ?>
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
        <?php
          // load records from 'blog'
          list($homenewsRecords, $newsMetaData) = getRecords(array(
            'tableName'   => 'news',
            'limit'       => '3',
            'loadUploads' => true,
            'allowSearch' => false,
            'useSeoUrls'    => true,
          ));
        ?>
        <div class="small-12 columns">
            <?php foreach ($homenewsRecords as $record): ?>
            <div class="article-fluid">
                <article class="article article-snippet">
                    <a href="<?php echo strtolower($record['_link']); ?>">
                    <figure class="post-image"><img src="<?php foreach ($record['list_image'] as $index => $upload): ?><?php echo $upload['thumbUrlPath2'] ?>" alt="<?php echo htmlencode($record['title']) ?>"><?php break ?><?php endforeach ?></figure>
                    <div class="post-content">
                        <span class="post-date"><?php echo date("F d, Y", strtotime($record['publishDate'])) ?></span>
                        <h3><?php echo htmlencode($record['title']) ?></h3>
                        <p><?php echo htmlencode($record['intro']) ?></p>
                    </div></a>
                </article>
            </div>
            <?php endforeach ?>
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
