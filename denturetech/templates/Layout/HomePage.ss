<% if $CategoryHolder %>
<% with $CategoryHolder %>
<section class="category-holder section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <div class="loop">
                    <div class="row">
                    <% loop $Children %>
                        <article class="item col-sm-4 {$FirstLast} {$EvenOdd}">
                            <div class="inner">
                                <div class="heading">
                                    <h3 class="text">{$MenuTitle}</h3><!-- /.text -->
                                    <a class="link btn btn-secondary" href="{$Link}" title="{$Title}">Read More <i class="fa fa-chevron-right"></i></a>
                                </div><!-- /.heading -->
                            </div><!-- /.inner -->
                        </article><!-- /.col-sm4 -->
                    <% end_loop %>
                    <% if $Top.GridButtonTitle && $Top.GridButtonText && $Top.GridButtonLink %>
                        <article class="item col-sm-4">
                            <div class="inner">
                                <div class="heading">
                                    <h3 class="text">{$Top.GridButtonTitle}</h3><!-- /.text -->
                                    <a class="link btn btn-secondary" href="{$Top.GridButtonLink.Link}" title="{$Top.GridButtonLink.Title}">{$Top.GridButtonText} <i class="fa fa-chevron-right"></i></a>
                                </div><!-- /.heading -->
                            </div><!-- /.inner -->
                        </article><!-- /.col-sm4 -->
                    <% end_if %>
                    </div><!-- /.row -->
                </div><!-- /.loop -->
            </div><!-- /.col-md-offset-3 col-md-9 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.category-holder section -->
<% end_with %>
<% end_if %>