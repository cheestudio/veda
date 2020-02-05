<?php // References
$refs = get_field('article_refs_rep');

if ( $refs ) : ?>
  <section id="view-references" class="article-references">
    <div class="container">
      <div class="article-references--toggle">
        <h6><a title="Click to Open/Close">View References<span class="close"><i class="las la-plus-circle"></i></span><span class="open"><i class="las la-minus-circle"></i></span></a></h6>
      </div>
      <div class="article-references--content">
        <div class="flex">
          <?php foreach ( $refs as $ref ) : ?>
            <div class="reference"><?= $ref['content']; ?></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
