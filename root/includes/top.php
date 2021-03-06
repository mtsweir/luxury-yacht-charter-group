<?php
  // load records from 'destinations' for top and footer nav
  list($nav_destinationsRecords, $selectedDestinations) = getCategories(array(
    'tableName'            => 'destinations', //
    //'where'       => 'active = "1"',
    'categoryFormat'       => 'onelevel',  // showall, onelevel, twolevel, breadcrumb
    'defaultCategory'      => '',    // Enter 'first', a category number, or leave blank '' for none
    'useSeoUrls'    => true, 
  ));

  // load records from 'yacht_type' for top and footer nav
  list($nav_yacht_typeRecords, $yacht_typeMetaData) = getRecords(array(
    'tableName'   => 'yacht_type',
    'where'       => 'active = "1"',
    'loadUploads' => true,
    'allowSearch' => false,
    'useSeoUrls'    => true, 
  ));

?>

<aside class="right-off-canvas-menu">
    <ul class="mobile-nav accordion" data-accordion>
      <li class="accordion-navigation">
          <a href="search.php">Find your Yacht <i class="button-search fa fa-search"></i></a>
      </li>
      <li class="accordion-navigation"><a href="/">Home</a></li>
      <li class="accordion-navigation">
        <a href="#panel1a">Destinations</a>
        <div id="panel1a" class="content">
            <ul class="no-bullet">
                <?php foreach ($nav_destinationsRecords as $categoryRecord): ?><?php if($categoryRecord['active']==1): ?><?php echo $categoryRecord['_listItemStart'] ?><a href="/<?php echo strtolower($categoryRecord['_link']); ?>"><?php echo $categoryRecord['name'] ?></a><?php echo $categoryRecord['_listItemEnd'] ?><?php endif ?><?php endforeach; ?>
            </ul>
        </div>
      </li>
      <li class="accordion-navigation">
        <a href="#panel2a">Yacht Type</a>
        <div id="panel2a" class="content">
            <ul class="no-bullet">
                <?php foreach ($nav_yacht_typeRecords as $record): ?><li><a href="/<?php echo strtolower($record['_link']); ?>"><?php echo htmlencode($record['name_plural']) ?></a></li><?php endforeach ?>
            </ul>
        </div>
      </li>
      <li class="accordion-navigation">
        <a href="#panel3a">Charter Advice</a>
        <div id="panel3a" class="content">
            <ul class="no-bullet">
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
            </ul>
        </div>
      </li>
      <li class="accordion-navigation"><a href="blog.php">Blog</a></li>
      <li class="accordion-navigation">
        <a href="#panel4a">About Us</a>
        <div id="panel4a" class="content">
            <ul class="no-bullet">
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
                <li><a href="#">Sub Nav Link</a></li>
            </ul>
        </div>
      </li>
      <li class="accordion-navigation accordion-social">
        <nav class="nav-social">
            <?php if ($settingsRecord['facebook']): ?><a href="<?php echo $settingsRecord['facebook'] ?>" class="social-icon social-icon-facebook" target="_blank"><i class="fa fa-facebook"></i></a><?php endif ?>
            <?php if ($settingsRecord['twitter']): ?><a href="<?php echo $settingsRecord['twitter'] ?>" class="social-icon social-icon-twitter" target="_blank"><i class="fa fa-twitter"></i></a><?php endif ?>
            <?php if ($settingsRecord['google']): ?><a href="<?php echo $settingsRecord['google'] ?>" class="social-icon social-icon-googleplus" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif ?>
        </nav>
      </li>
    </ul>
</aside>

<div class="info-bar show-for-medium-up">
    <div class="row large-collapse">
        <div class="small-12 column">
            <ul class="top-links inline-list right">
                <li><a href="/blog.php">Blog</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li class="nav-lang">
                    <a class="nav-lang-eng" href="/">English</a>
                    <a class="nav-lang-fr" href="/fr/">Français</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<header class="header">
    <div class="row">
        <div class="medium-12 column">
        
        <a class="menu-trigger right-off-canvas-toggle" href="#">
            <i class="fa fa-bars icon-burger"></i>
            <span class="screen-reader-only">Menu</span>
        </a>

        <nav class="primary-nav">

            <div class="logo-wrap">
                <a class="logo" href="/" title="<?php echo $settingsRecord['title'] ?>">
                    <img data-interchange="[/images/logo-lycg.svg, (medium)], [/images/logo-lycg-mobile.svg, (small-only)]">
                </a>
            </div>

            <ul class="main-nav inline-list right">
                <li class="main-nav-link">
                    <a href="/destinations.php" data-dropdown="nav-destinations" data-options="is_hover:true">Destinations</a>
                    <ul id="nav-destinations" class="f-dropdown text-left dropdown" data-dropdown-content="">
                        <?php foreach ($nav_destinationsRecords as $categoryRecord): ?><?php if($categoryRecord['active']==1): ?><?php echo $categoryRecord['_listItemStart'] ?><a href="/<?php echo strtolower($categoryRecord['_link']); ?>"><?php echo $categoryRecord['name'] ?></a><?php echo $categoryRecord['_listItemEnd'] ?><?php endif ?><?php endforeach; ?>
                    </ul>
                </li>
                <li class="main-nav-link">
                    <a href="/yacht-types.php" data-dropdown="nav-yacht-type" data-options="is_hover:true">Yacht Type</a>
                    <ul id="nav-yacht-type" class="f-dropdown text-left dropdown" data-dropdown-content="">
                        <?php foreach ($nav_yacht_typeRecords as $record): ?><li><a href="/<?php echo $record['_link'] ?>"><?php echo htmlencode($record['name_plural']) ?></a></li><?php endforeach ?>
                    </ul>
                </li>
                <li class="main-nav-link">
                    <a href="#" data-dropdown="nav-charter-advice" data-options="is_hover:true">Charter Advice</a>
                    <ul id="nav-charter-advice" class="f-dropdown text-left dropdown" data-dropdown-content="">
                        <li><a href="#">Sub Nav Link</a></li>
                        <li><a href="#">Sub Nav Link</a></li>
                        <li><a href="#">Sub Nav Link</a></li>
                        <li><a href="#">Sub Nav Link</a></li>
                    </ul>
                </li>
                <li class="main-nav-link"><a href="/search.php" class="header-button-search button">Search</a></li>
            </ul>
            <a href="/search.php" class="header-button-search mobile-search-button button">Search</a>

        </nav>

        </div>
    </div>
</header>