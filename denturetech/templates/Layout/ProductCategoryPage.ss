<div class="container">
    <% include Content %>
</div><!-- /.container -->

<% if $Children %>
<section class="category-page section">
    <div class="container">
        <div class="loop">
            <div class="row">
            <% loop $Children %>
                <article class="item col-xs-6 col-sm-4 {$EvenOdd} {$FirstLast}">
                    <div class="inner">
                        <a href="{$Link}" title="{$Title}">
                            <figure class="image">
                                <% if $ThumbnailImage %>{$ThumbnailImage.croppedImage(375, 375)}<% end_if %>
                                <figcaption class="heading">
                                    <h3 class="text">{$MenuTitle}</h3><!-- /.text -->
                                    <div class="summary">{$Content.LimitCharacters(130)}</div><!-- /.summary -->
                                </figcaption><!-- /.heading -->
                            </figure><!-- /.image -->
                        </a>
                    </div><!-- /.inner -->
                </article><!-- /.col-xs-6 col-sm4 -->
            <% end_loop %>
            </div><!-- /.row -->
        </div><!-- /.loop -->
    </div><!-- /.container -->
</section><!-- /.category-page section -->
<% end_if %>