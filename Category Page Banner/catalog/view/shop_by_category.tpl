<?php echo $header; ?>
<link href="catalog/view/theme/tt_presiden1/stylesheet/shop-by-category.css?v=523" type="text/css" rel="stylesheet" media="screen" />
<nav class="breadcrumb-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb justify-content-center mb-0">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php if ($breadcrumb['class'] == 'active'){ ?>    
        <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb['text']; ?></li>
      <?php } else { ?>
        <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    <?php } ?>
  </ol>
</nav>
<div class="row">
<section>
   <?php if ($device == 'mobile') { ?>
                <div class="top-banner">
                    <div class="category-product-mobile-carousel w3-content w3-section">
                        <?php foreach ($banners as $banner) { ?>
                            <a href="<?php echo $banner['link']; ?>"><img alt="True Elements" class="mySlides img-fluid" src="<?php echo $banner['mobile_thumb']; ?>" loading="lazy"></a>
                        <?php } ?>  
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".category-product-mobile-carousel").owlCarousel({
                                autoPlay: true,
                                items : 1,
                                slideSpeed : 1000,
                                navigation : true,
                                pagination : true,
                                controls: true,
                                stopOnHover : false,
                                itemsDesktop : [1199,1],
                                itemsDesktopSmall : [991,1],
                                itemsTablet: [700,1],
                                itemsMobile : [400,1],
                            });
                        });
                    </script>
                </div>  
            <?php } else { ?>
                <div class="row top-banner">
                    <div class="category-product-carousel w3-content w3-section">
                        <?php foreach ($banners as $banner) { ?>
                            <a href="<?php echo $banner['link']; ?>"><img alt="True Elements" class="mySlides img-fluid" src="<?php echo $banner['thumb']; ?>" loading="lazy"></a>
                        <?php } ?> 
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".category-product-carousel").owlCarousel({
                                autoPlay: true,
                                items : 1,
                                slideSpeed : 1000,
                                navigation : true,
                                pagination : true,
                                controls: true,
                                stopOnHover : false,
                                itemsDesktop : [1199,1],
                                itemsDesktopSmall : [991,1],
                                itemsTablet: [700,1],
                                itemsMobile : [400,1],
                            });
                        });
                    </script>
                </div>    
            <?php } ?>

    <div class="container">
            <div class="col-md-12">
                <?php foreach ($shop_categoris as $shop_category) { ?>
                    <div class="row" style="margin-top:3%;margin-bottom: 3%;"> 
                        <div class="one">
                            <h2 class="te"><?php echo $shop_category['name']; ?></h2>
                        </div>
                        <?php if ($categories) { ?>
                            <div class="row p-0">
                                <?php foreach ($categories as $category) { ?>
                                    <?php if ($shop_category['shop_by_category_id'] == $category['shop_by_category_id']) { ?>
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 catbox p-2 p-lg-4 text-center">
                                            <div class="inline-photo show-on-scroll"> 
                                                <a class="text-decoration-none" href="<?php echo $category['href']; ?>" class="productImg"> <img class="img-fluid" src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>" width="200"> </a>
                                                    <span class="h3 lh-base"><a class="text-decoration-none" href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a> </span>
                                            </div>
                                        </div> 
                                    <?php } ?>    
                                <?php } ?> 
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?> 
            </div>
       </div> 
</section>
</div>
<script type="text/javascript">
        //*********************LEVIOOSA ONLINE GROCERY BOX*********************// 
        $(document).ready(function(){
            pagenum = 1;
            function AutoRotate() {
                var myele = null;
                var allElements = document.getElementsByTagName('label');
                for (var i = 0, n = allElements.length; i < n; i++) {
                    var myfor = allElements[i].getAttribute('for');
                    if ((myfor !== null) && (myfor == ('slide_2_' + pagenum))) {
                        allElements[i].click();
                        break;
                    }
                }
                if (pagenum == 4) {
                    pagenum = 1;
                } else {
                    pagenum++;
                }
            }
            setInterval(AutoRotate, 5000);
        });
      
        //SCROLL ANIMATE
        var scroll = window.requestAnimationFrame ||
                     function(callback){ window.setTimeout(callback, 1000/500)};
        var elementsToShow = document.querySelectorAll('.show-on-scroll'); 
        function loop() {
        
            Array.prototype.forEach.call(elementsToShow, function(element){
              if (isElementInViewport(element)) {
                element.classList.add('is-visible');
              } else {
                element.classList.remove('is-visible');
              }
            });
        
            scroll(loop);
        }
        loop();
    
        //SCROLL ANIMATE
        var scroll2 = window.requestAnimationFrame ||
                     function(callback2){ window.setTimeout(callback2, 1000/20)};
        var elementsToShow2 = document.querySelectorAll('.show-on-scroll2'); 
        function loop2() {
        
            Array.prototype.forEach.call(elementsToShow2, function(element){
              if (isElementInViewport(element)) {
                element.classList.add('is-visible2');
              } else {
                element.classList.remove('is-visible2');
              }
            });
        
            scroll2(loop2);
        }
        loop2();
    
        //SCROLL ANIMATE
        var scroll3 = window.requestAnimationFrame ||
                     function(callback3){ window.setTimeout(callback3, 1000/830)};
        var elementsToShow3 = document.querySelectorAll('.show-on-scroll3'); 
        function loop3() {
        
            Array.prototype.forEach.call(elementsToShow3, function(element){
              if (isElementInViewport(element)) {
                element.classList.add('is-visible3');
              } else {
                element.classList.remove('is-visible3');
              }
            });
        
            scroll3(loop3);
        }
        loop3();
    
        function isElementInViewport(el) {
          // special bonus for those using jQuery
          if (typeof jQuery === "function" && el instanceof jQuery) {
            el = el[0];
          }
          var rect3 = el.getBoundingClientRect();
          return (
            (rect3.top <= 0
              && rect3.bottom >= 0)
            ||
            (rect3.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
              rect3.top <= (window.innerHeight || document.documentElement.clientHeight))
            ||
            (rect3.top >= 0 &&
              rect3.bottom <= (window.innerHeight || document.documentElement.clientHeight))
          );
        }

</script>
<?php echo $footer; ?>
