<div id="share-btns">
    <ul class="d-flex flex-row flex-md-column float-md-right justify-content-center">
        <li class="d-block d-md-none">
            <span>Сподели:</span>
        </li>
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="blank"><i class="fab fa-facebook-square"></i></a>
        </li>
        <li>
            <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink() ?>&text=<?php echo get_the_title() ?>&via=learnmove&hashtags=<?php
            foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?>" target="blank"><i class="fab fa-twitter-square"></i></a>
        </li>
        <li>
            <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ?>" target="blank"><i class="fab fa-pinterest-square"></i></a>
        </li>
    </ul>
</div>