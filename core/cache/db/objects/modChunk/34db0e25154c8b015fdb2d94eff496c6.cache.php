<?php  return array (
  'id' => 19,
  'source' => 1,
  'property_preprocess' => 0,
  'name' => 'new',
  'description' => '',
  'editor_type' => 0,
  'category' => 0,
  'cache_type' => 0,
  'snippet' => '<li>
    <a class="col3__title" href="[[~[[+id]]]]">
        <img class="col3__img" src="[[+img:phpthumbof=`w=254&h=150&zc=1&q=80`]]" alt="[[+pagetitle]]">
    </a>

    <div class="col3__info">
        <div class="news-meta">
            <div class="news-meta__date">[[+publishedon:strtotime:date=`%d`]]</div>
            <div class="news-meta__month">[[+publishedon:strtotime:date=`%m`]]
                <div class="news-meta__year">[[+publishedon:strtotime:date=`%Y`]]</div>
            </div>
        </div>
        <a class="col3__title" href="[[~[[+id]]]]">[[+pagetitle]]</a>
        <div class="col3__text"><p>[[+introtext]]</p></div>
    </div>
</li>',
  'locked' => 0,
  'properties' => 'a:0:{}',
  'static' => 0,
  'static_file' => '',
  'content' => '<li>
    <a class="col3__title" href="[[~[[+id]]]]">
        <img class="col3__img" src="[[+img:phpthumbof=`w=254&h=150&zc=1&q=80`]]" alt="[[+pagetitle]]">
    </a>

    <div class="col3__info">
        <div class="news-meta">
            <div class="news-meta__date">[[+publishedon:strtotime:date=`%d`]]</div>
            <div class="news-meta__month">[[+publishedon:strtotime:date=`%m`]]
                <div class="news-meta__year">[[+publishedon:strtotime:date=`%Y`]]</div>
            </div>
        </div>
        <a class="col3__title" href="[[~[[+id]]]]">[[+pagetitle]]</a>
        <div class="col3__text"><p>[[+introtext]]</p></div>
    </div>
</li>',
);