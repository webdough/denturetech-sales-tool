<div class="container">
    <% include Content %>
</div><!-- /.container -->

<% if $ProductTabsList %>
<section class="price-tabs section">
    <div class="container">
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
            <% loop $ProductTabsList %>
                <li role="presentation" class="<% if $First %>active<% end_if %>"{$Top.ProductTabSize}><a href="#product_tab_{$Pos}" role="tab" data-toggle="tab">{$Title}</a></li>
            <% end_loop %>
            </ul><!-- /.nav nav-tabs -->
            <div class="tab-content">
            <% loop $ProductTabsList %>
                <div role="tabpanel" class="tab-pane<% if $First %> active<% end_if %>" id="product_tab_{$Pos}">
                <% if $Rows %>
                    <table class="table">
                        <tr class="header">
                            <th class="col-sm-3">Type</th>
                            <th class="col-sm-3">Product</th>
                            <th class="col-sm-3">Code</th>
                            <th class="col-sm-3">Price</th>
                        </tr>
                        <% loop $Rows %>
                        <tr class="{$EvenOdd}">
                            <td class="col-sm-3">{$ColumnOne}</td>
                            <td class="col-sm-3">{$ColumnTwo}</td>
                            <td class="col-sm-3">{$ColumnThree}</td>
                            <td class="col-sm-3">{$ColumnFour}</td>
                        </tr>
                        <% end_loop %>
                    </table><!-- /.table -->
                <% end_if %>
                </div><!-- /.tab-pane -->
            <% end_loop %>
            </div><!-- /.tab-content -->
        </div><!-- /.tab-panel -->
    </div><!-- /.container -->
</section><!-- /.price-tabs -->
<% end_if %>

<% if $ServiceTabsList %>
    <section class="price-tabs services section">
        <div class="container">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                <% loop $ServiceTabsList %>
                    <li role="presentation" class="<% if $First %>active<% end_if %>"{$Top.ServiceTabSize}><a href="#service_tab_{$Pos}" role="tab" data-toggle="tab">{$Title}</a></li>
                <% end_loop %>
                </ul><!-- /.nav nav-tabs -->
                <div class="tab-content">
                <% loop $ServiceTabsList %>
                    <div role="tabpanel" class="tab-pane<% if $First %> active<% end_if %>" id="service_tab_{$Pos}">
                    <% if $Rows %>
                        <table class="table">
                            <tr class="header">
                                <th class="col-sm-3">Type</th>
                                <th class="col-sm-3">Service</th>
                                <th class="col-sm-3">Code</th>
                                <th class="col-sm-3">Price</th>
                            </tr>
                            <% loop $Rows %>
                            <tr class="{$EvenOdd}">
                                <td class="col-sm-3">{$ColumnOne}</td>
                                <td class="col-sm-3">{$ColumnTwo}</td>
                                <td class="col-sm-3">{$ColumnThree}</td>
                                <td class="col-sm-3">{$ColumnFour}</td>
                            </tr>
                            <% end_loop %>
                        </table><!-- /.table -->
                    <% end_if %>
                    </div><!-- /.tab-pane -->
                <% end_loop %>
                </div><!-- /.tab-content -->
            </div><!-- /.tab-panel -->
        </div><!-- /.container -->
    </section><!-- /.price-tabs -->
<% end_if %>

<div class="container">
    <p>
        <a href="{$BaseHref}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Go Back Home</a>
    </p>
</div><!-- /.container -->