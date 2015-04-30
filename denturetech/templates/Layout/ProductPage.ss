<div class="container">
    <% include Content %>
    <% if $Price %>
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#price" aria-expanded="false" aria-controls="price">
            Price <i class="fa fa-chevron-down"></i>
        </button>
        <div class="collapse" id="price">
            <ul class="price-list">
                <li><strong>Product:</strong> $Price.ColumnTwo</li>
                <li><strong>Price:</strong> $Price.ColumnFour.Nice</li>
            </ul><!-- /.price-list -->
            <% if $SiteConfig.PriceListLink %><a href="{$SiteConfig.PriceListLink.Link}" title="{$SiteConfig.PriceListLink.Title}" class="btn btn-primary">{$SiteConfig.PriceListLink.MenuTitle} <i class="fa fa-chevron-right"></i></a><% end_if %>
        </div>
    <% else %>
        <% if $SiteConfig.PriceListLink %><a href="{$SiteConfig.PriceListLink.Link}" title="{$SiteConfig.PriceListLink.Title}" class="btn btn-secondary">{$SiteConfig.PriceListLink.MenuTitle} <i class="fa fa-chevron-right"></i></a><% end_if %>
    <% end_if %>
</div><!-- /.container -->

<% if $BenefitsContent || $Images %>
<section class="benefits section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="typography">
                    {$BenefitsContent}
                </div><!-- /.typography -->
            </div><!-- /.col-sm-8 -->
            <div class="col-sm-4">
                <% if $Images %>
                <a href="{$Link}gallery">
                    <figure class="gallery thumbnail">
                        {$FirstImage.croppedImage(360, 203)}
                        <figcaption class="heading">
                            <h4 class="text">{$GalleryThumbnailText}</h4><!-- /.text -->
                        </figcaption><!-- /.heading -->
                    </figure><!-- /.gallery thumbnail -->
                </a>
                <% end_if %>
            </div><!-- /.col-sm-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.benefits section -->
<% end_if %>