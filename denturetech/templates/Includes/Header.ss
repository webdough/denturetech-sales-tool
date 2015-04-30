<nav id="header" role="navigation">
    <div class="container">
        <div class="row">
            <div id="logo" class="col-sm-8">
                <% if $SiteConfig.LogoImage %>
                    <a href="{$BaseHref}" rel="home">{$SiteConfig.LogoImage}</a>
                <% else %>
                    <% if $SiteConfig.Title %><h2 class="heading"><a href="{$BaseHref}" rel="home">{$SiteConfig.Title}</a></h2><!-- /.heading --><% end_if %>
                    <% if $SiteConfig.Tagline %><h3 class="tagline">{$SiteConfig.Tagline}</h3><!-- /.tagline --><% end_if %>
                <% end_if %>
            </div><!-- /#logoContainer .col-sm-3 -->
            <div id="navigation" class="col-sm-4">
                <% if $HeaderButtonText && $HeaderButtonLink %>
                    <a class="btn btn-primary btn-block" href="{$HeaderButtonLink.Link}" title="{$HeaderButtonLink.Title}">{$HeaderButtonText}</a>
                <% end_if %>
            </div><!-- /#navigationContainer .col-sm-9 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</nav><!-- /.header -->