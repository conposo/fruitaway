<footer class="content-info">
  <div class="container">
  
    @php dynamic_sidebar('sidebar-footer') @endphp

    <div class="row border-bottom pt-3 pb-3">
        <div class="col">
            <img src="@asset('images/logo-home.svg')">
        </div>
        <div class="col">
            <?php
                if(is_active_sidebar('footer-products'))
                {
                    dynamic_sidebar('footer-products');
                }
                ?>
        </div>
        <div class="col">
            <?php
                if(is_active_sidebar('footer-info'))
                {
                    dynamic_sidebar('footer-info');
                }
                ?>
        </div>
        <div class="col">
            <h3>СВЪРЖЕТЕ СЕ С НАС</h3>
            <a class="footer-tel" href="tel:0889 600 113">0888 567 230</a>
            <a href="mailto:order@fruitaway.com">order@fruitaway.com</a>
        </div>
        <div class="col-5">
        </div>
    </div>
    <div class="row bottom-line pt-3 pb-3">
        <div class="col d-flex justify-content-between">
            <p>Copyright © {{ date("Y") }} <a href="{{ site_url() }}">{{ get_bloginfo('name', 'display') }}</a>   |   <a href="#">Политика за конфиденциалност и безопастност на данните</a>   |   <a href="#">Връзка с ОРС</a></p>
            <p class="text-right">Онлайн магазин от <a class="font-weight-bold" href="#">NUXT</a></p>
        </div>
    </div>

  </div>
</footer>
